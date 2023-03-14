<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductRequest;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $products = Product::with('supplier')->latest()->paginate(10);

        return view('admin.pages.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $suppliers = Supplier::all();

        return view('admin.pages.product.form', compact('suppliers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProductRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(ProductRequest $request)
    {
        Product::create($request->validated());

        return redirect(route('admin.products.index'))->with('success', 'Berhasil menambah produk');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Product $product
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Product $product)
    {
        $suppliers = Supplier::all();

        return view('admin.pages.product.form', compact('product', 'suppliers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProductRequest $request
     * @param Product $product
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(ProductRequest $request, Product $product)
    {
        $product->update($request->validated());

        return redirect(route('admin.products.index'))->with('success', 'Berhasil mengubah produk');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Product $product
     * @return Application|RedirectResponse|Redirector
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect(route('admin.products.index'))->with('success', 'Berhasil menghapus produk');
    }
}
