<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\RequestOrder;
use App\Models\Shipping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalRequest = RequestOrder::count();
        $totalOrder = Order::count();
        $totalShippingOnDelivery = Shipping::where('status', Shipping::STATUS_ON_DELIVERY)->count();
        $totalShippingArrived = Shipping::where('status', Shipping::STATUS_ARRIVED)->count();

        // create shipping data, month name is the key, and the default value is 0
        $months = collect(range(1, 12))
            ->map(fn($monthNumber) => date('F', mktime(0, 0, 0, $monthNumber)))
            ->combine(
                array_fill(0, 12, 0)
            );

        // we only need to clone the previous months and value, no need to create it again
        $ordersData = clone $months;
        $shippingsData = clone $months;

        $months = $months->toArray();

        // we get the total order by month
        Order::select([
            DB::raw('MONTH(order_date) as _month'),
            DB::raw('YEAR(order_date) as _year'),
            DB::raw('MONTHNAME(order_date) as _monthname'),
            DB::raw('COUNT(id) as _count'),
        ])->having('_year', date('Y'))
            ->groupBy('_month', '_year', '_monthname')
            ->get()
            ->map(fn ($order) => $ordersData[$order->_monthname] = $order->_count);

        $ordersData = $ordersData->toArray();

        Shipping::where('status', Shipping::STATUS_ARRIVED)
            ->whereNotNull('received_date')
            ->get()
            // we need to add new attribute that should change received date to month name, because it will group by month name
            ->map(fn ($shipping) => tap($shipping,
                fn ($shipping) => $shipping->received_date_month = date('F', $shipping->received_date->timestamp))
            )
            ->groupBy('received_date_month')
            // after we're grouping the shipping by month, then we change the $data variable value
            ->map(fn ($shippings, $month) => $shippingsData->put($month, $shippings->count()));

        $shippingsData = $shippingsData->toArray();

        return view('admin.pages.dashboard.index', compact(
            'totalRequest',
            'totalOrder',
            'totalShippingOnDelivery',
            'totalShippingArrived',
            'shippingsData',
            'ordersData',
            'months')
        );
    }
}
