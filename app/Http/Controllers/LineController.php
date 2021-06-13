<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class LineController extends Controller
{

  public function webhook(Request $request) {

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

    $response = Http::withHeaders($headers)->post('https://cl.s10.exct.net:443/Response_LineOriginated.ashx?channelId=1654168336', $body);

    Log::emergency("\n*************** RESPONSE ***************\n");
    Log::emergency($response);
    Log::emergency("\n********************************************\n");
  }
}
