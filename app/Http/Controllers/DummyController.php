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
class DummyController extends Controller
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

    public function email_signin(Request $request){
        return redirect('/');
    }

}
