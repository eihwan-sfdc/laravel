<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

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

        $tokens = $request->input('tokens');
        $token = $tokens[0]['token'];
        Log::emergency($token);
        
        $items = DB::table('tokenized')
                    ->select('*')
                    ->where('email_token', $token)
                    ->get();

        $resultArray = array();
        if ($items) {
            $resultArray['resolvedTokens'] = [];
            $resultArray['resolvedTokens']['tokenRequestId'] = $token;
            $resultArray['resolvedTokens']['tokenValue'] = $items[0]['subkey'];
        } else {
            $resultArray['unresolvedTokens'] = [];
            $resultArray['unresolvedTokens']['tokenRequestId'] = $token;
            $resultArray['unresolvedTokens']['message'] = 'Invalid token; token does not exist.' ;
        }

        $response = json_encode($resultArray);
        Log::emergency(json_encode($resultArray));
        echo $response;

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
