<?php

namespace App\Models;

use App\Interfaces\HasUnusedAttributeToRetrieve;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class Product extends Model implements HasUnusedAttributeToRetrieve
{
    use HasFactory;

    const PRODUCT_UNITS = [
        "kg"     => "kilogram",
        "m"      => "meter",
        "pieces" => "buah"
    ];

    protected $fillable = ['supplier_id', 'name', 'price', 'unit', 'note'];

    public function getPriceFormattedAttribute()
    {
        return number_format($this->price, 0, ',', '.');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function snapshots()
    {
        return $this->hasMany(ProductSnapshot::class, 'product_id');
    }

    public function latestSnapshot()
    {
        return $this->hasOne(ProductSnapshot::class, 'product_id')->latest();
    }

    public function getAttributeWithoutUnusedAttributes()
    {
        return Arr::except($this->attributesToArray(), ['id', 'created_at', 'updated_at']);
    }
}
