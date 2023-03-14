@extends('layouts.admin.admin')

@section('content-title', 'Request Barang')

@section('content-body')
    @if ($message = session()->get('success'))
        <x-alert.success :message="$message"></x-alert.success>
    @endif
    <div class="col-lg-12 col-md-12 col-12 col-sm-12 no-padding-margin">
        <div class="card">
            <div class="card-header">
                <h4>Request</h4>
                <div class="card-header-action">
                    <a href="{{ route('admin.request-orders.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Request</a>
                </div>
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
                        @forelse($requests as $request)
                            <tr>
                                <td>
                                    <x-iterate :pagination="$requests" :loop="$loop"></x-iterate>
                                </td>
                                <td>{{ $request->request_order_random_code }}</td>
                                <td>{{ $request->request_order_details_count }}</td>
                                <td>{{ $request->created_at->format('d F Y') }}</td>
                                <td>
                                    <a href="{{ route('admin.request-orders.edit', $request) }}" class="btn btn-warning"><i class="fa fa-pen"></i></a>
                                    <button class="btn btn-danger btn-action trigger--modal-delete cursor-pointer" data-url="{{ route('admin.request-orders.destroy', $request) }}"><i class="fas fa-trash"></i></button>
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

                {{ $requests->links() }}
            </div>
        </div>
    </div>
@endsection

@section('content-modal')
    <x-modal.delete :name="'Request'"></x-modal.delete>
@endsection
