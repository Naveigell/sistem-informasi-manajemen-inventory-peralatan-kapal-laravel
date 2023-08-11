@extends('layouts.admin.admin')

@section('content-title', 'Catatan Order')

@section('content-body')
    <div class="col-12 col-md-12 col-lg-12 no-padding-margin">
        <div class="card">
            <form method="post" action="{{ route('admin.orders.notes.update', $order) }}" enctype="multipart/form-data">
                @csrf
                @if(@$order)
                    @method('PUT')
                @endif
                <div class="card-header">
                    <h4>Form Pengiriman</h4>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="note">Catatan</label>
                        <textarea name="note" id="note" cols="30" rows="10" class="form-control @error('note') is-invalid @enderror" style="resize: none; min-height: 170px;">{{ $order->note }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
