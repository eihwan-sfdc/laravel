<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

/***
 * GroupConnect を利用する際に、Line の Webhook に MC のエンドポイントを直接設定せず外部サーバーを設定しても
 * Lineからのリクエストを完全再現すれば問題なく動作することを検証するためのプログラム
 */
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

    //下記の URL を MC のエンドポイントに変更する必要がある。。定数は .env ファイルを参照。
    //Refactoring 後テストしていない。
    $response = Http::withHeaders($headers)->post(config('app.GROUPCONNECT_ENDPOINT'), $body);

    Log::emergency("\n*************** RESPONSE ***************\n");
    Log::emergency($response);
    Log::emergency("\n********************************************\n");
  }
}
