<?php 

namespace App\Http\Controllers\Reports;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Validator;
use App\Http\Requests;
use App\Http\Controllers\Controller;


class ReportsController extends Controller
{
    
    public $moduleParams = [
        'moduleId'      => null,
        'moduleCode'    => null
    ];
    
    public function showTrainingsIndex(Request $request) {
        
        return \View::make('Reports.Trainings.report');
        
    }
    
    public function showQuestionnairesIndex(Request $request) {
        
        return \View::make('Reports.Questionnaires.report');
        
    }
    
}