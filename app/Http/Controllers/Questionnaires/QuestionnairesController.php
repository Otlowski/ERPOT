<?php

namespace App\Http\Controllers\Questionnaires;

use Illuminate\Http\Request;
use Validator;
use App\Http\Requests;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Models\Questionnaires\Questionnaire;
use App\Models\Questionnaires\QuestionnaireUser;
use App\Models\Trainings\Training;
use App\Models\Trainings\TrainingContent;
use App\Models\Trainings\TrainingUser;

class QuestionnairesController extends Controller
{
    public $moduleParams = [
        'moduleId'      => null,
        'moduleCode'    => null
    ];
        
    public function listQuestionnaires(Request $request) {
        
        try {
            
            $parameters = $request->all();
            
            $validator = Validator::make($request->all(), [
                'with_questionnaires_items'             =>   'boolean',
                'with_questionnaires_users'             =>   'boolean',
                'object_ids'                            =>   'array',
                'object_ids.*.object_id'                =>   'string'
            ]);
            
            if ($validator->fails()) {
                return self::responseJson($validator->errors()->all(), 'error');
            }
            
            $query = Questionnaire::whereNull('deleted_at');

            if (isset($parameters['with_questionnaires_items']) && $parameters['with_questionnaires_items']) {
                $query->with('questionnaireItem');
            }
            
            if (isset($parameters['with_questionnaires_users']) && $parameters['with_questionnaires_users']) {
                $query->with('questionnaireUser');
            }
            
            if (isset($parameters['object_ids'])) {
                $query->whereIn('object_id', $parameters['object_ids']);
            }
            
            $questionnaires = $query->get();

            if (!$questionnaires) {
                return self::responseJson('Table "questionnaires" is empty', 'error');
            }

            $response = $questionnaires;
            
            return self::responseJson($response);
        } catch (Exception $ex) {
            return self::responseJson($ex->getMessage(), 'error');
        }
    }
    
    public function addQuestionnaire(Request $request) {
        
        try {    

            $parameters = $request->all();

            $validator = Validator::make($request->all(), [
                'create'                            =>   'required|array',
                'create.*.trainings_contents__id'   =>   'integer',
                'create.*.name'                     =>   'string',
                'create.*.description'              =>   'string',
                'create.*.status'                   =>   'string',
                'create.*.source'                   =>   'string',
            ]);

            if ($validator->fails()) {
                return self::responseJson($validator->errors()->all(), 'error');
            }
            
            $created = [];
            \DB::beginTransaction();
            foreach($parameters['create'] as $index => $param) {
                $questionnaire = new Questionnaire($param);
                $questionnaire->object_id = $questionnaire->setObjectId();
                $questionnaire->save();
                $created[] = $questionnaire;
            }
            \DB::commit();
            
            $response = [
                'created'   =>   $created,
                'deleted'   =>   []
            ];
            
            return self::responseJson($response);
            
        } catch (Exception $ex) {
            \DB::rollback();
            return self::responseJson($ex->getMessage(), 'error');
        }
    }
    
    public function updateQuestionnaire(Request $request) {
        
        try {    

            $parameters = $request->all();

            $validator = Validator::make($request->all(), [
                'create'                            =>   'required|array',
                'create.*.object_id'                =>   'required|string|exists:questionnaires,object_id',
                'create.*.trainings_contents__id'   =>   'integer',
                'create.*.name'                     =>   'string',
                'create.*.description'              =>   'string',
                'create.*.status'                   =>   'string',
                'create.*.source'                   =>   'string'
            ]);

            if ($validator->fails()) {
                return self::responseJson($validator->errors(), 'error');
            }
            
            $created = [];
            $deleted = [];
            \DB::beginTransaction();
            foreach($parameters['create'] as $index => $param) {
                $questionnaire = Questionnaire::where('object_id', $param['object_id'])->orderBy('revision', 'desc')->first();
//                if (!$questionnaire) {
//                    self::responseJson($index.' element is incorrect..', 'error');
//                }
                
                $newQuestionnaire = new Questionnaire($param);
                $newQuestionnaire->object_id = $questionnaire->object_id;
                $newQuestionnaire->incrementRevision();
                $deleted[] = $questionnaire;
                $questionnaire->delete();
                $newQuestionnaire->save();
                $created[] = $newQuestionnaire;
            }
            \DB::commit();
            
            $response = [
                'created'   =>   $created,
                'deleted'   =>   $deleted
            ];
            
            return self::responseJson($response);
            
        } catch (Exception $ex) {
            \DB::rollback();
            return self::responseJson($ex->getMessage(), 'error');
        }
    }
    
    public function deleteQuestionnaire(Request $request) {
        
        try {    

            $parameters = $request->all();

            $validator = Validator::make($request->all(), [
                'delete'                =>    'required|array',
                'delete.*.object_id'    =>    'required|string|exists:questionnaires,object_id'
            ]);

            if ($validator->fails()) {
                return self::responseJson($validator->errors()->all(), 'error');
            }
            
            $deleted = [];
            \DB::beginTransaction();
            foreach($parameters['delete'] as $index => $param) {
                $questionnaire = Questionnaire::where('object_id', $param['object_id'])->first();
//                if (!$questionnaire) {
//                    self::responseJson($index.' element is incorrect..', 'error');
//                }
                $deleted[] = $questionnaire;
                $questionnaire->delete();
            }
            \DB::commit();

            $response = [
                'created'   =>   [],
                'deleted'   =>   $deleted
            ];
            
            return self::responseJson($response);
            
        } catch (Exception $ex) {
            \DB::rollback();
            return self::responseJson($ex->getMessage(), 'error');
        }
    }
}