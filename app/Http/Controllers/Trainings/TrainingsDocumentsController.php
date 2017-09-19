<?php

namespace App\Http\Controllers\Trainings;

use Illuminate\Http\Request;
use Validator;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Trainings\TrainingDocument;

class TrainingsDocumentsController extends Controller
{
    public $moduleParams = [
        'moduleId'      => null,
        'moduleCode'    => null
    ];

    public function listTrainingsDocuments(Request $request) {

        try {

            $parameters = $request->all();

            $validator = Validator::make($request->all(), [
                'trainings_contents__id'  =>   'integer'
            ]);

            if ($validator->fails()) {
                return self::responseJson($validator->errors()->all(), 'error');
            }

            $query = TrainingDocument::whereNull('deleted_at');

            if (isset($parameters['trainings_contents__id'])) {
                $query->where('trainings_contents__id', $parameters['trainings_contents__id']);
            }

            $trainingsDocuments = $query->get();
            // dd($trainingsDocuments);
            if (!$trainingsDocuments) {
                return self::responseJson('Table "trainings_documents" is empty', 'error');
            }

            $response = $trainingsDocuments;

            return self::responseJson($response);
        } catch (Exception $ex) {
            return self::responseJson($ex->getMessage(), 'error');
        }
    }

    public function addTrainingDocument(Request $request) {

        try {

            $parameters = $request->all();

            $validator = Validator::make($request->all(), [
                'create'                               =>   'required|array',
                'create.*.trainings_contents__id'      =>   'integer',
                'create.*.name'                        =>   'string',
                'create.*.description'                 =>   'string',
                'create.*.source'                      =>   'string'
            ]);

            if ($validator->fails()) {
                return self::responseJson($validator->errors()->all(), 'error');
            }

            $created = [];
            \DB::beginTransaction();
            foreach($parameters['create'] as $index => $param) {
                $trainingDocument = new TrainingDocument($param);
                $trainingDocument->save();
                $created[] = $trainingDocument;
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

    public function updateTrainingDocument(Request $request) {

        try {

            $parameters = $request->all();

            $validator = Validator::make($request->all(), [
                'create'                               =>   'required|array',
                'create.*.id'                          =>   'required|integer|exists:trainings_documents,id',
                'create.*.trainings_contents__id'      =>   'integer',
                'create.*.name'                        =>   'string',
                'create.*.description'                 =>   'string',
                'create.*.source'                      =>   'string'
            ]);

            if ($validator->fails()) {
                return self::responseJson($validator->errors()->all(), 'error');
            }

            $updated = [];
            \DB::beginTransaction();
            foreach($parameters['create'] as $index => $param) {
                $trainingDocument = TrainingDocument::where('id', $param['id'])->first();
                $trainingDocument->update($param);
                $updated[] = $trainingDocument;
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

    public function deleteTrainingDocument(Request $request) {

        try {

            $parameters = $request->all();

            $validator = Validator::make($request->all(), [
                'delete'                =>    'required|array',
                'delete.*.id'           =>    'required|integer|exists:trainings_documents,id'
            ]);

            if ($validator->fails()) {
                return self::responseJson($validator->errors()->all(), 'error');
            }

            $deleted = [];
            \DB::beginTransaction();
            foreach($parameters['delete'] as $index => $param) {
                $trainingDocument = TrainingDocument::where('id', $param['id'])->first();
//                if (!$trainingDocument) {
//                    self::responseJson($index.' element is incorrect..', 'error');
//                }
                $deleted[] = $trainingDocument;
                $trainingDocument->delete();
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

   public function downloadDocument($filename) {

        try {
            $path = config('app_storage.documents_path');
            return response()->download($path.$filename, $filename);

        } catch (Exception $e) {
            return self::responseJson($ex->getMessage(), 'error');
        }
   }
}
