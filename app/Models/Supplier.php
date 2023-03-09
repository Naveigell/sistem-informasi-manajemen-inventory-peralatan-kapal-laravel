<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    const PAYMENT_TYPE_CASH     = 'cash';
    const PAYMENT_TYPE_TRANSFER = 'transfer';

    protected $fillable = [
        'name', 'city', 'payment_type',
    ];

    public function getPaymentTypeFormattedAttribute()
    {
        return [
            self::PAYMENT_TYPE_CASH => "Cash",
            self::PAYMENT_TYPE_TRANSFER => "Transfer",
        ][$this->payment_type];
    }

    public function getPaymentTypeClassFormattedAttribute()
    {
        return [
            self::PAYMENT_TYPE_CASH => 'badge-success',
            self::PAYMENT_TYPE_TRANSFER => 'badge-light',
        ][$this->payment_type];
    }
}
