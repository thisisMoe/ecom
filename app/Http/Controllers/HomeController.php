<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    // /**
    //  * Create a new controller instance.
    //  *
    //  * @return void
    //  */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('index');
    }

    public function account()
    {
        $user = User::find(Auth::user())->first();
        $orders = $user->inactiveShoppingSessions;

        return view('account')->with([
            'orders' => $orders,
        ]);
    }

    public function faq()
    {
        return view('faq');
    }

    public function about_us()
    {
        return view('about-us');
    }
}
