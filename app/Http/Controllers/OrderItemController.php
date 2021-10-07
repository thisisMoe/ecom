<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OrderItemController extends Controller
{
    public function addOrderItem(Request $request, $userId)
    {
        $this->validate($request, [
            'title' => 'required|string',
            'totalSum' => 'required',
            'fee' => 'required',
            'usdP' => 'required',
            'selectedProps' => 'required',
            'uri' => 'required',
            'user_id' => 'required',
            'productId' => 'required',
            'shopping_session_id'=> 'required',
        ]);

        $user = User::find($userId);
        $orderItem = $user->orderItems()->create($request->all());

        return response()->json(null, 200);
    }

    public function fetchOrderItem($userId)
    {
        $user = User::find($userId);
        return $user->orderItems;
    }

    public function deleteOrderItem(Request $request, $id)
    {
        $orderItem = OrderItem::find($id);
        $orderItem->delete();

        return response()->json('Item deleted', Response::HTTP_NO_CONTENT);
    }
}
