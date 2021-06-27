<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Illuminate\Routing\Router;


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
     * 商品カテゴリ
     */
    public function checkout(Request $request)
    {

        $user_id = Auth::id();

        $product_ids = $request->product_ids;
        foreach($product_ids as $product_id) {
            $model = new Order;
            $model->user_id = Auth::id();
            $model->product_id = $product_id;
            $model->save();
        }
        $carts = Cart::where('user_id', $user_id)->delete();
        return redirect('/checkout_complete');
    }
}
