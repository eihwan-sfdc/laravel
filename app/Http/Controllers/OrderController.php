<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Illuminate\Routing\Router;
use Carbon\Carbon;

class OrderController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Router $router)
    {
        //$this->middleware('auth');
    }

    /**
     * 商品購入後注文情報ページに遷移
     */
    public function checkout(Request $request)
    {

        $user_id = Auth::id();

        //画面のproduct_id, quantity を配列を取得
        $product_ids = $request->product_ids;
        $quantiries = $request->quantities;

        //order number は簡易的にSystem Timeoutとする
        $date = Carbon::now();
        $order_id = $date->getTimestamp();

        //カート内数分 save 実行
        foreach($product_ids as $index => $product_id ) {
            $model = new Order;
            $model->order_id = $order_id;
            $model->user_id = Auth::id();
            $model->product_id = $product_id;
            $model->quantity = $quantiries[$index];
            $model->save();
        }

        //カートを空にして購入詳細画面に遷移
        Cart::where('user_id', $user_id)->delete();
        return redirect("confirmation/$order_id");
    }
}
