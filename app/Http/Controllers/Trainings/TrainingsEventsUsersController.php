<?php

namespace App\Http\Controllers\Trainings;

use Illuminate\Http\Request;
use Validator;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Trainings\TrainingEventUser;
class TrainingsEventsUsersController extends Controller
{
     public function listTrainingsEventsUsers(Request $request) {
        try {

            $parameters = $request->all();

            $validator = Validator::make($request->all(), [

            ]);

            if ($validator->fails()) {
                return self::responseJson($validator->errors()->all(), 'error');
            }

            $query = TrainingEventUser::whereNull('deleted_at');
            $response = $query->get();
            
            return self::responseJson($response);
            
        } catch (Exception $ex) {
            
        }
    }
}
