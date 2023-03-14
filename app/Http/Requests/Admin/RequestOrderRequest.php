<?php

namespace App\Http\Requests\Admin;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;

class RequestOrderRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $products = Product::pluck('id')->join(',');

        $maxArrayLength = count($this->product_ids ?? []);

        $rules = [
            "product_ids" => "required|array|min:1",
            "product_ids.*" => "required|in:{$products}",
            "quantities" => "required|array|max:{$maxArrayLength}",
            "quantities.*" => "required|min:1|max:200",
        ];

        if ($this->isMethod('post')) {
            $rules['request_order_random_code'] = "required|string";
        }

        return $rules;
    }

    public function getOrderDetails()
    {
        $supplierIds = Product::whereIn('id', $this->product_ids)->pluck('supplier_id');

        return collect($this->product_ids)->map(fn ($id, $index) => [
            "product_id" => $id,
            "quantity" => $this->quantities[$index],
            "supplier_id" => $supplierIds[$index],
        ]);
    }
}
