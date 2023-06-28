@extends('layouts.admin.admin')

@section('content-title', 'Produk')

@section('content-body')
    <div class="col-12 col-md-12 col-lg-12 no-padding-margin">
        <div class="card">
            <form action="{{ @$product ? route('admin.products.update', $product) : route('admin.products.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                @method(@$product ? 'PUT' : 'POST')
                <div class="card-header">
                    <h4>Form Produk</h4>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', @$product ? $product->name : '') }}">
                        @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Harga</label>
                        <input type="text" class="form-control nominal @error('price') is-invalid @enderror" name="price" value="{{ old('price', @$product ? (int) $product->price : '') }}">
                        @error('price')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Supplier</label>
                        <select name="supplier_id" id="" class="form-control @error('supplier_id') is-invalid @enderror">
                            <x-nothing-selected></x-nothing-selected>
                            @foreach($suppliers as $supplier)
                                <option value="{{ $supplier->id }}" @if(old('supplier_id', @$product ? $product->supplier_id : '') == $supplier->id) selected @endif>{{ $supplier->name }}</option>
                            @endforeach
                        </select>
                        @error('payment_type')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Unit</label>
                        <input type="text" class="form-control @error('unit') is-invalid @enderror" name="unit" value="{{ old('unit', @$product ? $product->unit : '') }}">
                        @error('unit')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Note</label>
                        <textarea name="note" id="note" cols="30" rows="10" class="form-control @error('unit') is-invalid @enderror" style="min-height: 200px; resize: none;">{{ old('note', @$product ? $product->note : '') }}</textarea>
                        @error('note')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('stack-script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.7/jquery.inputmask.min.js"></script>
    <script>
        $(".nominal").inputmask({
            alias : "currency",
            groupSeparator: ".",
            radixPoint: ',',
            prefix: "Rp. ",
            placeholder: "",
            allowPlus: false,
            allowMinus: false,
            rightAlign: false,
            digits: 0,
            removeMaskOnSubmit: true,
        });
    </script>
@endpush
