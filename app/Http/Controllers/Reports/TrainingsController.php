<?php

namespace App\Http\Controllers\Reports;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Validator;
use App\Http\Requests;
use App\Models\Trainings\Training;
use App\Http\Controllers\Controller;


class TrainingsController extends Controller
{
    public function showTrainingsStats(Request $request) {
        
        try {

            $parameters = $request->all();

            $validator = Validator::make($request->all(), [
                'start_at'                =>    'date',
                'finish_at'               =>    'date'
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
            
            $date = $start_at->copy();
            
            $stats = [];
            $total = 0;
            
//            while ($date->lt($finish_at)) {
//                $dateString = $date->toDateString();
//                //$stats[] = [$dateString => 0];
//                
//                $count = Training::where('start_at', '>=', $date)
//                                 ->where('finish_at', '<=', $date->copy()->endOfDay())
//                                 ->count();
//                $stats[] = [$dateString  =>  $count];
//                $total += $count;
//                $date->addDay();
//            }
            
            while ($date->lt($finish_at)) {
                $dateString = $date->toDateString();
                $count = Training::where('start_at', '>=', $date)
                                 ->where('finish_at', '<=', $date->copy()->endOfDay())
                                 ->count();
                $stats["$dateString"] = $count;
//                $stats[] = [$dateString => $count];
                //array_add($stats, $dateString, $count);
                $total += $count;
                $date->addDay();
            }
                        
            $response = [
                'total'     =>      $total,
                'stats'     =>      $stats
            ];
                        
            return self::responseJson($response);

        } catch (Exception $ex) {
            return self::responseJson($ex->getMessage(), 'error');
        }
    }
}
