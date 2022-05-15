<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Routing\Router;

use App\Models\Product;
use App\Models\Cart;
use App\Models\Wishlist;

class ProductController extends Controller
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
    public function category($category)
    {

        $products = [];
        if ($category == 'mens') {
            $products = Product::where('gender', 'MEN')->get();
        } else if ($category == 'womens') {
            $products = Product::where('gender', 'WOMEN')->get();
        } else {
            $products = Product::where('category', $category)->get();
        }

        return view('product.category', ['products' => $products]);
    }

    /**
     * 商品詳細
     */
    public function detail($product_id)
    {
        return view('product.detail', ['item' => Product::where('id', $product_id)->first()]);
    }

    /**
     * カートへ登録しCart画面へ遷移
     */
    public function add_to_cart(Request $request) {
        
        //ユーザ情報取得
        $user = Auth::user();

        $model = new Cart;
        $model->user_id = Auth::id();
        $model->product_id = $request->product_id;
        $model->quantity = $request->quantity;

        //$model->quantity = $quantity = ($request->quantity) ? $request->quantity : 1;

        if ($model->save()){
            return redirect('/cart');
        }
    }

    /**
     * Wishlist へ登録し Wishlist 画面へ遷移
     */
    public function add_to_wishlist(Request $request) {

        $user = Auth::user();

        $model = new Wishlist;
        $model->user_id = Auth::id();
        $model->product_id = $request->product_id;
        if ($model->save()){
            return redirect('/wishlist');
        }
    }
}
