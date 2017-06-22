<?php

namespace App\Http\Controllers\Trainings;

use Illuminate\Http\Request;
use Validator;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Trainings\TrainingContent;

class TrainingsContentsController extends Controller
{
    public $moduleParams = [
        'moduleId'      => null,
        'moduleCode'    => null
    ];
    
    public function listTrainingsContents(Request $request) {
        
        try {

            $parameters = $request->all();
            
            $validator = Validator::make($request->all(), [
                'trainings_groups__id'            =>   'exists:trainings_groups,id',
                'with_trainings'                  =>   'boolean',
                'with_trainings_documents'        =>   'boolean',
                'with_trainings_chapters'         =>   'boolean',
                'ids'                             =>   'array',
                'ids.*.id'                        =>   'integer'
            ]);
            
            if ($validator->fails()) {
                return self::responseJson($validator->errors()->all(), 'error');
            }
            
            $query = TrainingContent::whereNull('deleted_at');
            
            if (isset($parameters['trainings_groups__id']) && $parameters['trainings_groups__id']) {
                $query->where('trainings_groups__id', '=', $parameters['trainings_groups__id']);      
            }
            
            if (isset($parameters['with_trainings']) && $parameters['with_trainings']) {
                $query->with('training');
            }
            
            if (isset($parameters['with_trainings_documents']) && $parameters['with_trainings_documents']) {
                $query->with('trainingDocument');
            }
            
            if (isset($parameters['with_trainings_chapters']) && $parameters['with_trainings_chapters']) {
                $query->with('trainingChapter');
            }
            
            if (isset($parameters['ids'])) {
                $query->whereIn('id', $parameters['ids']);
            }
            
            $trainingContents = $query->with('trainingChapter')->orderBy('name','asc')->get();
            

            if (!$trainingContents) {
                return self::responseJson('Table "trainings_contents" is empty', 'error');
            }

            $response = $trainingContents;
            
            return self::responseJson($response);
        } catch (Exception $ex) {
            return self::responseJson($ex->getMessage(), 'error');
        }
    }
    
    public function addTrainingContent(Request $request) {
        
        try {    

            $parameters = $request->all();

            $validator = Validator::make($request->all(), [
                'create'                                =>   'required|array',
                'create.*.name'                         =>   'string',
                'create.*.description'                  =>   'string'
            ]);

            if ($validator->fails()) {
                return self::responseJson($validator->errors()->all(), 'error');
            }
            
            $created = [];
            \DB::beginTransaction();
            foreach($parameters['create'] as $index => $param) {
                $trainingContent = new TrainingContent($param);
                $trainingContent->save();
                $created[] = $trainingContent;
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
    
    public function updateTrainingContent(Request $request) {
        
        try {    

            $parameters = $request->all();

            $validator = Validator::make($request->all(), [
                'create'                                =>   'required|array',
                'create.*.id'                           =>   'required|integer|exists:trainings_contents',
                'create.*.name'                         =>   'string',
                'create.*.description'                  =>   'string'
            ]);

            if ($validator->fails()) {
                return self::responseJson($validator->errors()->all(), 'error');
            }
            
            $updated = [];
            \DB::beginTransaction();
            foreach($parameters['create'] as $index => $param) {
                $trainingContent = TrainingContent::where('id', $param['id'])->first();
                $trainingContent->update($param);
                $updated[] = $trainingContent;
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
    
    public function deleteTrainingContent(Request $request) {
        
        try {    

            $parameters = $request->all();

            $validator = Validator::make($request->all(), [
                'delete'                =>    'required|array',
                'delete.*.id'           =>    'required|integer|exists:trainings_contents,id'
            ]);

            if ($validator->fails()) {
                return self::responseJson($validator->errors()->all(), 'error');
            }
            
            $deleted = [];
            \DB::beginTransaction();
            foreach($parameters['delete'] as $index => $param) {
                $trainingContent = TrainingContent::where('id', $param['id'])->first();
//                if (!$trainingContent) {
//                    self::responseJson($index.' element is incorrect..', 'error');
//                }
                $deleted[] = $trainingContent;
                $trainingContent->delete();
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
    
    public function detailsTrainingContent(Request $request) {

        try {

            $parameters = $request->all();

            $validator = Validator::make($request->all(), [
                        'id' => 'required|integer|exists:trainings_contents,id'
            ]);

            if ($validator->fails()) {
                return self::responseJson($validator->errors()->all(), 'error');
            }

            if (isset($parameters['id']) && ($parameters['id'])) {
                $TrainingContent = TrainingContent::where('id', '=', $parameters['id']);
            }

            if (empty($TrainingContent)) {
                return self::responseJson('Training Content does not exist', 'error', null);
            }
            $response = $TrainingContent->withCount('trainingChapter')->first();

            return self::responseJson($response);
        } catch (\Exception $ex) {
            return self::responseJson($ex->getMessage(), 'error', null);
        }
    }

}
