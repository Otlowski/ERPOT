<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Mail;
use Validator;
use Session;
use Illuminate\Database\Query\Builder;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Users\User;
use App\Models\Users\UserMail;
use App\Models\Users\UserSession;
use App\Models\Users\UserRegisterHash;

class UsersController extends Controller
{   
    
    public $moduleParams = [
        'moduleId'      => null,
        'moduleCode'    => null
    ];
        
    public function registerUser(Request $request) {
        
        try {

            $parameters = $request->all();

            $validator = \Validator::make($request->all(), [
               'username'               =>      'required|string|unique:users',
               'email'                  =>      'required|email|unique:users',
               'password'               =>      'required',
               'password_confirm'       =>      'required|same:password'
            ]);

            if ($validator->fails()) {
                return self::responseJson($validator->errors(), 'error');
            }

//            $user = User::where('email', $parameters['email'])->first();
//
//            if ($user && $user->isActivated()) {
//                return self::responseJson("This account is created", 'error');
//            }
//
//            if ($user && $user->isRegistered()) {
//                return self::responseJson("This account is inactivated.. Check your mailbox and click the link to activate account..", 'error');
//            }

            $newUser = new User($parameters);
            $newUser->status = 'inactivated';
            $newUser->is_admin = false;
            $newUser->object_id = $newUser->setObjectId();
            $newUser->password = hash('sha512', $parameters['password']);
            $newUser->linkNames();
            $newUser->save();

            // send email to verify
//            $userRegisterHash = self::sendVerificationMail($newUser);
                $userRegisterHash = null;
            $response = [
                'created' => [$newUser, $userRegisterHash],
                'deleted' => []
            ];
            
            return self::responseJson($response);
        } catch (Exception $ex) {
            return self::responseJson($ex, 'error');
        }
    }
    
    public function verifyRegisterLink($hash) {
        
        $userRegisterHash = UserRegisterHash::where('hash', $hash)->first();
        
        if (!$userRegisterHash) {
            return self::responseJson('Link doesn\'t exists..', 'error');
        }
        
        if (Carbon::now() > $userRegisterHash->finish_at) {
            return self::responseJson('Link expires..', 'error');
        }
        
        $user = User::where('object_id', $userRegisterHash->users__object_id)->first();
        
        if (!$user) {
            return self::responseJson('User not found..', 'error');
        }
        
        $user->status = 'activated';
        $user->save();
        
        $response = [
            'created' => [],
            'deleted' => [$userRegisterHash]
        ];
        
        $userRegisterHash->delete();
        
        return self::responseJson($user);
    }
    
    public function refreshRegisterHash($user) {
        
        $deleted = [];
        $userRegisterHash = UserRegisterHash::where('users__object_id', $user->object_id)->first();
        if ($userRegisterHash->isActive()) {
            $deleted[] = $userRegisterHash;
            $userRegisterHash->delete();
        }
        
        $newUserRegisterHash = UserRegisterHash::createRegisterHash($user);
        self::sendVerificationMail($user);
        
        $response = [
            'created' => [$newUserRegisterHash],
            'deleted' => $deleted
        ];
        
        return self::responseJson($response);
    }
    
    public function login(Request $request) {
        
        try {

            $parameters = $request->all();

            $validator = \Validator::make($request->all(), [
                'email'              =>      'required|email|exists:users',
                'password'           =>      'required'
            ]);

            if ($validator->fails()) {
                return self::responseJson($validator->errors(), 'error');
            }

            $user = User::where('email', $parameters['email'])->first();

            if (!$user) {
                return self::responseJson('User not found..', 'error');
            }

            if (!$user->isCorrectPassword($parameters['password'])) {
                return self::responseJson('Incorrect password..', 'error');
            }

            if (!$user->isActivated()) {
                return self::responseJson("This account is inactivated.. Check your mailbox and click the link to activate account..", 'error');
            }
            
            // create active session for user
            $userSession = UserSession::createUserSession($user);
            $user->active_session = $userSession;
            
            $response = [
                'created' => [$user],
                'deleted' => []
            ];

            return self::responseJson($response);

        } catch(Excaption $ex) {
            return self::responseJson($ex->getMessage(), 'error');
        }
    }
    
    public function logout(Reques $request) {
        
        try {

            $parameters = $request->all();
            
            $validator = \Validator::make($request->all(), [
                'hash'              =>      'string|size:128',
            ]);

            if ($validator->fails()) {
                return self::responseJson($validator->errors(), 'error');
            }
            
            $hash = $parameters['hash'];

            $session = UserSession::getSessionWithHash($hash);

            if (!$session) {
                return 'Session not found..';
            }

            $session->finish_at = Carbon::now();
            $user = User::where('hash', $hash);
            $user->hash = '';
            $session->save();
            $user->save();
            
            $response = [
                'created' => [],
                'deleted' => [$session]
            ];
            
            $session->delete();

            return self::responseJson($response);

        } catch(Excaption $ex) {
            return self::responseJson($ex->getMessage(), 'error');
        }
    }
    
