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
}
