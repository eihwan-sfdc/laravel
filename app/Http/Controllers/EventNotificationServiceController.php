<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

/***
 * Event Notification で使うプログラム
 * 昔作ったものであまり記憶にないので自由に変更してもらって構いません。
 * 実装関連ドキュメントはこちら
 * https://developer.salesforce.com/docs/marketing/marketing-cloud/guide/ens-get-started.html
 */
class EventNotificationServiceController extends Controller
{

  public function ens_callbacks(Request $request) {
    Log::emergency("\n*************** save called ***************\n");
    $this->log($request);
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
