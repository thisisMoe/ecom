<?php

namespace App\Http\Controllers;

use App\Models\ShoppingSession;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\QueryBuilder\QueryBuilder;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.index');
    }

    public function orders(Request $request)
    {
        $ordersCount = ShoppingSession::where(['status' => 'inactive', 'orderStatus' => 'pending'])->get()->count();
        $orders = QueryBuilder::for(ShoppingSession::class)->allowedFilters('orderStatus', 'status', 'confirmation_image')->paginate(2)->appends(request()->query());

        return view('admin.dashboard', compact('orders', 'ordersCount'));
    }

    public function pendingPayments(Request $request)
    {

        $orders = ShoppingSession::where(['orderStatus' => 'pending', 'withPayment' => true])->paginate(6);
        $ordersCount = ShoppingSession::where(['orderStatus' => 'pending', 'withPayment' => true])->get()->count();
        
        return view('admin.pending-payments', compact('orders', 'ordersCount'));
    }
}
