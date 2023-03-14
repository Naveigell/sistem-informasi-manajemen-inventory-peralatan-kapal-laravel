<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'request_id', 'order_random_code', 'order_date', 'note',
    ];

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function requestOrder()
    {
        return $this->belongsTo(RequestOrder::class, 'request_id');
    }
}