    public function isLogged (Request $request) {
        
        $parameters = $request->all();
        
        $validator = \Validator::make($request->all(), [
            'hash'              =>      'string|size:128',
        ]);

        if ($validator->fails()) {
            return self::responseJson($validator->errors(), 'error');
        }
        
        $hash = $parameters['hash'];
        $session = UserSession::getSessionWithHash($hash);
        
        if (!$session) {
            return self::responseJson('Session not found..', 'error');
        }
        
        $session->refreshSession();
        
        return self::responseJson($session);
    }
    
    public function testMailSending(Request $request) {
        
        try {

            $validator = \Validator::make($request->all(), [
                   'email'              =>      'required|email',
                   'receiver'           =>      'required|string',
            ]);

            if ($validator->fails()) {
                return self::responseJson($validator->errors(), 'error');
            }

            $receiver = $request->input('receiver');
            $email = $request->input('email');

            Mail::send('Users.Emails.Test', ['header' => 'test header'], function($message) use ($receiver, $email) {

                $message->from('otlowski.maciej@gmail.com', 'notifications');
                $message->to($email, $receiver)->subject('testing mail sending');
            });
            
            return self::responseJson('Test mail sended to '.$receiver);

        } catch(Excaption $ex) {
            return self::responseJson($ex->getMessage(), 'error');
        }
    }
    
    public static function sendVerificationMail($user) {
        
        try {

            $userRegisterHash = UserRegisterHash::createRegisterHash($user);
            $subject = "Verication";
            $header = 'Verication';
            //$content = "Hi ".$user->name.".";
            //$content .= " To verify Your e-mail click at the link:";
            $link = 'erp.loc/verify/'.$userRegisterHash->hash;

            $verificationMail = new UserMail();
            $verificationMail->users__object_id = $user->object_id;
            $verificationMail->send_date = Carbon::now();
            $verificationMail->subject = $subject;
            $verificationMail->message = "";//$content;
            $verificationMail->save();

            $email = $user->email;
            $name = $user->name;

            Mail::send('Users.Emails.RegisterHash', ['header' => $header, 'name' => $name, 'link' => $link], function($message) use ($email, $subject) {

                $message->from('otlowski.maciej@gmail.com', 'notifications');   // email here
                $message->to($email)->subject($subject);
            });

//            $response = [
//                'created' => [$verificationMail, $userRegisterHash],
//                'deleted' => []
//            ];
//            
//            return self::responseJson($response);
            return $userRegisterHash;

        } catch(Excaption $ex) {
            return null;
        }
    }
    
    public function listUsers(Request $request) {
        
        try {

            $parameters = $request->all();

            $validator = Validator::make($request->all(), [
                'users_groups__id'                    =>   'exists:users_groups,id',
                'with_users_sessions'                 =>   'boolean',
                'with_users_mails'                    =>   'boolean',
                'with_users_register_hashes'          =>   'boolean',
                'object_ids'                          =>   'array',
                'object_ids.*.object_id'              =>   'string'
            ]);
            
            if ($validator->fails()) {
                return self::responseJson($validator->errors()->all(), 'error');
            }
            
            $query = User::whereNull('deleted_at');
            
            if (isset($parameters['users_groups__id']) && $parameters['users_groups__id']) {
                $query->where('users_groups__id', '=', $parameters['users_groups__id']);
            }
            // append all user session
            if (isset($parameters['with_users_sessions']) && $parameters['with_users_sessions']) {
                $query->with('userSession');
                
            }
            // append user send emails
            if (isset($parameters['with_users_mails']) && $parameters['with_users_mails']) {
                $query->with('userMail');
            }
            
            if (isset($parameters['with_users_register_hashes']) && $parameters['with_users_register_hashes']) {
                $query->with('userRegisterHash');
            }
            
            if (isset($parameters['object_ids'])) {
                $query->whereIn('object_id', $parameters['object_ids']);
            }
            
            $users = $query->orderBy('name', 'asc')->get();
//            foreach($users as &$user) {
//                $user->user_session_active = $user->userSessionActive();
//            }
            
            if (!$users) {
                return self::responseJson('Table "users" is empty', 'error');
            }

            $response = $users;
            
            return self::responseJson($response);
        } catch (Exception $ex) {
            return self::responseJson($ex->getMessage(), 'error');
        }
    }
    
    public function addUser(Request $request) {
        
        try {    

            $parameters = $request->all();

            $validator = Validator::make($request->all(), [
                'create'                            =>   'required|array',
                'create.*.username'                 =>   'required|string|unique:users,username',
                'create.*.email'                    =>   'required|email|unique:users,email',
                'create.*.password'                 =>   'required',
                'create.*.password_confirm'         =>   'required|same:create.*.password',
                'create.*.firstname'                =>   'string',
                'create.*.lastname'                 =>   'string',
                'create.*.is_admin'                 =>   'boolean',
//                'create.*.users_groups__id'         =>   'exists:users_groups',
//                'create.*.status'                   =>   'string',
            ]);

            if ($validator->fails()) {
                return self::responseJson($validator->errors()->all(), 'error');
            }
            
            $created = [];
            \DB::beginTransaction();
            foreach($parameters['create'] as $index => $param) {
                $user = new User($param);
                $user->password = hash('sha512',$param['password']);
                $user->object_id = $user->setObjectId();
                $user->linkNames();
                $user->save();
                $created[$index] = $user;
            }
            \DB::commit();
            
            $response = [
                'created'   =>  $created,
                'deleted'   =>  []
            ];
            
            return self::responseJson($response);
            
        } catch (Exception $ex) {
            \DB::rollback();
            return self::responseJson($ex->getMessage(), 'error');
        }
    }
    
