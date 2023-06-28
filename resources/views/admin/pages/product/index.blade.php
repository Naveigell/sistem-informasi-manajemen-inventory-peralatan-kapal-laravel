@extends('layouts.admin.admin')

@section('content-title', 'Produk')

@section('content-body')
    @if ($message = session()->get('success'))
        <x-alert.success :message="$message"></x-alert.success>
    @endif
    <div class="col-lg-12 col-md-12 col-12 col-sm-12 no-padding-margin">
        <div class="card">
            <div class="card-header">
                <h4>Produk</h4>
                <div class="card-header-action">
                    <a href="{{ route('admin.products.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Produk</a>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped mb-4">
                        <thead>
                        <tr>
                            <th class="col-1">No</th>
                            <th class="col-2">Nama</th>
                            <th class="col-2">Harga</th>
                            <th class="col-2">Suplier</th>
                            <th class="col-1">Satuan</th>
                            <th class="col-3">Catatan</th>
                            <th class="col-2">Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($products as $product)
                            <tr>
                                <td>
                                    <x-iterate :pagination="$products" :loop="$loop"></x-iterate>
                                </td>
                                <td>{{ $product->name }}</td>
                                <td>Rp. {{ $product->price_formatted }}</td>
                                <td>{{ $product->supplier->name }}</td>
                                <td>{{ $product->unit }}</td>
                                <td>{{ $product->note ?? '-' }}</td>
                                <td>
                                    <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-warning"><i class="fa fa-pen"></i></a>
                                    <button class="btn btn-danger btn-action trigger--modal-delete cursor-pointer" data-url="{{ route('admin.products.destroy', $product) }}"><i class="fas fa-trash"></i></button>
                                    <a href="{{ route('admin.products.snapshots.index', $product) }}" class="btn btn-light"><i class="fa fa-history"></i></a>
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

                {{ $products->links() }}
            </div>
        </div>
    </div>
@endsection

@section('content-modal')
    <x-modal.delete :name="'Produk'"></x-modal.delete>
@endsection
