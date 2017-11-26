<?php

namespace App\Http\Middleware;

use Closure, Session, Auth;
use App\Models\Users\UserSession;

class Login {
    
    
    public function handle($request, Closure $next) {
        $params = $request->all();
        
        if( !isset($params['hash'])){
            return new Response('You are not logged in..', 403);
        }

        $sessionHash = UserSession::where('hash',$params['hash'])
                                  ->where('finish_at','>=',date('Y-m-d H:i:s'))
                                  ->orderBy('created_at',"desc")
                                  ->first();
        if(!$sessionHash){
            return new Response('You are not logged in..', 403);
        }
        
        return $next($request);
    }   
}