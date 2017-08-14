<?php

namespace App\Http\Controllers\Trainings;

use Illuminate\Http\Request;
use Validator;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Trainings\TrainingEventContent;
use App\Models\Trainings\TrainingEvent;
use App\Models\Trainings\TrainingContent;
use Carbon\Carbon;

class TrainingEventContentController extends Controller {

    public function listTrainingsEventsContents(Request $request) {
        try {

            $parameters = $request->all();

            $validator = Validator::make($request->all(), [
                        'date' => 'date'
            ]);

            if ($validator->fails()) {
                return self::responseJson($validator->errors()->all(), 'error');
            }

            //check if traininig Event exist in this 
            $TrainingEventDay = TrainingEvent::whereNull('deleted_at');


            if (isset($parameters['date'])) {
                //string in iso format 
                $dateIsoString = $parameters['date'];
                //set local timezone
                $localTimeZone = timezone_name_from_abbr("CET");
                //remove unless elements from string 
                $dateUtcString = substr($dateIsoString, 0, 19);
                $dateUtcString = str_replace("T", ' ', $dateUtcString);
                //create UTC date
                $utcDate = Carbon::createFromFormat('Y-m-d H:i:s', $dateUtcString, new \DateTimeZone('UTC'));
                //clone date in local timezone
                $localDate = clone $utcDate;
                $localDay = $localDate->setTimeZone(new \DateTimeZone($localTimeZone));
                $dayStartAt = $localDay->copy()->startOfDay();
                $dayFinishAt = $localDay->copy()->endOfDay();
                $TrainingEventDay->where('start_at', '>=', $dayStartAt)
                                 ->where('finish_at', '<', $dayFinishAt)
                                 ->orderBy('start_at', 'asc');
            }

            $trainingsEvents = $TrainingEventDay->get();

            if (!$trainingsEvents) {
                return self::responseJson('No trainings', 'error');
            }

            foreach ($trainingsEvents as $teIndex => &$trainingEvent) {

                // 1. na podstawie PIVOT pobieramy wszystkie powiązane kontenty
                $trainingsEventsContents = TrainingEventContent::where('trainings_events__id', $trainingEvent->id)
                        ->get();
                $trainingEvent['events_contents'] = $trainingsEventsContents;

                // 2. dla wszystkich znalezionych wpisów dodajemy informacje szczegołowe o contencie / zawartosci kursu
                foreach ($trainingEvent['events_contents'] as $tecIndex => &$trainingEventContent) {
                    $trainingEventContent['content'] = TrainingContent::where('id', $trainingEventContent->trainings_contents__id)
                            ->first();
                }
            }
            return self::responseJson($trainingsEvents);
        } catch (Exception $ex) {
            
        }
    }

}
