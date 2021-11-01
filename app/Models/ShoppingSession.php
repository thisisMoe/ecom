<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShoppingSession extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'shopping_session_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function order()
    {
        return $this->belongsTo(Orders::class, 'shopping_session_id');
    }

    public function confirmations()
    {
        return $this->hasMany(Confirmation::class);
    }

    //function to loop through orderitems and calculate total shippingCost again
    public function updateTotalShippingCost()
    {
        $totalShippingCost = 0;

        foreach ($this->orderItems as ${$orderItem}) {
            $totalShippingCost += $orderItem->shippingCost;
        }
        $this->totalShipping = $totalShippingCost;
        $this->save();
    }

    public static function calcSessionTotal($id)
    {
        $total = 0;
        $totalFee = 0;
        $totalShipping = 0;
        $shoppingSession = ShoppingSession::find($id);
        foreach ($shoppingSession->orderItems as $orderItem) {
            $total = $total + $orderItem->totalSum;
            $totalFee = $totalFee + $orderItem->fee;
            $totalShipping = $totalShipping + $orderItem->shippingCost;
        }

        $shoppingSession->update([
            'total' => $total,
            'totalFee' => $totalFee,
            'totalShipping' => $totalShipping,
        ]);
    }
}
