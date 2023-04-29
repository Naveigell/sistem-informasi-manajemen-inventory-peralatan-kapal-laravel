@extends('layouts.admin.admin')

@section('content-title', 'Order')

@section('content-body')
    <div class="col-12 col-md-12 col-lg-12 no-padding-margin">
        <div class="card">
            <form action="{{ @$order ? route('admin.orders.update', $order) . '?' . http_build_query(['request_id' => $order->request_id]) : route('admin.orders.store') . '?' . http_build_query(request()->query()) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method(@$order ? 'PUT' : 'POST')
                <div class="card-header">
                    <h4>Form Order</h4>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Request Code</label>
                        <input type="text" readonly class="form-control" name="order_random_code" value="{{ old('order_random_code', @$order ? $order->requestOrder->request_order_random_code : "ORDER-" . strtoupper(uniqid())) }}">
                        <small class="text text-muted">* Dibuat otomatis oleh sistem</small>
                    </div>
                    <div class="row">
                        <div class="form-group col-6">
                            <label>Pilih Produk Yang Diminta</label>
                            <select id="product-id" name="product_ids[]" class="form-control select2--container @error('product_ids') is-invalid @enderror" multiple>
                                <x-nothing-selected></x-nothing-selected>
                                @foreach($suppliers as $supplier)
                                    <optgroup label="{{ $supplier->name }}">
                                        @foreach($supplier->products as $product)
                                            @if(@$order)
                                                <option @if ($order->requestOrder->requestOrderDetails->whereIn('product_id', $product->id)->isNotEmpty()) selected @endif value="{{ $product->id }}">{{ $product->name }}</option>
                                            @else
                                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                                            @endif
                                        @endforeach
                                    </optgroup>
                                @endforeach
                            </select>
                            @error('product_ids')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                            <small class="text text-muted">* Pilih produk yang nanti akan dikirimkan</small>
                        </div>
                        <div class="form-group col-6">
                            <label>Produk Yang Diminta</label>
                            <select disabled class="form-control select2--container @error('product_ids') is-invalid @enderror" multiple>
                                <x-nothing-selected></x-nothing-selected>
                                @foreach($suppliers as $supplier)
                                    <optgroup label="{{ $supplier->name }}">
                                        @foreach($supplier->products as $product)
                                            <option @if (@$requestOrder ? $requestOrder->requestOrderDetails->whereIn('product_id', $product->id)->isNotEmpty() : $order->requestOrder->requestOrderDetails->whereIn('product_id', $product->id)->isNotEmpty()) selected @endif value="{{ $product->id }}">{{ $product->name }}</option>
                                        @endforeach
                                    </optgroup>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('stack-script')
    <script>
        $(document).ready(function () {
            const container = $('.select2--container');

            container.select2();
        });
    </script>
@endpush
