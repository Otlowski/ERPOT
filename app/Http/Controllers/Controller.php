<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Session;

class Controller extends BaseController
{
    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;
    
    public function __construct () {
        $lang = Session::get('locale');
        if ($lang != null) \App::setLocale($lang);
    }
    
    public static function responseJson($message = '', $status = 'success', $error = null) {
        return response()
                ->json(['message' => $message, 
                        'status' => $status,
                        'error' => $error
                        ]);
    }
    
    
}
