<?php

namespace App\Http\Requests\Admin;

use App\Models\Supplier;
use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $suppliers = Supplier::pluck('id')->join(',');

        return [
            "supplier_id" => "required|string|in:{$suppliers}",
            "name" => "required|string|max:100",
            "price" => "required|integer|min:1|max:1000000000", // 1 billion rupiah
            "unit" => "required|string|max:10",
            "note" => "nullable|string|max:2000",
        ];
    }
}
