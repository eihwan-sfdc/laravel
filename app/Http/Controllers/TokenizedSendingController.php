<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
    public function index()
    {
        return '{
            "resolvedTokens": [
                {
                    "tokenRequestId":"abc123thn567",
                    "tokenValue": "user2@gmail.com"
                }
            ]
        }';
    }

    public function gettest() {
        echo "gettest";
        return false;
    }
}
