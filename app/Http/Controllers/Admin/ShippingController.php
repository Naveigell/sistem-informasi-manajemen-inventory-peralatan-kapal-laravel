<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ShippingRequest;
use App\Models\OrderDetail;
use App\Models\Shipping;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class ShippingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $shippings = Shipping::with(['shippingDetails' => function ($query) {
            $query->with('orderDetail.order', 'orderDetail.product');
        }])->latest()->paginate(10);

        return view('admin.pages.shipping.index', compact('shippings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $orderDetails = OrderDetail::with('product', 'supplier', 'order')
            ->doesntHave('shippingDetail')
            ->get()
            ->groupBy('order.order_random_code');

        return view('admin.pages.shipping.form', compact('orderDetails'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ShippingRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(ShippingRequest $request)
    {
        DB::transaction(function () use ($request) {
            $shipping = Shipping::create(array_merge($request->validated(), [
                "status" => Shipping::STATUS_ON_DELIVERY,
            ]));

            $shipping->shippingDetails()->createMany($request->getOrderDetailData());
        });

        return redirect(route('admin.shippings.index'))->with('success', 'Berhasil mengirim barang');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
