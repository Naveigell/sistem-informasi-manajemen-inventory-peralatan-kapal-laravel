@extends('layouts.admin.admin')

@section('content-title', 'Supplier')

@push('stack-style')
    <style>
        textarea {
           resize: none;
        }
    </style>
@endpush

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

                    <div class="form-group">
                        <label>Nomor Telp</label>
                        <input type="text" id="phone-number" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone', @$supplier ? $supplier->phone : '') }}">
                        @error('phone')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Nama Operator</label>
                        <input type="text" class="form-control @error('operator_name') is-invalid @enderror" name="operator_name" value="{{ old('operator_name', @$supplier ? $supplier->operator_name : '') }}">
                        @error('operator_name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Alamat Supplier</label>
                        <textarea name="address" id="address" cols="30" rows="10" class="form-control @error('address') is-invalid @enderror" style="height: 200px !important;">{{ old('address', @$supplier ? $supplier->address : '') }}</textarea>
                        @error('address')
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
    <script src="https://rawgit.com/RobinHerbots/jquery.inputmask/3.x/dist/jquery.inputmask.bundle.js"></script>
    <script>
        $(document).ready(function() {
            $('#phone-number').inputmask({
                removeMaskOnSubmit: true,
                mask: "(08) 999-9999-999"
            });
        })
    </script>
@endpush
