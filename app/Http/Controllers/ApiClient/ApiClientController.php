<?php

namespace App\Http\Controllers\ApiClient;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApiClientController extends Controller {

    public function showForm() {
        return \View::make('ApiClient.index');
    }
    
    
    public function sendData(Request $request) {
        set_time_limit(10*60);
        ini_set('memory_limit', '1024M');
        
        $method = $request->input('method');
        $url = $request->input('url');
        $json = $request->input('json');
        $global = $request->input('global');
        
        return $this->sendRequest($method, $url, $json, $global);
    }

    private function sendRequest($method, $url, $feed = '', $global) {
        
        $url = config('apiClient.serverUrl') . $url;
        $response = null;
        $feedString = null;
        $ch = curl_init();

        $token = '';
        if ($feed) {
            $feedArray = json_decode($feed,true);
            $token = ($feedArray['_token']) ? $feedArray['_token'] : '';
        }
        
        curl_setopt( $ch, CURLOPT_URL, $url);
        if ($method == 'POST') {
            curl_setopt($ch, CURLOPT_POST, 1);
            if ($feed) {
                $feedArray = json_decode($feed,true);
                $feedString = http_build_query($feedArray);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $feedString);
            }
        }
        
        $cookie_file = "_cookie_cURL.txt";
        curl_setopt($ch, CURLOPT_COOKIESESSION, true);
        curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file);
        curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file);
                
        curl_setopt($ch, CURLOPT_HEADER, false);
        $headerArray = [
            'Accept: application/json', 
            'X-CSRF-TOKEN: '.$token,
            'Content-Length: ' . (!$feedString ? '0' : strlen($feedString)) 
        ];
                
        //curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headerArray);
        //curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/xml' , 'Accept: application/json' ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
//        dd($response);
        return $response;
    }

}
