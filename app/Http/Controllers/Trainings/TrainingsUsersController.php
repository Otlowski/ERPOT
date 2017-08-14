<?php

namespace App\Http\Controllers\Trainings;

use Illuminate\Http\Request;
use Validator;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Trainings\TrainingUser;

class TrainingsUsersController extends Controller
{
    public $moduleParams = [
        'moduleId'      => null,
        'moduleCode'    => null
    ];
    
    public function listTrainingsUsers(Request $request) {
        
        try {

            $parameters = $request->all();
            
            $validator = Validator::make($request->all(), [
                'ids'                            =>   'array',
                'ids.*.id'                       =>   'integer',
                'trainings__object_id'            =>   'string'
            ]);
            
            if ($validator->fails()) {
                return self::responseJson($validator->errors()->all(), 'error');
            }
            
            $query = TrainingUser::whereNull('deleted_at');
            
            if (isset($parameters['ids'])) {
                $query->whereIn('id', $parameters['ids']);
            }
             if (isset($parameters['trainings__object_id']) && ($parameters['trainings__object_id'])) {
                $query->where('trainings__object_id', $parameters['trainings__object_id']);
            }
            $query->with('user');
            $trainingsUsers = $query->get();

            if (!$trainingsUsers) {
                return self::responseJson('Table "trainings_users" is empty', 'error');
            }
            
            $response = $trainingsUsers;
            
            return self::responseJson($response);
        } catch (Exception $ex) {
            return self::responseJson($ex->getMessage(), 'error');
        }
    }
    
    public function addTrainingUser(Request $request) {
        
        try {    

            $parameters = $request->all();

            $validator = Validator::make($request->all(), [
                'create'                            =>   'required|array',
                'create.*.users__object_id'         =>   'string',
                'create.*.trainings__object_id'     =>   'string',
                'presence_confirmation'             =>   'date'
            ]);

            if ($validator->fails()) {
                return self::responseJson($validator->errors()->all(), 'error');
            }
            
            $created = [];
            \DB::beginTransaction();
            foreach($parameters['create'] as $index => $param) {
                $trainingUser = new TrainingUser($param);
                $trainingUser->save();
                $created[] = $trainingUser;
            }
            \DB::commit();
            
            $response = [
                'created' => $created,
                'deleted' => []
            ];
            
            return self::responseJson($response);
            
        } catch (Exception $ex) {
            \DB::rollback();
            return self::responseJson($ex->getMessage(), 'error');
        }
    }
    
    public function updateTrainingUser(Request $request) {
        
        try {    

            $parameters = $request->all();

            $validator = Validator::make($request->all(), [
                'create'                            =>   'required|array',
                'create.*.id'                       =>   'required|integer|exists:trainings_users,id',
                'create.*.users__object_id'         =>   'string',
                'create.*.trainings__object_id'     =>   'string',
                'presence_confirmation'             =>   'date'
            ]);

            if ($validator->fails()) {
                return self::responseJson($validator->errors()->all(), 'error');
            }
            
            $updated = [];
            \DB::beginTransaction();
            foreach($parameters['create'] as $index => $param) {
                $trainingUser = TrainingUser::where('id', $param['id'])->first();
                $trainingUser->update($param);
                $updated[] = $trainingUser;
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
    
    public function deleteTrainingUser(Request $request) {
        
        try {    

            $parameters = $request->all();

            $validator = Validator::make($request->all(), [
                'delete'                =>    'required|array',
                'delete.*.id'           =>    'required|integer|exists:trainings_users,id'
            ]);

            if ($validator->fails()) {
                return self::responseJson($validator->errors()->all(), 'error');
            }
            
            $deleted = [];
            \DB::beginTransaction();
            foreach($parameters['delete'] as $index => $param) {
                $trainingUser = TrainingUser::where('id', $param['id'])->first();
//                if (!$trainingUser) {
//                    self::responseJson($index.' element is incorrect..', 'error');
//                }
                $deleted[] = $trainingUser;
                $trainingUser->delete();
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
    
    public function showQuestionnairesUsersStats(Request $request) {
        
    }
}
