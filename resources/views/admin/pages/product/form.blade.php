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
                        <label>Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', @$product ? $product->name : '') }}">
                        @error('name')
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
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
