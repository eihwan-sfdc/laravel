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

        return '{
            "tokens": [
              {
                "tokenRequestId": "abc123thn567",
                "token": "999911112222",
              "subscriberKey": "abc123456xyz”
              }
            ]
          }';
    }

    public function gettest() {
        echo "gettest";
        return false;
    }
}
