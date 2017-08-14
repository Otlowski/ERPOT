<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use Validator;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Users\UserSession;

class UsersSessionsController extends Controller
{
    public function listUsersSessions(Request $request) {
        
        try {

            $validator = Validator::make($request->all(), [
                'ids'                            =>   'array',
                'ids.*.id'                       =>   'integer'
            ]);
            
            if ($validator->fails()) {
                return self::responseJson($validator->errors()->all(), 'error');
            }
            
            $query = UserSession::whereNull('deleted_at');
            
            if (isset($parameters['ids'])) {
                $query->whereIn('id', $parameters['ids']);
            }
            
            $usersSessions = $query->get();

            if (!$usersSessions) {
                return self::responseJson('Table "users_sessions" is empty', 'error');
            }

            $response = $usersSessions;
            
            return self::responseJson($response);
        } catch (Exception $ex) {
            return self::responseJson($ex->getMessage(), 'error');
        }
    }
    
    public function addUserSession(Request $request) {
        
        try {    

            $parameters = $request->all();

            $validator = Validator::make($request->all(), [
                'create'                            =>   'required|array',
                'create.*.users__object_id'         =>   'string',
                'create.*.start_at'                 =>   'date',
                'create.*.finish_at'                =>   'date',
                'create.*.hash'                     =>   'string'
            ]);

            if ($validator->fails()) {
                return self::responseJson($validator->errors()->all(), 'error');
            }
            
            $created = [];
            $deleted = [];
            \DB::beginTransaction();
            foreach($parameters['create'] as $index => $param) {
                $userSession = new UserSession($param);
                $userSession->save();
                $created[] = $userSession;
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
    
    public function updateUserSession(Request $request) {
        
        try {    

            $parameters = $request->all();

            $validator = Validator::make($request->all(), [
                'create'                            =>   'required|array',
                'create.*.id'                       =>   'required|integer|exists:users_sessions,id',
                'create.*.users__object_id'         =>   'string',
                'create.*.start_at'                 =>   'date',
                'create.*.finish_at'                =>   'date',
                'create.*.hash'                     =>   'string'
            ]);

            if ($validator->fails()) {
                return self::responseJson($validator->errors()->all(), 'error');
            }
            
            $updated = [];
            \DB::beginTransaction();
            foreach($parameters['create'] as $index => $param) {
                $userSession = UserSession::where('id', $param['id'])->first();
                $userSession->update($param);
                $updated[] = $userSession;
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
    
    public function deleteUserSession(Request $request) {
        
        try {    

            $parameters = $request->all();

            $validator = Validator::make($request->all(), [
                'delete'                =>    'required|array',
                'delete.*.id'           =>    'required|integer|exists:users_sessions,id'
            ]);

            if ($validator->fails()) {
                return self::responseJson($validator->errors(), 'error');
            }
            
            $deleted = [];
            \DB::beginTransaction();
            foreach($parameters['delete'] as $index => $param) {
                $userSession = UserSession::where('id', $param['id'])->first();
//                if (!$userSession) {
//                    self::responseJson($index.' element is incorrect..', 'error');
//                }
                $deleted[] = $userSession;
                $userSession->delete();
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
}
