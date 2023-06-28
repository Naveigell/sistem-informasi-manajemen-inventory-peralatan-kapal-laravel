<?php

namespace App\Http\Requests\Admin;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;

class RequestOrderRequest extends FormRequest
{
    private $products;

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
        $products = $this->getProducts();

        $orderDetails = collect($this->product_ids)->map(function ($id, $index) use ($products) {

            $product = $products->where('id', $id)->first();

            // we return null if product not found then filter the null in the bottom of function
            if (!$product) {
                return null;
            }

            return [
                "product_id" => $product->id,
                "product_snapshot_id" => $product->latestSnapshot->id,
                "quantity" => $this->quantities[$index],
                "supplier_id" => $product->supplier_id,
            ];
        });

        return array_filter($orderDetails->toArray()); // remove the null value
    }

    public function getProducts()
    {
        // if products is not null, we don't need to querying database again, (note: singleton theory)
        if ($this->products) {
            return $this->products;
        }

        return Product::with('latestSnapshot')->whereIn('id', $this->product_ids)->get();
    }
}
