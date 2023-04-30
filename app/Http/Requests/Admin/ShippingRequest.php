<?php

namespace App\Http\Requests\Admin;

use App\Models\OrderDetail;
use App\Models\Shipping;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property array $order_detail_ids
 */
class ShippingRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        // REAL PROJECT NOTE :
        // you need to filter the order detail where order detail id is not in shipping detail id, because it will reproduce
        // bug in the future
        $ids = OrderDetail::pluck('id')->join(',');

        $rules = [
            "order_detail_ids" => "required|array|min:1",
            "order_detail_ids.*" => "required|in:{$ids}",
            "shipped_date" => "required|date|before:" . now()->format('Y-m-d'),
        ];

        if ($this->isMethod('post')) {
            $rules['shipping_random_code'] = "required|string";
        }

        // recreate the rules because we only need "note"
        if (auth()->user()->isDirector()) {
            $rules = [
                "note" => "required|string|max:2000",
            ];
        }

        if (auth()->user()->isAdmin() && auth()->user()->isInAmbon()) {
//            $shipping = $this->route('shipping');
//
//            $statuses = array_slice(
//                Shipping::statusList(),
//                array_search(
//                    $shipping->status,
//                    Shipping::statusList()
//                ) + 1
//            );

            $rules = [
                "status" => "required|string|in:" . join(',', Shipping::statusList())
            ];
        }

        return $rules;
    }

    public function getOrderDetailData()
    {
        $orderDetails = OrderDetail::whereIn('id', $this->order_detail_ids)->get();

        return collect($orderDetails->map(function ($detail) {
            return [
                "product_id" => $detail->product_id,
                "supplier_id" => $detail->supplier_id,
                "quantity" => $detail->quantity,
                "order_detail_id" => $detail->id,
            ];
        }));
    }
}
