<?php

namespace App\Http\Controllers\Reports;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Validator;
use App\Http\Requests;
use App\Models\Trainings\Training;
use App\Models\Trainings\TrainingContent;
use App\Models\Trainings\TrainingUser;
use App\Models\Questionnaires\Questionnaire;
use App\Models\Questionnaires\QuestionnaireUser;
use App\Http\Controllers\Controller;

class QuestionnairesController extends Controller
{
    public function showQuestionnairesStats(Request $request) {
        
        try {

            $parameters = $request->all();

            $validator = Validator::make($request->all(), [
                'start_at'                =>    'date',
                'finish_at'               =>    'date',
                'training_content_id'    =>    'integer'
            ]);

//            if (!isset($parameters['start_at']) && !isset($parameters['finish_at'])) {
//                return self::responseJson('At least one of parameters is required');
//            }

            if (isset($parameters['start_at'])) {
                $start_at = Carbon::createFromFormat('Y-m-d', $parameters['start_at'])->startOfDay();
            } else {
                $eldestTraining = Training::orderBy('start_at', 'asc')->first();
                $start_at = Carbon::createFromFormat('Y-m-d', $eldestTraining->start_at)->startOfDay();
            }
            
            if (isset($parameters['finish_at'])) {
                $finish_at = Carbon::createFromFormat('Y-m-d', $parameters['finish_at'])->endOfDay();
            } else {
                $finish_at = Carbon::today()->endOfDay();
            }
            
            $stats = [];
            $totalTrainingsUsersAmount = 0;
            $totalQuestionnairesUsersAmount = 0;

            if (isset($parameters['training_content_id'])) {
                $trainingContentId = $parameters['training_content_id'];

                $trainings = Training::where('trainings_contents__id', $trainingContentId);
                
                if ($trainings->count() > 0) {

                    $trainings = $trainings->get();
                    
                    $trainingContent = TrainingContent::where('id', $trainingContentId)->first();
                    $stats['tr'.$trainingContentId]['training_name'] = $trainingContent->name;
//                    $stats[] = ['tr'.$trainingContentId => ['training_anme' => $trainingContent->name]];
                    
                    $questionnaires = Questionnaire::where('trainings_contents__id', $trainingContentId)->get();

                    $maxSeatsAmount = 0;
                    $trainingUsersAmount = 0;
                    $questionnaireUsersAmount = 0;

                    foreach($trainings as $index => $training) {
                        $trainingUsersAmount += TrainingUser::where('trainings__object_id', $training->object_id)
                                                            ->whereNotNull('presence_confirmation')
                                                            ->count();
                        $maxSeatsAmount += $training->seats_amount;
                    }

                    $stats['tr'.$trainingContentId]['max_seats_amount'] = $maxSeatsAmount;
//                    $stats[] = ['tr'.$trainingContentId => ['max_seats_amount' => $maxSeatsAmount]];
                    $totalTrainingsUsersAmount += $trainingUsersAmount;
                    $stats['tr'.$trainingContentId]['users_amount'] = $trainingUsersAmount;
//                    $stats[] = ['tr'.$trainingContentId => ['users_amount' => $trainingUsersAmount]];
                    
                    foreach($questionnaires as $index => $questionnaire) {
                        $questionnaireUsersAmount += QuestionnaireUser::where('questionnaires__object_id', $questionnaire->object_id)
                                                                      ->where('status', 'finished')
                                                                      ->count();
                    }
                    $totalQuestionnairesUsersAmount += $questionnaireUsersAmount;
                    $stats['tr'.$trainingContentId]['questionnaires_amount'] = $questionnaireUsersAmount;
//                    $stats[] = ['tr'.$trainingContentId => ['questionnaires_amount' => $trainingContent->name]];
                }
                
                $response = [
                    'stats'     =>      $stats,
                    'total'     =>      [
                        'total_trainings_users_amount'            =>        $totalTrainingsUsersAmount,
                        'total_questionnaires_users_amount'       =>        $totalQuestionnairesUsersAmount
                    ]
                ];
                
                return self::responseJson($response);
            }
            
            $query = TrainingContent::whereNull('deleted_at');
            //$query->with('training');
            //$query->with('questionnaire');
            
            $trainingsContents = $query->get();

            foreach($trainingsContents as $index => $trainingContent) {
                $trainingContentId = $trainingContent->id;
                
                
                
                $trainings = Training::where('trainings_contents__id', $trainingContentId)
                                     ->where('status', 'finished')
                                     ->where('start_at', '>=', $start_at)
                                     ->where('finish_at', '<=', $finish_at);
                        
                if ($trainings->count() > 0) {
                    
                    $stats['tr'.$trainingContentId]['training_name'] = $trainingContent->name;
                    
                    $trainings = $trainings->get();
                    $questionnaires = Questionnaire::where('trainings_contents__id', $trainingContentId)->get();

                    $trainingUsersAmount = 0;
                    $maxSeatsAmount = 0;

                    foreach($trainings as $index => $training) {
                        $trainingUsersAmount += TrainingUser::where('trainings__object_id', $training->object_id)
                                                            ->whereNotNull('presence_confirmation')
                                                            ->count();
                        $maxSeatsAmount += $training->seats_amount;
                    }

                    $stats['tr'.$trainingContentId]['max_seats_amount'] = $maxSeatsAmount;
                    $totalTrainingsUsersAmount += $trainingUsersAmount;
                    $stats['tr'.$trainingContentId]['users_amount'] = $trainingUsersAmount;

                    $questionnaireUsersAmount = 0;

                    foreach($questionnaires as $index => $questionnaire) {
                        $questionnaireUsersAmount += QuestionnaireUser::where('questionnaires__object_id', $questionnaire->object_id)
                                                                      ->where('status', 'finished')
                                                                      ->count();
                    }
                    $totalQuestionnairesUsersAmount += $questionnaireUsersAmount;
                    $stats['tr'.$trainingContentId]['questionnaires_amount'] = $questionnaireUsersAmount;
                }
            }
            
            $response = [
                'stats'     =>      $stats,
                'total'     =>      [
                    'total trainings users amount'          =>      $totalTrainingsUsersAmount,
                    'total questionnaires users amount'     =>      $totalQuestionnairesUsersAmount
                ]
            ];
            
            return self::responseJson($response);
            
        } catch (Exception $ex) {
            return self::responseJson($ex->getMessage(), 'error');
        }
    }
}
