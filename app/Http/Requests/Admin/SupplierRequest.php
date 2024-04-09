<?php

namespace App\Http\Requests\Admin;

use App\Models\Supplier;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property string $phone
 */
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
            "phone" => "required|string|digits_between:10,15",
            "operator_name" => "required|string|max:100",
            "address" => "required|string|max:1000",
        ];
    }

    protected function prepareForValidation()
    {
        // Add 08 in front of phone (indonesian phone number)
        $this->merge([
            "phone" => "08" . $this->phone,
        ]);
    }
}
