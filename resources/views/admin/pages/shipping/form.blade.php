@extends('layouts.admin.admin')

@section('content-title', 'Pengiriman')

@section('content-body')
    <div class="col-12 col-md-12 col-lg-12 no-padding-margin">
        <div class="card">
            <form method="post" action="{{ @$shipping ? route('admin.shippings.update', $shipping) : route('admin.shippings.store') }}" enctype="multipart/form-data">
                @csrf
                @if(@$shipping)
                    @method('PUT')
                @endif
                <div class="card-header">
                    <h4>Form Pengiriman</h4>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Shipping Code</label>
                        <input type="text" readonly class="form-control @error('shipping_random_code') is-invalid @enderror" name="shipping_random_code" value="{{ old('shipping_random_code', @$shipping ? $shipping->shipping_random_code : "SHIPPING-" . strtoupper(uniqid())) }}">
                        @error('shipping_random_code')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                        @if(!@$requestOrder)
                            <small class="text text-muted">*Dibuat otomatis oleh sistem</small>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Tanggal Dikirim</label>
                        <input type="date" @if (@$shipping) readonly @endif class="form-control @error('shipped_date') is-invalid @enderror" name="shipped_date" value="{{ old('shipped_date', @$shipping ? $shipping->shipped_date->format('Y-m-d') : '') }}">
                        @error('shipped_date')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Pilih Barang Yang Akan Dikirim</label>
                        <select @if(@$shipping) disabled @endif id="order-detail-id" name="order_detail_ids[]" class="form-control select2--container @error('order_detail_ids') is-invalid @enderror" multiple>
                            <x-nothing-selected></x-nothing-selected>
                            @foreach($orderDetails as $randomCode => $orderDetail)
                                <optgroup label="{{ $randomCode }}">
                                    @foreach($orderDetail as $detail)
                                        <option @if(in_array($detail->id, @$shipping ? $shipping->shippingDetails->pluck('order_detail_id')->toArray() : old('order_detail_ids', []))) selected @endif value="{{ $detail->id }}">{{ $detail->product->name }} - [{{ $randomCode }}]</option>
                                    @endforeach
                                </optgroup>
                            @endforeach
                        </select>
                        @error('order_detail_ids')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    @if(@$shipping)
                        @if(auth()->user()->isDirector())
                            <div class="form-group">
                                <label for="note">Catatan</label>
                                <textarea name="note" id="note" cols="30" rows="10" class="form-control" style="resize: none; min-height: 170px;">{{ $shipping->note }}</textarea>
                            </div>
                        @endif
                        @if(auth()->user()->isAdmin() && auth()->user()->isInAmbon())
                            <div class="form-group">
                                <label for="status">Status Pengiriman</label>
                                <select name="status" id="status" class="form-control">
                                    <x-nothing-selected></x-nothing-selected>
                                    @foreach(\App\Models\Shipping::statusList() as $status)
                                        <option @if($shipping->status == $status) selected @endif value="{{ $status }}">{{ ucwords(str_replace('_', ' ', $status)) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endif
                    @endif
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
        })
    </script>
@endpush