    public function updateUser(Request $request) {
        
        try {    

            $parameters = $request->all(); 
            $validator = Validator::make($request->all(), [
                'create'                            =>   'required|array',
                'create.*.object_id'                =>   'required|string|exists:users,object_id',
                'create.*.email'                    =>   'email',
//                'create.*.password'                 =>   'string',
                'create.*.new_password'             =>   'string',
                'create.*.new_password_confirm'     =>   'string|same:create.*.new_password',
                'create.*.firstname'                =>   'string',
                'create.*.lastname'                 =>   'string',
                'create.*.is_admin'                 =>   'boolean',
                'create.*.status'                   =>   'string',
                'create.*.users_groups__id'         =>   'string',  
            ]);

            if ($validator->fails()) {
                return self::responseJson($validator->errors(), 'error','error');
            }
            
            $created = [];
            $deleted = [];
            \DB::beginTransaction();
            foreach($parameters['create'] as $index => $param) {
                $user = User::where('object_id', $param['object_id'])->orderBy('revision', 'desc')->first();
//                if (!$user) {
//                    self::responseJson($index.' element is incorrect..', 'error');
//                }
      
                //reate new object to show what just has been deleted 
                $deletedUser = new User();
                $deletedUser->id = $user->id;
                $deletedUser->username = $user->username;
                $deletedUser->object_id = $user->object_id;
                $deletedUser->email = $user->email;
                $deletedUser->password = $user->password;
                $deletedUser->firstname = $user->firstname;
                $deletedUser->lastname = $user->lastname;
                $deletedUser->is_admin = $user->is_admin;
                $deletedUser->status = $user->status;
                $deletedUser->users_groups__id = $user->users_groups__id;
                //update user
                $newUser =  $user;
                $newUser->incrementRevision();
                $newUser->linkNames();
                $newUser->password = hash('sha512', $param['new_password']);
                $newUser->update($param);
                
                $deleted[]= $deletedUser;
                $created[] = $newUser;
            }
            \DB::commit();
            
            $response = [
                'created'   =>  $created,
                'deleted'   =>  $deleted
            ];
            
            return self::responseJson($response);
            
        } catch (Exception $ex) {
            \DB::rollback();
            return self::responseJson($ex->getMessage(), 'error');
        }
    }
    
    public function deleteUser(Request $request) {
        
        try {    

            $parameters = $request->all();

            $validator = Validator::make($request->all(), [
                'delete'                =>    'required|array',
                'delete.*.object_id'    =>    'required|string|exists:users,object_id'
            ]);

            if ($validator->fails()) {
                return self::responseJson($validator->errors()->all(), 'error');
            }
            
            $deleted = [];
            \DB::beginTransaction();
            foreach($parameters['delete'] as $index => $param) {
                $user = User::where('object_id', $param['object_id'])->orderBy('revision', 'desc')->first();
//                if (!$user) {
//                    self::responseJson($index.' element is incorrect..', 'error');
//                }
                $deleted[] = $user;
                $user->delete();  
            }
            \DB::commit();

            $response = [
                'created'   =>  [],
                'deleted'   =>  $deleted
            ];
            
            return self::responseJson($response);
            
        } catch (Exception $ex) {
            \DB::rollback();
            return self::responseJson($ex->getMessage(), 'error');
        }
    }
    
    public function setLocale(Request $request) {
          try {
            $parameters = $request->all();
            
            $validator = Validator::make($request->all(), [
                'locale'                =>    'required|in:en,de'
            ]);

            if ($validator->fails()) {
                return self::responseJson($validator->errors()->all(), 'error');
            }
            
            Session::put('locale', $parameters['locale']);
            //Session::put('locale', 'en');
            app()->setLocale(Session::get('locale'));
            
            $response = [
                'locale' => Session::get('locale')
            ];
            return $this->responseJson($response);
        } catch (Exception $ex) {
            return $this->responseJson($ex->getMessage(), 'error', 500);
        }
    }
        public function detailsUser(Request $request) {

        try {

            $parameters = $request->all();

            $validator = Validator::make($request->all(), [
                        'object_id' => 'exists:users,object_id',
            ]);

            if ($validator->fails()) {
                return self::responseJson($validator->errors()->all(), 'error');
            }

            if(isset($parameters['object_id']) && ($parameters['object_id'])) {
                $user = User::where('object_id', '=', $parameters['object_id']) 
//                        ->with('userGroup')
                        ->get();
            }

            if (empty($user)) {
                return self::responseJson('User does not exist', 'error', null);
            }


            return self::responseJson($user);
        } catch (\Exception $ex) {
            return self::responseJson($ex->getMessage(), 'error', null);
        }
    }
}