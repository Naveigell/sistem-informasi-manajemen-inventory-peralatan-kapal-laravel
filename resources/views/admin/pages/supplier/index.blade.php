@extends('layouts.admin.admin')

@section('content-title', 'Supplier')

@section('content-body')
    @if ($message = session()->get('success'))
        <x-alert.success :message="$message"></x-alert.success>
    @endif
    <div class="col-lg-12 col-md-12 col-12 col-sm-12 no-padding-margin">
        <div class="card">
            <div class="card-header">
                <h4>Supplier</h4>
                <div class="card-header-action">
                    <a href="{{ route('admin.suppliers.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Supplier</a>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped mb-4">
                        <thead>
                        <tr>
                            <th class="col-1">No</th>
                            <th class="col-2">Nama Supplier</th>
                            <th class="col-2">Kota</th>
                            <th class="col-2">Metode Pembayaran</th>
                            <th class="col-2">Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($suppliers as $supplier)
                            <tr>
                                <td>
                                    <x-iterate :pagination="$suppliers" :loop="$loop"></x-iterate>
                                </td>
                                <td>{{ $supplier->name }}</td>
                                <td>{{ $supplier->city }}</td>
                                <td>
                                    <span class="badge {{ $supplier->payment_type_class_formatted }}">{{ $supplier->payment_type_formatted }}</span>
                                </td>
                                <td>
                                    <a href="{{ route('admin.suppliers.edit', $supplier) }}" class="btn btn-warning"><i class="fa fa-pen"></i></a>
                                    <button class="btn btn-danger btn-action trigger--modal-delete cursor-pointer" data-url="{{ route('admin.suppliers.destroy', $supplier) }}"><i class="fas fa-trash"></i></button>
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

                {{ $suppliers->links() }}
            </div>
        </div>
    </div>
@endsection

@section('content-modal')
    <x-modal.delete :name="'Supplier'"></x-modal.delete>
@endsection
