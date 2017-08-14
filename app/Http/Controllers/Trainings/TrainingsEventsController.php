<?php 

namespace App\Http\Controllers\Trainings;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Validator;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Trainings\TrainingEvent;
use App\Models\Trainings\TrainingContent;
use App\Models\Trainings\TrainingEventContent;
use App\Models\Trainings\TrainingEventUser;
use App\Models\Trainings\TrainingUser;
use App\Models\Users\User;

class TrainingsEventsController extends Controller
{
    
    public $moduleParams = [
        'moduleId'      => null,
        'moduleCode'    => null
    ];
    
    public function showTrainingsIndex() {

        return view('Trainings.index');
    }
    
    public function showTrainingsCalendar(){
        
        return view('Trainings.calendar');
    }

    public function listTrainingsEvents(Request $request) {
        
        try {

            $parameters = $request->all();
//            dd($parameters);
            $validator = Validator::make($request->all(), [
                'with_trainings_users'                  =>   'boolean',
                'with_trainings_notes'                  =>   'boolean',
                'with_trainings_leaders'                =>   'boolean',
                'object_ids'                            =>   'array',
                'object_ids.*.object_id'                =>   'string',
                'date'                                  =>   'date'
            ]);
            
            if ($validator->fails()) {
                return self::responseJson($validator->errors()->all(), 'error');
            }
            
            $query = TrainingEvent::whereNull('deleted_at');
            
            if (isset($parameters['with_trainings_notes']) && $parameters['with_trainings_notes']) {
                $query->with('trainingNote');
            }
            
            if (isset($parameters['with_trainings_leaders']) && $parameters['with_trainings_leaders']) {
                $query->with('trainingLeader');
            }
            
            if (isset($parameters['with_trainings_users']) && $parameters['with_trainings_users']) {
                $query->with('trainingUser');
            }
            
            if (isset($parameters['object_ids'])) {
                $query->whereIn('object_id', $parameters['object_ids']);
            }
            
            if (isset($parameters['date'])) {
                //string in iso format 
                $dateIsoString = $parameters['date'];
                //set local timezone
                $localTimeZone  = timezone_name_from_abbr("CET");
                //remove unless elements from string 
                $dateUtcString = substr($dateIsoString,0,19);
                $dateUtcString = str_replace("T", ' ',$dateUtcString);
                //create UTC date
                $utcDate = Carbon::createFromFormat('Y-m-d H:i:s',$dateUtcString,new \DateTimeZone('UTC'));
                //clone date in local timezone
                $localDate = clone $utcDate;
                $localDay = $localDate->setTimeZone(new \DateTimeZone($localTimeZone));
                
                
                $dayStartAt = $localDay->copy()->startOfDay();
                $dayFinishAt = $localDay->copy()->endOfDay();
                $query ->where('start_at' ,'>=', $dayStartAt)
                       ->where('finish_at','<', $dayFinishAt)
                       ->withCount('trainingUser')
                       ->orderBy('start_at', 'asc');
            }
            $todayDate = date("Y-m-d");
            $trainings = $query->where('start_at' ,'>=', $todayDate)->get();
            
            if (!$trainings) {
                return self::responseJson('Table "trainings" is empty', 'error');
            }

            $response = $trainings;
            
            return self::responseJson($response);
        } catch (Exception $ex) {
            return self::responseJson($ex->getMessage(), 'error');
        }
    }
    
