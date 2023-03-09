@extends('layouts.admin.admin')

@section('content-title', 'Supplier')

@section('content-body')
    <div class="col-12 col-md-12 col-lg-12 no-padding-margin">
        <div class="card">
            <form action="{{ @$supplier ? route('admin.suppliers.update', $supplier) : route('admin.suppliers.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                @method(@$supplier ? 'PUT' : 'POST')
                <div class="card-header">
                    <h4>Form Supplier</h4>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', @$supplier ? $supplier->name : '') }}">
                        @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Kota</label>
                        <input type="text" class="form-control @error('city') is-invalid @enderror" name="city" value="{{ old('city', @$supplier ? $supplier->city : '') }}">
                        @error('city')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Tipe Pembayaran</label>
                        <select name="payment_type" id="" class="form-control @error('payment_type') is-invalid @enderror">
                            <x-nothing-selected></x-nothing-selected>
                            @foreach([\App\Models\Supplier::PAYMENT_TYPE_TRANSFER, \App\Models\Supplier::PAYMENT_TYPE_CASH] as $payment)
                                <option value="{{ $payment }}" @if(old('payment_type', @$supplier ? $supplier->payment_type : '') == $payment) selected @endif>{{ ucwords($payment) }}</option>
                            @endforeach
                        </select>
                        @error('payment_type')
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
