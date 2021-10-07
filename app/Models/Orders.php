<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function shoppingSessions()
    {
        return $this->belongsTo(ShoppingSession::class, 'shopping_session_id', 'id');
    }
}
