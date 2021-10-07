<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'fullName',
        'address',
        'phone',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function shoppingSessions()
    {
        return $this->hasMany(ShoppingSession::class);
    }

    public function cartCount()
    {
        $activeSession = $this->shoppingSessions()->where('status', 'Active')->first();
        if($activeSession) {
            return $activeSession->orderItems->count();
        }
    }

    public function orders()
    {
        return $this->hasMany(Orders::class);
    }

    public function inactiveShoppingSessions()
    {
        return $this->shoppingSessions()->where('status', 'Inactive');
    }
}
