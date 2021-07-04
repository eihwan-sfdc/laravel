<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Illuminate\Routing\Router;

use Carbon\Carbon;

class CartController extends Controller
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
    public function index()
    {
        //$items = Cart::where('user_id', Auth::id())->get();
        $items = DB::table('carts')
                    ->join('products', 'carts.product_id', '=', 'products.id')
                    ->select('carts.*', 'products.*')
                    ->where('carts.user_id', Auth::id())
                    ->get();
        $items = json_decode(json_encode($items), true);
        $total_price = 0;
        foreach($items as $item) {
            $total_price = $total_price + $item['sale_price'];
        }
        $tax = $total_price / 10;
        $date = Carbon::now();
        return view('cart.index', ['items' => $items, 'total_price' => $total_price, 'tax' => $tax, 'timestamp' => $date->getTimestamp()]);
    }

    public function delete()
    {

    }
}
