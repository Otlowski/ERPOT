<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use Validator;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Users\UserRegisterHash;

class UsersRegisterHashesController extends Controller
{
    public function listUsersRegisterHashes(Request $request) {
        
        try {

            $parameters = $request->all();
            
            $validator = Validator::make($request->all(), [
                'ids'                            =>   'array',
                'ids.*.id'                       =>   'integer'
            ]);
            
            if ($validator->fails()) {
                return self::responseJson($validator->errors()->all(), 'error');
            }
            
            $query = UserRegisterHash::whereNull('deleted_at');
            
            if (isset($parameters['ids'])) {
                $query->whereIn('id', $parameters['ids']);
            }
            
            $usersRegisterHashes = $query->get();

            if (!$usersRegisterHashes) {
                return self::responseJson('Table "users_register_hashes" is empty', 'error');
            }

            $response = $usersRegisterHashes;
            
            return self::responseJson($response);
        } catch (Exception $ex) {
            return self::responseJson($ex->getMessage(), 'error');
        }
    }
    
    public function addUserRegisterHash(Request $request) {
        
        try {    

            $parameters = $request->all();

            $validator = Validator::make($request->all(), [
                'create'                            =>   'required|array',
                'create.*.users__object_id'         =>   'string',
                'create.*.hash'                     =>   'string',
                'create.*.start_at'                 =>   'date',
                'create.*.finish_at'                =>   'date'
            ]);

            if ($validator->fails()) {
                return self::responseJson($validator->errors()->all(), 'error');
            }
            
            $created = [];
            \DB::beginTransaction();
            foreach($parameters['create'] as $index => $param) {
                $userRegisterHash = new UserRegisterHash($param);
                $userRegisterHash->save();
                $created[$index] = $userRegisterHash;
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
    
    public function updateUserRegisterHash(Request $request) {
        
        try {    

            $parameters = $request->all();

            $validator = Validator::make($request->all(), [
                'create'                            =>   'required|array',
                'create.*.id'                       =>   'required|integer|exists:users_register_hashes,id',
                'create.*.users__object_id'         =>   'string',
                'create.*.hash'                     =>   'string',
                'create.*.start_at'                 =>   'date',
                'create.*.finish_at'                =>   'date'
            ]);

            if ($validator->fails()) {
                return self::responseJson($validator->errors()->all(), 'error');
            }
            
            $updated = [];
            \DB::beginTransaction();
            foreach($parameters['create'] as $index => $param) {
                $userRegisterHash = UserRegisterHash::where('id', $param['id'])->first();
                $userRegisterHash->update($param);
                $updated[] = $userRegisterHash;
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
    
    public function deleteUserRegisterHash(Request $request) {
        
        try {    

            $parameters = $request->all();

            $validator = Validator::make($request->all(), [
                'delete'                =>    'required|array',
                'delete.*.id'           =>    'required|integer|exists:users_register_hashes,id'
            ]);

            if ($validator->fails()) {
                return self::responseJson($validator->errors()->all(), 'error');
            }
            
            $deleted = [];
            \DB::beginTransaction();
            foreach($parameters['delete'] as $index => $param) {
                $userRegisterHash = UserRegisterHash::where('id', $param['id'])->first();
//                if (!$userRegisterHash) {
//                    self::responseJson($index.' element is incorrect..', 'error');
//                }
                $deleted[] = $userRegisterHash;
                $userRegisterHash->delete();
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
