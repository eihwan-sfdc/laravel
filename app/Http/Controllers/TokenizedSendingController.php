<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TokenizedSendingController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        Log::emergency("\n*************** Tokenized Sending API called ***************\n");
        $this->log($request);

        $token = $request->input('tokens.token');
        Log::emergency($token);

        
        
    }

    public function gettest() {
        echo "gettest";
        return false;
    }

    public function log(Request $request) {

        $headers = [];
        foreach (getallheaders() as $name => $value) {
          $headers[$name] = $value;
        }
    
        $body = $request->all();
    
        Log::emergency("\n*************** REQUEST HEADER ***************\n");
        Log::emergency($headers);
        Log::emergency("\n*************** REQUEST BODY ***************\n");
        Log::emergency(json_encode($body));
        Log::emergency("\n********************************************\n");
      }
}
