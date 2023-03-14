@extends('layouts.admin.admin')

@section('content-title', 'Order Barang')

@section('content-body')
    @if ($message = session()->get('success'))
        <x-alert.success :message="$message"></x-alert.success>
    @endif
    <div class="col-lg-12 col-md-12 col-12 col-sm-12 no-padding-margin">
        <div class="card">
            <div class="card-header">
                <h4>Order</h4>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped mb-4">
                        <thead>
                        <tr>
                            <th class="col-1">No</th>
                            <th class="col-2">Request Code</th>
                            <th class="col-2">Jumlah Barang</th>
                            <th class="col-2">Tanggal Dibuat</th>
                            <th class="col-2">Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($orders as $order)
                            <tr>
                                <td>
                                    <x-iterate :pagination="$orders" :loop="$loop"></x-iterate>
                                </td>
                                <td>{{ $order->order_random_code }}</td>
                                <td>{{ $order->order_details_count }}</td>
                                <td>{{ $order->created_at->format('d F Y') }}</td>
                                <td>
                                    <a href="{{ route('admin.orders.edit', $order) }}" class="btn btn-warning"><i class="fa fa-box"></i></a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" style="text-align: center;">Data Empty</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

                {{ $orders->links() }}
            </div>
        </div>
    </div>
@endsection

@section('content-modal')
    <x-modal.delete :name="'Order'"></x-modal.delete>
@endsection
