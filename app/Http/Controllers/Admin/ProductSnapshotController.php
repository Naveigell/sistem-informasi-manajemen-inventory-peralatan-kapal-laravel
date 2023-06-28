<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductSnapshot;
use Illuminate\Http\Request;

class ProductSnapshotController extends Controller
{
    public function index(Product $product)
    {
        $snapshots = ProductSnapshot::where('product_id', $product->id)->latest()->paginate(10);

        return view('admin.pages.product_snapshot.index', compact('product', 'snapshots'));
    }
}
