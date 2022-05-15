<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

/***
 * Journey Builder の Custom Activity をテストするためのプログラム
 * 昔作ったものであまり記憶にないので自由に変更してもらって構いません。
 * 実装関連ドキュメントはこちら
 * https://developer.salesforce.com/docs/marketing/marketing-cloud/guide/creating-activities.html
 */
class CustomActivityController extends Controller
{
  public function index() {
    Log::emergency("\n*************** inde called ***************\n");
    return view ('customactivity/index', [
        'param1' => 'param1',
        'param2' => 'param2',
        ]);
  }

  public function execute(Request $request) {
    Log::emergency("\n*************** execute called ***************\n");
    $this->log($request);

    $returnArray = array("foundSignupDate"=>"2016-03-10");
    return json_encode($returnArray);
  }

  public function custom_save(Request $request) {
    Log::emergency("\n*************** save called ***************\n");
    $this->log($request);
  }

  public function custom_publish(Request $request) {
    Log::emergency("\n*************** publish called ***************\n");
    $this->log($request);
  }

  public function custom_validate(Request $request) {
    Log::emergency("\n*************** validate called ***************\n");
    $this->log($request);
  }

  public function custom_stop(Request $request) {
    Log::emergency("\n*************** stop called ***************\n");
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
