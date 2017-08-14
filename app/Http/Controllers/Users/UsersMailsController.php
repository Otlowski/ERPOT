<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use Validator;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Users\UserMail;

class UsersMailsController extends Controller
{
    public function listUsersMails(Request $request) {
        
        try {

            $parameters = $request->all();
            
            $validator = Validator::make($request->all(), [
                'ids'                            =>   'array',
                'ids.*.id'                       =>   'integer'
            ]);
            
            if ($validator->fails()) {
                return self::responseJson($validator->errors()->all(), 'error');
            }
            
            $query = UserMail::whereNull('deleted_at');
            
            if (isset($parameters['ids'])) {
                $query->whereIn('id', $parameters['ids']);
            }
            
            $usersMails = $query->get();

            if (!$usersMails) {
                return self::responseJson('Table "users_mails" is empty', 'error');
            }

            $response = $usersMails;
            
            return self::responseJson($response);
        } catch (Exception $ex) {
            return self::responseJson($ex->getMessage(), 'error');
        }
    }
    
    public function addUserMail(Request $request) {
        
        try {    

            $parameters = $request->all();

            $validator = Validator::make($request->all(), [
                'create'                            =>   'required|array',
                'create.*.users__object_id'         =>   'string',
                'create.*.send_date'                =>   'date',
                'create.*.subject'                  =>   'string',
                'create.*.message'                  =>   'string'
            ]);

            if ($validator->fails()) {
                return self::responseJson($validator->errors()->all(), 'error');
            }
            
            $created = [];
            \DB::beginTransaction();
            foreach($parameters['create'] as $index => $param) {
                $userMail = new UserMail($param);
                $userMail->save();
                $created[] = $userMail;
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
    
    public function updateUserMail(Request $request) {
        
        try {    

            $parameters = $request->all();

            $validator = Validator::make($request->all(), [
                'create'                            =>   'required|array',
                'create.*.id'                       =>   'required|integer|exists:users_mails,id',
                'create.*.users__object_id'         =>   'string',
                'create.*.send_date'                =>   'date',
                'create.*.subject'                  =>   'string',
                'create.*.message'                  =>   'string'
            ]);

            if ($validator->fails()) {
                return self::responseJson($validator->errors()->all(), 'error');
            }
            
            $updated = [];
            \DB::beginTransaction();
            foreach($parameters['create'] as $index => $param) {
                $userMail = UserMail::where('id', $param['id'])->first();
                $userMail->update($param);
                $updated[] = $userMail;
            }
            \DB::commit();
            
            $response = [
                'updated'   =>  $updated
            ];
            
            return self::responseJson($response);
            
        } catch (Exception $ex) {
            \DB::rollback();
            return self::responseJson($ex->getMessage(), 'error');
        }
    }
    
    public function deleteUserMail(Request $request) {
        
        try {    

            $parameters = $request->all();

            $validator = Validator::make($request->all(), [
                'delete'                =>    'required|array',
                'delete.*.id'           =>    'required|integer|exists:users_mails,id'
            ]);

            if ($validator->fails()) {
                return self::responseJson($validator->errors()->all(), 'error');
            }
            
            $deleted = [];
            \DB::beginTransaction();
            foreach($parameters['delete'] as $index => $param) {
                $userMail = UserMail::where('id', $param['id'])->first();
                $deleted[] = $userMail;
                $userMail->delete();
            }
            \DB::commit();

            $response = [
                'created' => [],
                'deleted' => $deleted
            ];
            
            return self::responseJson($response);
            
        } catch (Exception $ex) {
            \DB::rollback();
            return self::responseJson($ex->getMessage(), 'error');
        }
    }
}
