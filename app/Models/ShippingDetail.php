<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingDetail extends Model
{
    use HasFactory;

    protected $fillable = ['shipping_id', 'supplier_id', 'product_id', 'order_detail_id', 'quantity'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function orderDetail()
    {
        return $this->belongsTo(OrderDetail::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
