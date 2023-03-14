@extends('layouts.admin.admin')

@section('content-title', 'Request')

@section('content-body')
    <div class="col-12 col-md-12 col-lg-12 no-padding-margin">
        <div class="card">
            <form action="{{ @$requestOrder ? route('admin.request-orders.update', $requestOrder) : route('admin.request-orders.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                @method(@$requestOrder ? 'PUT' : 'POST')
                <div class="card-header">
                    <h4>Form Request</h4>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Request Code</label>
                        <input type="text" readonly class="form-control @error('request_order_random_code') is-invalid @enderror" name="request_order_random_code" value="{{ old('request_order_random_code', @$requestOrder ? $requestOrder->request_order_random_code : "REQUEST-" . strtoupper(uniqid())) }}">
                        @error('request_order_random_code')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        @if(!@$requestOrder)
                            <small class="text text-muted">*Dibuat otomatis oleh sistem</small>
                        @endif
                    </div>
                    <div class="row">
                        <div class="form-group col-7">
                            <label>Pilih Produk</label>
                            <select id="product-id" class="form-control select2--container @error('product_ids') is-invalid @enderror">
                                <x-nothing-selected></x-nothing-selected>
                                @foreach($suppliers as $supplier)
                                    <optgroup label="{{ $supplier->name }}">
                                        @foreach($supplier->products as $product)
                                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                                        @endforeach
                                    </optgroup>
                                @endforeach
                            </select>
                            @error('product_ids')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group col-3">
                            <label>Jumlah Produk</label>
                            <input min="1" type="number" step="1" id="product-quantity" class="form-control @error('quantities') is-invalid @enderror" value="">
                            @error('quantities')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group col-2">
                            <label style="visibility: hidden;">Tambah Produk</label>
                            <button type="button" id="add-product" class="btn btn-primary">Tambah</button>
                        </div>
                    </div>
                    <div class="card" id="list-product-card">
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-7 mb-0">
                                    <label>Pilih Produk</label>
                                </div>
                                <div class="form-group col-3 mb-0">
                                    <label>Jumlah Produk</label>
                                </div>
                            </div>
                            <div id="list-product-container">
                                @if(old('product_ids') || @$requestOrder)
                                    @php
                                        $products = $suppliers->map(fn($supplier) => $supplier->products)->flatten();
                                        $quantities = old('quantities');
                                        $ids = old('product_ids', @$requestOrder ? $requestOrder->requestOrderDetails->pluck('product_id')->toArray() : []);
                                        $quantities = old('quantities', @$requestOrder ? $requestOrder->requestOrderDetails->pluck('quantity')->toArray() : []);
                                    @endphp
                                    @foreach($ids as $index => $id)
                                        @php
                                            $rowId = uniqid() . date('dmYHis');
                                        @endphp

                                        <div class="row" id="row-{{ $rowId }}">
                                            <div class="form-group col-7">
                                                <input type="text" readonly class="form-control" value="{{ optional($products->where('id', $id)->first())->name }}">
                                                <input type="hidden" name="product_ids[]" value="{{ $id }}">
                                            </div>
                                            <div class="form-group col-3">
                                                <input type="text" readonly name="quantities[]" class="form-control" value="{{ $quantities[$index] }}">
                                            </div>
                                            <div class="form-group col-2">
                                                <button type="button" class="btn btn-danger btn--product-delete" data-row-id="row-{{ $rowId }}"><i class="fa fa-trash"></i></button>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
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
        const listProductContainer = $('#list-product-container');
        const listProductCard = $('#list-product-card');

        listProductCard.hide();

        $(document).ready(function () {

            const container = $('.select2--container');

            container.select2();

            const buttonAddProduct = $('#add-product');
            const inputProductId = $('#product-id');
            const inputProductQuantity = $('#product-quantity');

            buttonAddProduct.on('click', function () {

                const rowId = (Math.random() + 1).toString(36) + Date.now();

                const productId = inputProductId.val();
                const productName = inputProductId.find('option:selected').text();

                const quantity = inputProductQuantity.val();

                if (!productId || !quantity) {
                    return;
                }

                listProductContainer.append(`
                    <div class="row" id="row-${rowId}">
                        <div class="form-group col-7">
                            <input type="text" readonly class="form-control" value="${productName}">
                            <input type="hidden" name="product_ids[]" value="${productId}">
                        </div>
                        <div class="form-group col-3">
                            <input type="text" readonly name="quantities[]" class="form-control" value="${quantity}">
                        </div>
                        <div class="form-group col-2">
                            <button type="button" class="btn btn-danger btn--product-delete" data-row-id="row-${rowId}"><i class="fa fa-trash"></i></button>
                        </div>
                    </div>
                `);

                refreshProductList();

                inputProductId.val('').trigger('change');
                inputProductQuantity.val('');
            })
        });
    </script>
    @if(old('product_ids') || @$requestOrder)
        <script>
            listProductCard.show();
        </script>
    @endif
    <script>
        $(document).delegate('.btn--product-delete', 'click', function (evt) {
            try {
                document.getElementById($(evt.currentTarget).data('row-id')).remove();
            } catch (e) {
            } finally {
                refreshProductList();
            }
        });
    </script>
    <script>
        function refreshProductList() {
            if (listProductContainer.children().length > 0) {
                listProductCard.show();
            } else {
                listProductCard.hide();
            }
        }
    </script>
@endpush
