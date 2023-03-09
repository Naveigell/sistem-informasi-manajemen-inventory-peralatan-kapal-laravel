<?php

namespace App\Http\Requests\Admin;

use App\Models\Supplier;
use Illuminate\Foundation\Http\FormRequest;

class SupplierRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "name" => "required|string|max:100",
            "city" => "required|string|max:50",
            "payment_type" => "required|string|in:" . join(',', [Supplier::PAYMENT_TYPE_CASH, Supplier::PAYMENT_TYPE_TRANSFER]),
        ];
    }
}
