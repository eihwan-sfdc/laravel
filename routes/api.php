<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('line/webhook','LineController@webhook');
Route::post('custom_activity/execute', 'CustomActivityController@execute');
Route::post('custom_activity/save', 'CustomActivityController@custom_save');
Route::post('custom_activity/publish', 'CustomActivityController@custom_publish');
Route::post('custom_activity/validate', 'CustomActivityController@custom_validate');
Route::post('custom_activity/stop', 'CustomActivityController@custom_stop');
Route::post('tokenized', 'TokenizedSendingController@index');


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
