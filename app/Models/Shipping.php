<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    use HasFactory;

    const STATUS_ON_DELIVERY = 'on_delivery';

    protected $fillable = ['shipping_random_code', 'shipped_date', 'received_date', 'status'];

    protected $casts = [
        'received_date' => 'datetime',
        'shipped_date' => 'datetime',
    ];

    public function shippingDetails()
    {
        return $this->hasMany(ShippingDetail::class, 'shipping_id');
    }

    public function getStatusClassCssAttribute()
    {
        if ($this->status == self::STATUS_ON_DELIVERY) {
            return 'badge-warning';
        }

        return 'badge-primary';
    }

    public function getStatusFormattedAttribute()
    {
        return ucwords(str_replace('_', ' ', $this->status));
    }
}
