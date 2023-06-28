<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RequestOrderRequest;
use App\Models\Product;
use App\Models\ProductSnapshot;
use App\Models\RequestOrder;
use App\Models\Supplier;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class RequestOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $requests = RequestOrder::withCount('requestOrderDetails')->latest()->paginate(10);

        return view('admin.pages.request_order.index', compact('requests'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $suppliers = Supplier::with('products')->has('products')->get();

        return view('admin.pages.request_order.form', compact('suppliers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param RequestOrderRequest $request
     * @return Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(RequestOrderRequest $request)
    {
        DB::transaction(function () use ($request) {
            $requestOrder = RequestOrder::create($request->validated());
            // create the snapshot first, it's because in $request->getOrderDetails() function, it retrieves the latest snapshot
            $this->createProductSnapshots($request);
            $requestOrder->requestOrderDetails()->createMany($request->getOrderDetails());
        });

        return redirect(route('admin.request-orders.index'))->with('success', 'Berhasil membuat request');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param RequestOrder $requestOrder
     * @return Application|Factory|View
     */
    public function edit(RequestOrder $requestOrder)
    {
        $suppliers = Supplier::with('products')->has('products')->get();

        $requestOrder->load('requestOrderDetails.product');

        return view('admin.pages.request_order.form', compact('requestOrder', 'suppliers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param RequestOrderRequest $request
     * @param RequestOrder $requestOrder
     * @return Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(RequestOrderRequest $request, RequestOrder $requestOrder)
    {
        DB::transaction(function () use ($request, $requestOrder) {
            $requestOrder->requestOrderDetails()->delete();
            // create the snapshot first, it's because in $request->getOrderDetails() function, it retrieves the latest snapshot
            $this->createProductSnapshots($request);
            $requestOrder->requestOrderDetails()->createMany($request->getOrderDetails());
        });

        return redirect(route('admin.request-orders.index'))->with('success', 'Berhasil mengubah request');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(RequestOrder $requestOrder)
    {
        $requestOrder->delete();

        return redirect(route('admin.request-orders.index'))->with('success', 'Berhasil menghapus request');
    }

    private function createProductSnapshots(RequestOrderRequest $request)
    {
        // we save the product to snapshot one by one
        foreach ($request->getProducts() as $product) {
            $snapshot = new ProductSnapshot($product->getAttributeWithoutUnusedAttributes()); // we remove unused attributes
            $snapshot->product()
                ->associate($product)
                ->save();
        }
    }
}
