@extends('layouts.admin.admin')

@section('content-title', 'Pengiriman Barang')

@section('content-body')
    @if ($message = session()->get('success'))
        <x-alert.success :message="$message"></x-alert.success>
    @endif
    <div class="col-lg-12 col-md-12 col-12 col-sm-12 no-padding-margin">
        <div class="card">
            <div class="card-header">
                <h4>Request</h4>
                @if(auth()->user()->isAdmin() && auth()->user()->isInBali())
                    <div class="card-header-action">
                        <a href="{{ route('admin.shippings.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Pengiriman</a>
                    </div>
                @endif
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped mb-4">
                        <thead>
                        <tr>
                            <th class="col-1">No</th>
                            <th class="col-2">Shipping Code</th>
                            <th class="col-1">Jumlah Barang</th>
                            <th class="col-5">List Barang</th>
                            <th class="col-2">Status</th>
                            <th class="col-2">Tanggal Dibuat</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($shippings as $shipping)
                                <tr>
                                    <td>
                                        <x-iterate :pagination="$shippings" :loop="$loop"></x-iterate>
                                    </td>
                                    <td>{{ $shipping->shipping_random_code }}</td>
                                    <td>{{ $shipping->shippingDetails->count() }}</td>
                                    <td>
                                        @if($shipping->shippingDetails->count())
                                            <ul>
                                                @foreach($shipping->shippingDetails as $detail)
                                                    <li>{{ $detail->orderDetail->product->name }} - [{{ $detail->orderDetail->order->order_random_code }}]</li>
                                                @endforeach
                                            </ul>
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge {{ $shipping->status_class_css }}">{{ $shipping->status_formatted }}</span>
                                    </td>
                                    <td>{{ optional($shipping->shipped_date)->format('d F Y') ?? '-' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
