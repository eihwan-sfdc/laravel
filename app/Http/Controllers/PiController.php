<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/***
 * 何のために作成したのか覚えていないので自由に変えてもらって構いません。
 */
class PiController extends Controller
{
  public function index () {
      return view ('index', [
          'param1' => 'param1',
          'param2' => 'param2',
          ]);
  }

  public function product_updateItem () {
      return view ('pi/product_updateItem', [
          'param1' => 'param1',
          'param2' => 'param2',
          ]);
  }

  public function content_updateItem () {
      return view ('pi/content_updateItem', [
          'param1' => 'param1',
          'param2' => 'param2',
          ]);
  }

  public function banner_updateItem () {
      return view ('pi/banner_updateItem', [
          'param1' => 'param1',
          'param2' => 'param2',
          ]);
  }

  public function product($id = '') {
    return view ('pi/product', [
        'id' => $id,
        ]);
  }

  public function content($id = '') {
    return view ('pi/content', [
        'id' => $id,
        ]);
  }

  public function banner($id = '') {
    return view ('pi/banner', [
        'id' => $id,
        ]);
  }
}
