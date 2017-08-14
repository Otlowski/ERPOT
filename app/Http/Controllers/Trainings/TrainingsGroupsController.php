<?php

namespace App\Http\Controllers\Trainings;

use Illuminate\Http\Request;
use Validator;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Trainings\TrainingGroup;

class TrainingsGroupsController extends Controller
{
       public $moduleParams = [
        'moduleId' => null,
        'moduleCode' => null
    ];
     
    public function listTrainingsGroups(Request $request) {

        try {

            $parameters = $request->all();

            $validator = Validator::make($request->all(), [
                        'with_trainings' => 'boolean',
                        'with_trainings_contents' =>'boolean'
            ]);

            if ($validator->fails()) {
                return self::responseJson($validator->errors()->all(), 'error');
            }

            $query = TrainingGroup::whereNull('deleted_at');

            if (isset($parameters['with_trainings']) && $parameters['with_trainings']) {
                $query->with('trainings');
            }
            
            if (isset($parameters['with_trainings_contents']) && $parameters['with_trainings_contents']) {
                $query->with('trainingsContents');
            }

            $trainingsGroups = $query->get();

            if (!$trainingsGroups) {
                return self::responseJson('Table "trainings_groups" is empty', 'error');
            }

            $response = $trainingsGroups;

            return self::responseJson($response);
        } catch (Exception $ex) {
            return self::responseJson($ex->getMessage(), 'error');
        }
    } 
       
    public function addTrainingsGroups(Request $request) {
        
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
                $trainingGroup = new TrainingGroup($param);
                $trainingGroup->save();
                $created[$index] = $trainingGroup;
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
    
    public function updateTrainingsGroups(Request $request) {
        
        try {    

            $parameters = $request->all();
            
            $validator = Validator::make($request->all(), [
                'create'                            =>   'required|array',
                'create.*.id'                       =>   'required|exists:trainings_groups,id',
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
                
                $trainingGroup = TrainingGroup::where('id', $param['id'])->first();
                
                $deletedGroup = new TrainingGroup();
                $deletedGroup->id = $trainingGroup->id;
                $deletedGroup->description = $trainingGroup->description;
                $deletedGroup->name = $trainingGroup->name;
                
                $newTrainingGroup =  $trainingGroup;
                $newTrainingGroup->update($param);
                $deleted[]= $deletedGroup;
                $created[] = $newTrainingGroup;
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
    
    public function deleteTrainingsGroups(Request $request) {
        
        try {    

            $parameters = $request->all();

            $validator = Validator::make($request->all(), [
                'delete'         =>    'required|array',
                'delete.*.id'    =>    'required|integer|exists:trainings_groups,id'
            ]);

            if ($validator->fails()) {
                return self::responseJson($validator->errors()->all(), 'error','error');
            }
            
            $deleted = [];
            \DB::beginTransaction();
            foreach($parameters['delete'] as $index => $param) {
                $trainingGroup = TrainingGroup::where('id', $param['id'])->first();
//                if (!$trainingGroup) {
//                    self::responseJson($index.' element is incorrect..', 'error');
//                }
                $trainings = $trainingGroup->trainings;
                if(count($trainings) > 0){
                    return self::responseJson('Cannot delete , Group  has containing trainings', 'error', '-0051');
                }
                $deleted[] = $trainingGroup;
                $trainingGroup->delete();
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
    public function detailsTrainingsGroups(Request $request) {
        
        try {    

            $parameters = $request->all();

            $validator = Validator::make($request->all(), [
                    'id'     =>    'required|integer|exists:trainings_groups,id',
            ]);

            if ($validator->fails()) {
                return self::responseJson($validator->errors()->all(), 'error');
            }

            if(isset($parameters['id']) && ($parameters['id'])) {
                $userGroup = TrainingGroup::where('id', '=', $parameters['id']);
            }

            if (empty($userGroup)) {
                return self::responseJson('Training Group does not exist', 'error', null);
            }

            $response = $userGroup->with('trainings')->first(); 
            
            return self::responseJson($response);
        } catch (\Exception $ex) {
            return self::responseJson($ex->getMessage(), 'error', null);
        }
    }
    
    
}
