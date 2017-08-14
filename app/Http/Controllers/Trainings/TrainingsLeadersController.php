<?php

namespace App\Http\Controllers\Trainings;

use Illuminate\Http\Request;
use Validator;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Trainings\TrainingLeader;

class TrainingsLeadersController extends Controller
{
    public $moduleParams = [
        'moduleId'      => null,
        'moduleCode'    => null
    ];
    
    public function listTrainingsLeaders(Request $request) {
        
        try {

            $parameters = $request->all();
            
            $validator = Validator::make($request->all(), [
                'ids'                            =>   'array',
                'ids.*.id'                       =>   'integer'
            ]);
            
            if ($validator->fails()) {
                return self::responseJson($validator->errors()->all(), 'error');
            }
            
            $query = TrainingLeader::whereNull('deleted_at');
            
            if (isset($parameters['ids'])) {
                $query->whereIn('id', $parameters['ids']);
            }
            
            $trainingsLeaders = $query->get();

            if (!$trainingsLeaders) {
                return self::responseJson('Table "trainings_leaders" is empty', 'error');
            }

            $response = $trainingsLeaders;
            
            return self::responseJson($response);
        } catch (Exception $ex) {
            return self::responseJson($ex->getMessage(), 'error');
        }
    }
    
    public function addTrainingLeader(Request $request) {
        
        try {    

            $parameters = $request->all();

            $validator = Validator::make($request->all(), [
                'create'                            =>   'required|array',
                'create.*.trainings__object_id'     =>   'string',
                'create.*.users__object_id'         =>   'string'
            ]);

            if ($validator->fails()) {
                return self::responseJson($validator->errors()->all(), 'error');
            }
            
            $created = [];
            \DB::beginTransaction();
            foreach($parameters['create'] as $index => $param) {
                $trainingLeader = new TrainingLeader($param);
                $trainingLeader->save();
                $created[] = $trainingLeader;
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
    
    public function updateTrainingLeader(Request $request) {
        
        try {    

            $parameters = $request->all();

            $validator = Validator::make($request->all(), [
                'create'                            =>   'required|array',
                'create.*.id'                       =>   'required|integer|exists:trainings_leaders,id',
                'create.*.trainings__object_id'     =>   'string',
                'create.*.users__object_id'         =>   'string'
            ]);

            if ($validator->fails()) {
                return self::responseJson($validator->errors()->all(), 'error');
            }
            
            $updated = [];
            \DB::beginTransaction();
            foreach($parameters['create'] as $index => $param) {
                $trainingLeader = TrainingLeader::where('id', $param['id'])->first();
                $trainingLeader->update($param);
                $updated[] = $trainingLeader;
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
    
    public function deleteTrainingLeader(Request $request) {
        
        try {    

            $parameters = $request->all();

            $validator = Validator::make($request->all(), [
                'delete'                =>    'required|array',
                'delete.*.id'           =>    'required|integer|exists:trainings_leaders,id'
            ]);

            if ($validator->fails()) {
                return self::responseJson($validator->errors()->all(), 'error');
            }
            
            $deleted = [];
            \DB::beginTransaction();
            foreach($parameters['delete'] as $index => $param) {
                $trainingLeader = TrainingLeader::where('id', $param['id'])->first();
//                if (!$trainingLeader) {
//                    self::responseJson($index.' element is incorrect..', 'error');
//                }
                $deleted[] = $trainingLeader;
                $trainingLeader->delete();
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
