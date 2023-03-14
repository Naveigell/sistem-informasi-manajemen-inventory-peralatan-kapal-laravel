<?php

namespace App\Http\Requests\Admin;

use App\Models\Product;
use App\Models\RequestOrder;
use App\Rules\MustContainsAllRule;
use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules = [
            "product_ids" => ["required", "array", new MustContainsAllRule($this->get('product_ids'))],
        ];

        if ($this->isMethod('post')) {
            $rules['order_random_code'] = "required|string";
        }

        return $rules;
    }

    public function getOrderDetails()
    {
        $request = RequestOrder::find($this->get('request_id'))->load('requestOrderDetails');

        return $request->requestOrderDetails->map(fn ($detail, $index) => $detail->only('product_id', 'quantity', 'supplier_id'));
    }
}
