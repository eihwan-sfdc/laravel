<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Illuminate\Routing\Router;

use Carbon\Carbon;
use App\Models\Order;

/***
 * 購入結果画面
 */
class ConfirmationController extends Controller
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
    public function index($order_id)
    {
        $items = DB::table('orders')
                ->join('products', 'orders.product_id', '=', 'products.id')
                ->select('orders.*', 'products.*')
                ->where('user_id', Auth::id())
                ->where('order_id' , $order_id)
                ->get();

        $array = json_decode(json_encode($items), true);

        $total_price = 0;
        foreach ($array as $item) {
            $total_price = $total_price + $item['sale_price'];
        }
        return view('confirmation.index', ['order_id' => $order_id, 'items' => $array, 'total_price' => $total_price]);
    }

}
