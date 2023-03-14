<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'request_order_random_code',
    ];

    public function requestOrderDetails()
    {
        return $this->hasMany(RequestOrderDetail::class, 'request_id');
    }

    public function order()
    {
        return $this->hasOne(Order::class, 'request_id');
    }
}
