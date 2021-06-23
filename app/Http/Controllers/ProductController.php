<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;


class ProductController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
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
}
