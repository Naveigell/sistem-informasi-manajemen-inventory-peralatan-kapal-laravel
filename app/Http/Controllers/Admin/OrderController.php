<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\OrderRequest;
use App\Models\Order;
use App\Models\RequestOrder;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $orders = Order::with('requestOrder')->withCount('orderDetails')->latest()->paginate(10);

        return view('admin.pages.order.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create(Request $request)
    {
        abort_if(!$request->get('request_id'), 404);

        $requestOrder = RequestOrder::find($request->get('request_id'))->load('requestOrderDetails');
        $suppliers = Supplier::with(['products' => function ($query) use ($requestOrder) {
            $query->whereIn('id', $requestOrder->requestOrderDetails->pluck('product_id'));
        }])->whereHas('products', function ($query) use ($requestOrder) {
            $query->whereIn('id', $requestOrder->requestOrderDetails->pluck('product_id'));
        })->get();

        return view('admin.pages.order.form', compact('requestOrder', 'suppliers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param OrderRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(OrderRequest $request)
    {
        DB::transaction(function () use ($request) {
            $order = Order::create(array_merge([
                "user_id" => auth()->id(),
                "request_id" => $request->get('request_id'),
                "order_date" => now()->toDateTimeString(),
            ], $request->validated()));

            $order->orderDetails()->createMany($request->getOrderDetails());
        });

        return redirect(route('admin.orders.index'))->with('success', 'Berhasil membuat order');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Order $order
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Order $order)
    {
        $suppliers = Supplier::with('products')->has('products')->get();

        $order->load('requestOrder');

        return view('admin.pages.order.form', compact('order', 'suppliers'));
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
