<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

/***
 * Tokenized Sending を使うために作成したプログラムと思われる。。あまり記憶にないので試したい方は修正してもらって構いません。
 * Tokenized Sending については以下のページをご覧ください。
 * https://help.salesforce.com/s/articleView?id=sf.mc_overview_implement_tokenized_sending.htm&type=5
 */
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
    
            if (count($items) > 0) {

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
                        
                    }
                }

            } else {
                    
                $res = array();
                $res['tokenRequestId'] = $tokenRequestId;
                $res['message'] = 'Invalid token; token does not exist.';
                array_push($resultArray['unresolvedTokens'], $res);

            }
            
        }

        $response = json_encode($resultArray);
        Log::emergency(json_encode($resultArray));
        echo $response;

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
