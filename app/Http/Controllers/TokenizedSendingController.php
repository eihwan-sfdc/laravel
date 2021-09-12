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

        // $token_array = json_decode($tokens);
        Log::emergency("\n*************** TOKENS COUNT ***************\n");
        Log::emergency(count($tokens));

        $resultArray = array();
        $resultArray['resolvedTokens'] = [];
        $resultArray['unresolvedTokens'] = [];

        foreach ($tokens as $index => $token){
            Log::emergency($token); 
            $tokenRequestId = $token['tokenRequestId'];

            $items = DB::table('tokenized')
            ->select('*')
            ->where('email_token', $token['token'])
            ->get();
    
            Log::emergency("\n*************** ITEMS COUNT ***************\n");
            Log::emergency(count($items));

            foreach ($items as $item) {
                $email_address = $item->email_address;
                $first_name = $item->first_name;
                $last_name = $item->last_name;

                if ($email_address) {
                    $res = array();
                    $res['tokenRequestId'] = $tokenRequestId;
                    $res['tokenValue'] = $email_address;
                    array_push($resultArray['resolvedTokens'], $res);
                } else {
                    $res = array();
                    $res['tokenRequestId'] = $tokenRequestId;
                    $res['message'] = 'Invalid token; token does not exist.' ;
                    array_push($resultArray['unresolvedTokens'], $res);
                }
            }
        }

        $response = json_encode($resultArray);
        Log::emergency(json_encode($resultArray));
        echo $response;

        // $token = $tokens[0]['token'];
        // $tokenRequestId = $tokens[0]['tokenRequestId'];
        
        
        // $items = DB::table('tokenized')
        //             ->select('*')
        //             ->where('email_token', $token)
        //             ->get();

        // $email_address='';
        // $resultArray = array();
        // foreach($items as $item) {
        //     $email_address = $item->email_address;
        //     $first_name = $item->first_name;
        //     $last_name = $item->last_name;

        //     if ($email_address) {
        //         $resultArray['resolvedTokens'] = [];
        //         $resultArray['resolvedTokens'][0]['tokenRequestId'] = $tokenRequestId;
        //         $resultArray['resolvedTokens'][0]['tokenValue'] = $email_address;
        //     } else {
        //         $resultArray['unresolvedTokens'] = [];
        //         $resultArray['unresolvedTokens'][0]['tokenRequestId'] = $tokenRequestId;
        //         $resultArray['unresolvedTokens'][0]['message'] = 'Invalid token; token does not exist.' ;
        //     }

        // }

        
        

        // $response = json_encode($resultArray);
        // Log::emergency(json_encode($resultArray));
        // echo $response;

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
