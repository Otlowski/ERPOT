<?php

namespace App\Http\Controllers\Questionnaires;

use Illuminate\Http\Request;
use Validator;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Questionnaires\QuestionnaireFeedback;

class QuestionnairesFeedbacksController extends Controller
{
    public function listQuestionnairesFeedbacks(Request $request) {
        
        try {

            $parameters = $request->all();
            
            $validator = Validator::make($request->all(), [
                'ids'                            =>   'array',
                'ids.*.id'                       =>   'integer'
            ]);
            
            if ($validator->fails()) {
                return self::responseJson($validator->errors()->all(), 'error');
            }
            
            $query = QuestionnaireFeedback::whereNull('deleted_at');
            
            if (isset($parameters['ids'])) {
                $query->whereIn('id', $parameters['ids']);
            }
            
            $questionnairesFeedbacks = $query->get();

            if (!$questionnairesFeedbacks) {
                return self::responseJson('Table "questionnaires_feedbacks" is empty', 'error');
            }

            $response = $questionnairesFeedbacks;
            
            return self::responseJson($response);
        } catch (Exception $ex) {
            return self::responseJson($ex->getMessage(), 'error');
        }
    }
    
    public function addQuestionnaireFeedback(Request $request) {
        
        try {    

            $parameters = $request->all();

            $validator = Validator::make($request->all(), [
                'create'                                =>   'required|array',
                'create.*.questionnaires_items__id'     =>   'integer',
                'create.*.value'                        =>   'string',
                'create.*.username'                     =>   'string'      // users_id ???
            ]);

            if ($validator->fails()) {
                return self::responseJson($validator->errors()->all(), 'error');
            }
            
            $created = [];
            \DB::beginTransaction();
            foreach($parameters['create'] as $index => $param) {
                $questionnaireFeedback = new QuestionnaireFeedback($param);
                $questionnaireFeedback->save();
                $created[] = $questionnaireFeedback;
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
    
    public function updateQuestionnaireFeedback(Request $request) {
        
        try {    

            $parameters = $request->all();

            $validator = Validator::make($request->all(), [
                'create'                                =>   'required|array',
                'create.*.id'                           =>   'required|integer|exists:questionnaires_feedbacks,id',
                'create.*.questionnaires_items__id'     =>   'integer',
                'create.*.value'                        =>   'string',
                'create.*.username'                     =>   'string'      // users_id ???
            ]);

            if ($validator->fails()) {
                return self::responseJson($validator->errors()->all(), 'error');
            }
            
            $updated = [];
            \DB::beginTransaction();
            foreach($parameters['create'] as $index => $param) {
                $questionnaireFeedback = QuestionnaireFeedback::where('id', $param['id'])->first();
                $questionnaireFeedback->update($param);
                $updated[] = $questionnaireFeedback;
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
    
    public function deleteQuestionnaireFeedback(Request $request) {
        
        try {    

            $parameters = $request->all();

            $validator = Validator::make($request->all(), [
                'delete'                =>    'required|array',
                'delete.*.id'           =>    'required|integer|exists:questionnaires_feedbacks,id'
            ]);

            if ($validator->fails()) {
                return self::responseJson($validator->errors()->all(), 'error');
            }
            
            $deleted = [];
            \DB::beginTransaction();
            foreach($parameters['delete'] as $index => $param) {
                $questionnairesFeedback = QuestionnaireFeedback::where('id', $param['id'])->first();
//                if (!$questionnairesFeedback) {
//                    self::responseJson($index.' element is incorrect..', 'error');
//                }
                $deleted[] = $questionnairesFeedback;
                $questionnairesFeedback->delete();
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
