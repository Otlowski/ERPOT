<?php 

namespace App\Http\Controllers\Events;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Validator;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Trainings\TrainingEvent;
use App\Models\Trainings\TrainingUser;
use App\Models\Trainings\TrainingContent;
use App\Models\Trainings\TrainingEventContent;
use App\Models\Trainings\TrainingEventUser;

class EventsController extends Controller
{
    public function addEvent(Request $request) {
        
        try {    

            $parameters = $request->all();

            $validator = Validator::make($request->all(), [
                'create'                                   =>   'required|array',
                'create.*.traininigs_groups__id'           =>   'string',
                'create.*.name'                            =>   'required|string',
                'create.*.rooms__object_id'                =>   'string',
                'create.*.start_at'                        =>   'required|date',
                'create.*.finish_at'                       =>   'required|date',
                'users__objects_ids'                       =>   'array',
                'trainings_contents__ids'                  =>   'array',

            ]);
            if ($validator->fails()) {
                return self::responseJson($validator->errors()->all(), 'error', 'error');
            }
            //Arrays
            $event = [];
            $createTU = []; //create TrainingUser
            $createTEC = [];//create TrainingEventContent
            $createTEU = [];//create TrainingEventUser
            $findTC = [];   //find TrainingContent
            $trainingUserIds = [];
            
            
            \DB::beginTransaction();
            
            //create TrainingEvent
            foreach($parameters['create'] as $index => $param) {
                $trainingEvent = new TrainingEvent($param);
                $trainingEvent->object_id = $trainingEvent->setObjectId();
                $trainingEvent->save();
                $event[] = $trainingEvent;
            }
            
            if(isset($parameters['users__objects_ids']) && $parameters['users__objects_ids']){
                
                //create TrainingUser
                foreach($parameters['users__objects_ids'] as $index =>$object_id){
                    $trainingUser = new TrainingUser;
                    $trainingUser->users__object_id = $object_id;
                    $trainingUser->trainings_events__object_id = $trainingEvent->object_id;
                    $trainingUser->save();
                    $createTU[] = $trainingUser;
                    //collect Ids to create other PIVOT
                    $trainingUserIds[] = $trainingUser->id; 
                }
                //create TrainingEventUser[PIVOT]
                foreach($trainingUserIds as $id){
                   $trainingEventUser = new TrainingEventUser;
                   $trainingEventUser->trainings_events__id = $trainingEvent->id;
                   $trainingEventUser->trainings_users__id = $id;
                   $trainingEventUser->save();
                   $createTEU[] = $trainingEventUser;
                }
            }
           
            if(isset($parameters['trainings_contents__ids']) && $parameters['trainings_contents__ids']){
                
                //find TrainingContent
                foreach($parameters['trainings_contents__ids'] as $index =>$id){
                    $query  = TrainingContent::whereNull('deleted_at');
                    $trainingContent = $query->where('id', '=' ,$id)->get();
                    $findTC[] = $trainingContent;
                }
                //create TrainingEventContent[PIVOT]
                foreach($parameters['trainings_contents__ids'] as $index =>$id){
                   $trainingEventContent = new TrainingEventContent;
                   $trainingEventContent->trainings_events__id = $trainingEvent->id;
                   $trainingEventContent->trainings_contents__id = $id;
                   $trainingEventContent->save();
                   $createTEC[] = $trainingEventContent;
                }
            }
            
            \DB::commit();
            $event['trainings_users']                  = $createTU;
            $event['trainings_contents']               = $findTC;
            $event['[PIVOT]trainings_events_contents'] = $createTEC;
            $event['[PIVOT]trainings_events_users']    = $createTEU;
            
            $response = [
                'TrainingEvent'                => $event,
                'deleted'                      => []
            ];
            return self::responseJson($response);
            
        } catch (Exception $ex) {
            \DB::rollback();
            return self::responseJson($ex->getMessage(), 'error');
        }
    }
    
