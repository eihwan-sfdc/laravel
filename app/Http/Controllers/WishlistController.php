<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Illuminate\Routing\Router;

class WishlistController extends Controller
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
     * WishList 表示
     */
    public function index()
    {

        // Wishlist と Product をJoinしてデータを取得
        // wishlists.id はなぜか wishlists.* でうまいこと取れなかったので alias をつけて取得
        $items = DB::table('wishlists')
                    ->join('products', 'wishlists.product_id', '=', 'products.id')
                    ->select('wishlists.id as wishlist_id', 'wishlists.*', 'products.*')
                    ->where('wishlists.user_id', Auth::id())
                    ->get();

        $items = json_decode(json_encode($items), true);// DB戻り値 stdClass をそのままView に渡せなかったので php 連想配列に変換するためのコード
        
        // 取得したデータをview に渡して表示。
        return view('wishlist.index', ['items' => $items]);
    }

    /**
     * Wishlist 削除
     */
    public function delete(Request $request)
    {
        // wishlists.id で該当レコードを削除後 /wishlist (自画面)にリダイレクト。(リフレッシ)
        $wishlist_id = $request->wishlist_id;
        Wishlist::where('id', $wishlist_id)-> delete();
        return redirect('/wishlist');
    }
}
