<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\OrderRequest;
use App\Models\Order;
use App\Models\RequestOrder;
use App\Models\Shipping;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalRequest = RequestOrder::count();
        $totalOrder = Order::count();
        $totalShippingOnDelivery = Shipping::where('status', Shipping::STATUS_ON_DELIVERY)->count();
        $totalShippingArrived = Shipping::where('status', Shipping::STATUS_ARRIVED)->count();

        // create data, month name is the key, and the default value is 0
        $data = collect(range(1, 12))
            ->map(fn($monthNumber) => date('F', mktime(0, 0, 0, $monthNumber, 1, 2023)))
            ->combine(
                array_fill(0, 12, 0)
            );

        Shipping::where('status', Shipping::STATUS_ARRIVED)
            ->whereNotNull('received_date')
            ->get()
            // we need to add new attribute that should change received date to month name, because it will group by month name
            ->map(fn ($shipping) => tap($shipping,
                fn ($shipping) => $shipping->received_date_month = date('F', $shipping->received_date->timestamp))
            )
            ->groupBy('received_date_month')
            // after we're grouping the shipping by month, then we change the $data variable value
            ->map(fn ($shippings, $month) => $data->put($month, $shippings->count()));

        $data = $data->toArray();

        return view('admin.pages.dashboard.index', compact('totalRequest', 'totalOrder', 'totalShippingOnDelivery', 'totalShippingArrived', 'data'));
    }
}
