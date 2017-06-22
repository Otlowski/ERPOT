<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use Validator;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Users\UserGroup;

class UsersGroupsController extends Controller
{
       public $moduleParams = [
        'moduleId' => null,
        'moduleCode' => null
    ];
     
    public function listUsersGroups(Request $request) {

        try {

            $parameters = $request->all();

            $validator = Validator::make($request->all(), [
                        'with_users' => 'boolean',
            ]);

            if ($validator->fails()) {
                return self::responseJson($validator->errors()->all(), 'error');
            }

            $query = UserGroup::whereNull('deleted_at');

            if (isset($parameters['with_users']) && $parameters['with_users']) {
                $query->with('users');
            }

            $usersGroups = $query->get();

            if (!$usersGroups) {
                return self::responseJson('Table "users_groups" is empty', 'error');
            }

            $response = $usersGroups;

            return self::responseJson($response);
        } catch (Exception $ex) {
            return self::responseJson($ex->getMessage(), 'error');
        }
    } 
       
    public function addUsersGroups(Request $request) {
        
        try {    

            $parameters = $request->all();

            $validator = Validator::make($request->all(), [
                'create'                           =>   'required|array',
                'create.*.name'                    =>   'required|string',
                'create.*.description'             =>   'required|string',
            ]);

            if ($validator->fails()) {
                return self::responseJson($validator->errors()->all(), 'error', 'error');
            }
            
            $created = [];
            \DB::beginTransaction();
            foreach($parameters['create'] as $index => $param) {
                $userGroup = new UserGroup($param);
                $userGroup->save();
                $created[$index] = $userGroup;
            }
            \DB::commit();
            
            $response = [
                'created'   =>  $created,
                'deleted'   =>  []
            ];
            
            return self::responseJson($response);
            
        } catch (Exception $ex) {
            \DB::rollback();
            return self::responseJson($ex->getMessage(), 'error','error');
        }
    }
    
    public function updateUsersGroups(Request $request) {
        
        try {    

            $parameters = $request->all();
            
            $validator = Validator::make($request->all(), [
                'create'                            =>   'required|array',
                'create.*.id'                       =>   'required|exists:users_groups,id',
                'create.*.name'                     =>   'required|string',
                'create.*.description'              =>   'string',
            ]);

            if ($validator->fails()) {
                return self::responseJson($validator->errors()->all(), 'error','error');
            }
            
            $created = [];
            $deleted = [];
            \DB::beginTransaction();
            foreach($parameters['create'] as $index => $param) {
                
                $userGroup = UserGroup::where('id', $param['id'])->first();
                
                $deletedGroup = new UserGroup();
                $deletedGroup->id = $userGroup->id;
                $deletedGroup->description = $userGroup->description;
                $deletedGroup->name = $userGroup->name;
                
                $newUserGroup =  $userGroup;
                $newUserGroup->update($param);
                $deleted[]= $deletedGroup;
                $created[] = $newUserGroup;
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
    
    public function deleteUsersGroups(Request $request) {
        
        try {    

            $parameters = $request->all();

            $validator = Validator::make($request->all(), [
                'delete'         =>    'required|array',
                'delete.*.id'    =>    'required|integer|exists:users_groups,id'
            ]);

            if ($validator->fails()) {
                return self::responseJson($validator->errors()->all(), 'error','error');
            }
            
            $deleted = [];
            \DB::beginTransaction();
            foreach($parameters['delete'] as $index => $param) {
                $userGroup = UserGroup::where('id', $param['id'])->first();
//                if (!$userGroup) {
//                    self::responseJson($index.' element is incorrect..', 'error');
//                }
                $users = $userGroup->users;
                if(count($users) > 0){
                    return self::responseJson('Cannot delete , Group  has containing users', 'error', '-0051');
                }
                $deleted[] = $userGroup;
                $userGroup->delete();
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
    public function detailsUsersGroups(Request $request) {
        
        try {    

            $parameters = $request->all();

            $validator = Validator::make($request->all(), [
                    'id'     =>    'required|integer|exists:users_groups,id'
            ]);

            if ($validator->fails()) {
                return self::responseJson($validator->errors()->all(), 'error');
            }

            if(isset($parameters['id']) && ($parameters['id'])) {
                $userGroup = UserGroup::where('id', '=', $parameters['id'])->first();
            }

            if (empty($userGroup)) {
                return self::responseJson('User Group does not exist', 'error', null);
            }


            return self::responseJson($userGroup);
        } catch (\Exception $ex) {
            return self::responseJson($ex->getMessage(), 'error', null);
        }
    }
    
    
}
