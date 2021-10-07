<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function addOrder(Request $request, $userId)
    {
        $user = User::find($userId);
        $activeShoppingSession = $user->shoppingSessions->where('status','Active')->first();
        
        $order = $activeShoppingSession->order()->create([
            'user_id' => $userId,
            'shopping_session_id' => $activeShoppingSession->id,
        ]);

        $activeShoppingSession->update([
            'status' => 'Inactive',
        ]);

        return response()->json($order, 201);
    }
}
