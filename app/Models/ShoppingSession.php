<?php

namespace App\Models;

use App\Traits\StoreImageTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Http\Client\Request;

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
 
}
