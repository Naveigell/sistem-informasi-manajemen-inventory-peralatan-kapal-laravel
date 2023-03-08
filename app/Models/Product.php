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

    protected $fillable = ['name', 'unit', 'note'];
}
