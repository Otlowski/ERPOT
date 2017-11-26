<?php

namespace App\Http\Controllers\Trainings;

use Illuminate\Http\Request;
use Validator;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Trainings\TrainingChapter;

class TrainingsChaptersController extends Controller
{
    public $moduleParams = [
        'moduleId'      => null,
        'moduleCode'    => null
    ];
    
    public function listTrainingsChapters(Request $request) {
        
        try {
            
            $parameters = $request->all();
            
            $validator = Validator::make($request->all(), [
                'trainings_contents__id'         =>   'exists:trainings_contents,id',
                'ids'                            =>   'array',
                'ids.*.id'                       =>   'integer'
            ]);
            
            if ($validator->fails()) {
                return self::responseJson($validator->errors()->all(), 'error');
            }
            
            $query = TrainingChapter::whereNull('deleted_at');
            
            if (isset($parameters['trainings_contents__id']) && $parameters['trainings_contents__id']) {
                $query->where('trainings_contents__id', '=', $parameters['trainings_contents__id']);      
            }
            if (isset($parameters['ids'])) {
                $query->whereIn('id', $parameters['ids']);
            }
            
            $trainingsChapters = $query->get();

            if (!$trainingsChapters) {
                return self::responseJson('Table "trainings_chapters" is empty', 'error');
            }

            $response = $trainingsChapters;
            
            return self::responseJson($response);
        } catch (Exception $ex) {
            return self::responseJson($ex->getMessage(), 'error');
        }
    }
    
    public function addTrainingChapter(Request $request) {
        
        try {    

            $parameters = $request->all();

            $validator = Validator::make($request->all(), [
                'create'                               =>   'required|array',
                'create.*.trainings_contents__id'      =>   'integer',
                'create.*.value'                       =>   'string'
            ]);

            if ($validator->fails()) {
                return self::responseJson($validator->errors()->all(), 'error');
            }
            
            $created = [];
            \DB::beginTransaction();
            foreach($parameters['create'] as $index => $param) {
                $trainingChapter = new TrainingChapter($param);
                $trainingChapter->save();
                $created[] = $trainingChapter;
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
    
    public function updateTrainingChapter(Request $request) {
        
        try {    

            $parameters = $request->all();

            $validator = Validator::make($request->all(), [
                'create'                               =>   'required|array',
                'create.*.id'                          =>   'required|integer|exists:trainings_chapters,id',
                'create.*.trainings_contents__id'      =>   'integer',
                'create.*.value'                       =>   'string'
            ]);

            if ($validator->fails()) {
                return self::responseJson($validator->errors()->all(), 'error');
            }
            
            $updated = [];
            \DB::beginTransaction();
            foreach($parameters['create'] as $index => $param) {
                $trainingChapter = TrainingChapter::where('id', $param['id'])->first();
                $trainingChapter->update($param);
                $updated[] = $trainingChapter;
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
    
    public function deleteTrainingChapter(Request $request) {
        
        try {    

            $parameters = $request->all();

            $validator = Validator::make($request->all(), [
                'delete'                =>    'required|array',
                'delete.*.id'           =>    'required|integer|exists:trainings_chapters,id'
            ]);

            if ($validator->fails()) {
                return self::responseJson($validator->errors()->all(), 'error');
            }
            
            $deleted = [];
            \DB::beginTransaction();
            foreach($parameters['delete'] as $index => $param) {
                $trainingChapter = TrainingChapter::where('id', $param['id'])->first();
//                if (!$trainingChapter) {
//                    self::responseJson($index.' element is incorrect..', 'error');
//                }
                $deleted[] = $trainingChapter;
                $trainingChapter->delete();
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