    public function updateEvent(Request $request) {
        
        try {    

            $parameters = $request->all();

            $validator = Validator::make($request->all(), [
                'create'                                =>   'required|array',
                'create.*.id'                           =>   'required|integer|exists:trainings_events',
                'create.*.trainings_groups__id'         =>   'string',
                'create.*.name'                         =>   'string',
                'create.*.rooms__object_id'             =>   'string',
                'create.*.start_at'                     =>   'date',
                'create.*.finish_at'                    =>   'date',
                'users__objects_ids'                    =>   'array',
                'trainings_contents__ids'               =>   'array',
            ]);

            if ($validator->fails()) {
                return self::responseJson($validator->errors()->all(), 'error');
            }
            \DB::beginTransaction();
            /*create TRAINING EVENT*/
            $createdEvent = [];
            $deletedEvent = [];
            $createTEC = [];
            $deleteTEC = [];
            //create TrainingEvent
            foreach($parameters['create'] as $index => $param) {
                $trainingEvent = TrainingEvent::where('id', $param['id'])->first();
                $newEvent = new TrainingEvent($param);
                $newEvent->object_id = $trainingEvent->object_id;
                $deletedEvent[] = $trainingEvent;
                $trainingEvent->delete();
                $newEvent->save();
                $createdEvent []= $newEvent;       
            }
            
            /* [PIVOT] TRAINING EVENT CONTENT */
            
            if (isset($parameters['trainings_contents__ids']) && $parameters['trainings_contents__ids']) {
                //create [PIVOTS] TrainingEventContent
                foreach ($parameters['trainings_contents__ids'] as $index => $param) {
                    $TEC = new TrainingEventContent();
                    $TEC->trainings_events__id = $newEvent->id;
                    $TEC->trainings_contents__id = $param;
                    $TEC->save();
                    $createTEC[] = $TEC;
                }
                //get all pivots
                $eventContents = TrainingEventContent::where('trainings_events__id', $trainingEvent->id)->get();
                //delete old [PIVOTS] TrainingEventContent
                foreach ($eventContents as $index => $eventContent) {
                    $eventContent->delete();
                    $deleteTEC[] = $eventContent;
                }
            }

            /* [PIVOT] TRAINING EVENT USER */
            $createdTU = [];
            $deleteTU = [];
            $createTEU = [];
            $deleteTEU = [];
            $trainingUsersIds = [];
            
            if (isset($parameters['users__objects_ids']) && $parameters['users__objects_ids']) {
                
                //delete previous TrainingsUsers
                $deleteTrainingUsers = TrainingUser::where('trainings_events__object_id', $trainingEvent->object_id)->get();
                foreach ($deleteTrainingUsers as $index => $previousTU) {
                    $previousTU->delete();
                    $deleteTU[] = $previousTU;
                }
                //create TrainingsUsers
                foreach ($parameters['users__objects_ids'] as $index => $param) {
                    $trainingUser = new TrainingUser();
                    $trainingUser->users__object_id = $param;
                    $trainingUser->trainings_events__object_id = $newEvent->object_id;
                    $trainingUser->save();
                    $createdTU[] = $trainingUser;
                    $trainingUsersIds[] = $trainingUser->id;
                }
                //create [PIVOTS] TrainingEventUser
                foreach ($trainingUsersIds as $index => $userId) {
                    $TEU = new TrainingEventUser();
                    $TEU->trainings_events__id = $newEvent->id;
                    $TEU->trainings_users__id = $userId;
                    $TEU->save();
                    $createTEU[] = $TEU;
                }
                
                //delete old [PIVOTS] TrainingEventUser
                $deleteEventUsers = TrainingEventUser::where('trainings_events__id', $trainingEvent->id)->get();
                foreach ($deleteEventUsers as $index => $eventUser) {
                    $eventUser->delete();
                    $deleteTEU[] = $eventUser;
                }
                
            }
            \DB::commit();
            $response = [
                'createdTrainingEvent'         => $createdEvent,
                'deletedTrainingEvent'         => $deletedEvent,
                'createdTrainingEventContents' => $createTEC,
                'deletedTrainingEventContents' => $deleteTEC,
                'createdTrainingUsers'         => $createdTU,
                'deletedTrainingUsers'         => $deleteTU,
                'createdTrainingEventUsers'    => $createTEU,
                'deletedTrainingEventUsers'    => $deleteTEU,
            ];
            
            return self::responseJson($response);
            
        } catch (Exception $ex) {
            \DB::rollback();
            return self::responseJson($ex->getMessage(), 'error');
        }
    }
    public function deleteEvent(Request $request) {
        try {

            $parameters = $request->all();

            $validator = Validator::make($request->all(), [
                        'id' => 'required|integer|exists:trainings_events',
            ]);

            if ($validator->fails()) {
                return self::responseJson($validator->errors()->all(), 'error');
            }
            \DB::beginTransaction();
            
           
            $deletedTU     = [];
            $deletedTECs   = [];
            $deletedTEUs   = [];  
            
            $trainingEvent = TrainingEvent::where('id', $parameters['id'])->first();
            $trainingEventContents = TrainingEventContent::where('trainings_events__id', $parameters['id'])->get();
            $trainingEventUsers    = TrainingEventUser::where('trainings_events__id', $parameters['id'])->get();

            //delete TrainingEventContents
            if(count($trainingEventContents) > 0){
                foreach($trainingEventContents as $TEC)
                {   $TECdelete     =  $TEC;
                    $deletedTECs[] =  $TEC;
                    $TECdelete     -> delete();

                }
            }
            //delete TrainingEventUsers
            if(count($trainingEventContents) > 0){
                foreach($trainingEventUsers as $TEU)
                {   
                    $trainingUser  =  TrainingUser::where('id', $TEU->trainings_users__id)->first();
                    $deletedTU[]   =  $trainingUser;
                    $trainingUser  -> delete();
                    
                    $TEUdelete     =  $TEU;
                    $deletedTEUs[] =  $TEU;
                    $TEUdelete     -> delete();
                }
            }
            
            $response['trainings_events']          = $trainingEvent;
            $response['trainings_users']           = $deletedTU;
            $response['trainings_events_contents'] = $deletedTECs;
            $response['trainings_events_users']    = $deletedTEUs;
            
            $trainingEvent->delete();
            \DB::commit();
            return self::responseJson($response);
        } catch (Exception $ex) {
            \DB::rollback();
            return self::responseJson($ex->getMessage(), 'error');
        }
    }

}