    public function addTrainingEvent(Request $request) {
        
        try {    

            $parameters = $request->all();

            $validator = Validator::make($request->all(), [
                'create'                                   =>   'required|array',
                'create.*.rooms__object_id'                =>   'string',
                'create.*.trainings_contents__id'          =>   'integer',
                'create.*.seats_amount'                    =>   'integer',
                'create.*.status'                          =>   'string',
                'create.*.start_at'                        =>   'date',
                'create.*.finish_at'                       =>   'date'
            ]);

            if ($validator->fails()) {
                return self::responseJson($validator->errors()->all(), 'error');
            }
            
            $created = [];
            \DB::beginTransaction();
            foreach($parameters['create'] as $index => $param) {
                $training = new TrainingEvent($param);
                $training->object_id = $training->setObjectId();
                $training->seats_left = $training->seats_amount;
                $training->save();
                $created[] = $training;
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
    
    public function updateTrainingEvent(Request $request) {
        
        try {    

            $parameters = $request->all();

            $validator = Validator::make($request->all(), [
                'create'                                   =>   'required|array',
                'create.*.object_id'                       =>   'required|string|exists:trainings_events,object_id',
                'create.*.rooms__object_id'                =>   'string',
                'create.*.trainings_contents__id'          =>   'integer',
                'create.*.seats_amount'                    =>   'integer',
                'create.*.status'                          =>   'string',
                'create.*.start_at'                        =>   'date',
                'create.*.finish_at'                       =>   'date'
            ]);

            if ($validator->fails()) {
                return self::responseJson($validator->errors()->all(), 'error');
            }
            
            $created = [];
            $deleted = [];
            \DB::beginTransaction();
            foreach($parameters['create'] as $index => $param) {
                $training = TrainingEvent::where('object_id', $param['object_id'])->orderBy('revision', 'desc')->first();
//                if (!$training) {
//                    self::responseJson($index.' element is incorrect..', 'error');
//                }
                $deleted[] = $training;
                $newTraining = new TrainingEvent($param);
                $newTraining->object_id = $training->object_id;
                $newTraining->incrementRevision();
                $newTraining->seats_left = $newTraining->seats_amount;
                $newTraining->checkSeatsAmount();
                $newTraining->save();
                $training->delete();
                $created[] = $newTraining;
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
    
    public function deleteTrainingEvent(Request $request) {
        
        try {    

            $parameters = $request->all();

            $validator = Validator::make($request->all(), [
                'delete'                =>    'required|array',
                'delete.*.object_id'    =>    'required|string|exists:trainings_events,object_id'
            ]);

            if ($validator->fails()) {
                return self::responseJson($validator->errors()->all(), 'error');
            }
            
            $deleted = [];
            \DB::beginTransaction();
            foreach($parameters['delete'] as $index => $param) {
                $training = TrainingEvent::where('object_id', $param['object_id'])->first();
//                if (!$training) {
//                    self::responseJson($index.' element is incorrect..', 'error');
//                }
                $deleted[] = $training;
                $training->delete();
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
    
    public function detailsTrainingEvent(Request $request) {
        
        try {    

            $parameters = $request->all();

            $validator = Validator::make($request->all(), [
                    'id'     =>    'required|integer|exists:trainings_events,id',
            ]);

            if ($validator->fails()) {
                return self::responseJson($validator->errors()->all(), 'error');
            }

            if(isset($parameters['id']) && ($parameters['id'])) {
                $trainingEvent = TrainingEvent::where('id', '=', $parameters['id']);
            }

            if (empty($trainingEvent)) {
                return self::responseJson('Training Event does not exist', 'error', null);
            }
            //create Arrays to store data
            $trainingsContentsArray  = [];
            $trainingsUsersArray     = [];
            $users                   = [];
            
            $trainingsEventsContents = TrainingEventContent::where('trainings_events__id','=', $parameters['id'])
                                       ->get();
            $trainingEventUsers      = TrainingEventUser::where('trainings_events__id','=', $parameters['id'])
                                       ->get();
            //For each Pivot find TrainingContent and push to array
            foreach($trainingsEventsContents as $teC){
                $trainingContent = TrainingContent::where('id',$teC->trainings_contents__id)->first();
                $trainingsContentsArray[]= $trainingContent;
            }
            //For each Pivot find TrainingUser and push to array
            foreach ($trainingEventUsers as $teU){
                $trainingUser = TrainingUser::where('id',$teU->trainings_users__id)->first();
                if(isset($trainingUser)){
                    $trainingsUsersArray[] = $trainingUser;
                }
            }
            //Check if it is not empty
            if(!empty($trainingsUsersArray)){
                foreach($trainingsUsersArray as $user){
                    $trainingUser = User::where('object_id', $user->users__object_id)->first();
                    $users[] = $trainingUser;
                }  
            }
            
//          $response['trainings_events_contents'] = $trainingsEventsContents;
//          $response['trainings_events_users'] = $trainingEventUsers;
            $response['trainings_users']  = $trainingsUsersArray;
            $response['training_event'] = $trainingEvent->get();
            $response['trainings_contents'] = $trainingsContentsArray;
            $response['users'] = $users;
//            dd($users);
            return self::responseJson($response);
        } catch (\Exception $ex) {
            return self::responseJson($ex->getMessage(), 'error', null);
        }
    }
}