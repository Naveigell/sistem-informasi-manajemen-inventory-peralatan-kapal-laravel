<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSnapshot extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id', 'supplier_id', 'name', 'price', 'unit', 'note',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function getPriceFormattedAttribute()
    {
        return number_format($this->price, 0, ',', '.');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
