<?php

namespace App\Http\Controllers\Questionnaires;

use Illuminate\Http\Request;
use Validator;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Questionnaires\QuestionnaireItem;

class QuestionnairesItemsController extends Controller
{
    public function listQuestionnairesItems(Request $request) {
        
        try {

            $parameters = $request->all();
            
            $validator = Validator::make($request->all(), [
                'with_questionnaires_feedbacks'       =>   'boolean',
                'ids'                                 =>   'array',
                'ids.*.id'                            =>   'integer'
            ]);
            
            if ($validator->fails()) {
                return self::responseJson($validator->errors()->all(), 'error');
            }
            
            $query = QuestionnaireItem::whereNull('deleted_at');
            
            if (isset($parameters['with_questionnaires_feedbacks']) && $parameters['with_questionnaires_feedbacks']) {
                $query->with('questionnaireFeedback');
            }
            
            if (isset($parameters['ids'])) {
                $query->whereIn('id', $parameters['ids']);
            }
            
            $questionnairesItems = $query->get();

            if (!$questionnairesItems) {
                return self::responseJson('Table "questionnaires_items" is empty', 'error');
            }

            $response = $questionnairesItems;
            
            return self::responseJson($response);
        } catch (Exception $ex) {
            return self::responseJson($ex->getMessage(), 'error');
        }
    }
    
    public function addQuestionnaireItem(Request $request) {
        
        try {    

            $parameters = $request->all();

            $validator = Validator::make($request->all(), [
                'create'                                 =>   'required|array',
                'create.*.questionnaires__object_id'     =>   'string',     // add value
                'create.*.value'                         =>   'string'
            ]);

            if ($validator->fails()) {
                return self::responseJson($validator->errors()->all(), 'error');
            }
            
            $created = [];
            \DB::beginTransaction();
            foreach($parameters['create'] as $index => $param) {
                $questionnaireItem = new QuestionnaireItem($param);
                $questionnaireItem->save();
                $created[] = $questionnaireItem;
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
    
    public function updateQuestionnaireItem(Request $request) {
        
        try {    

            $parameters = $request->all();

            $validator = Validator::make($request->all(), [
                'create'                                 =>   'required|array',
                'create.*.id'                            =>   'required|integer|exists:questionnaires_items,id',
                'create.*.questionnaires__object_id'     =>   'string',
                'create.*.value'                         =>   'string'
            ]);

            if ($validator->fails()) {
                return self::responseJson($validator->errors()->all(), 'error');
            }
            
            $updated = [];
            \DB::beginTransaction();
            foreach($parameters['create'] as $index => $param) {
                $questionnaireItem = QuestionnaireItem::where('id', $param['id'])->first();
                $questionnaireItem->update($param);
                $updated[] = $questionnaireItem;
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
    
    public function deleteQuestionnaireItem(Request $request) {
        
        try {    

            $parameters = $request->all();

            $validator = Validator::make($request->all(), [
                'delete'                =>    'required|array',
                'delete.*.id'           =>    'required|integer|exists:questionnaires_items,id'
            ]);

            if ($validator->fails()) {
                return self::responseJson($validator->errors()->all(), 'error');
            }
            
            $deleted = [];
            \DB::beginTransaction();
            foreach($parameters['delete'] as $index => $param) {
                $questionnairesItem = QuestionnaireItem::where('id', $param['id'])->first();
//                if (!$questionnairesItem) {
//                    self::responseJson($index.' element is incorrect..', 'error');
//                }
                $deleted[$index] = $questionnairesItem;
                $questionnairesItem->delete();
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
