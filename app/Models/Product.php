<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    const PRODUCT_UNITS = [
        "kg"     => "kilogram",
        "m"      => "meter",
        "pieces" => "buah"
    ];

    protected $fillable = ['supplier_id', 'name', 'unit', 'note'];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
