@extends('layouts.admin.admin')

@section('content-title', 'Produk Snapshot')

@section('content-body')
    @if ($message = session()->get('success'))
        <x-alert.success :message="$message"></x-alert.success>
    @endif
    <div class="col-lg-12 col-md-12 col-12 col-sm-12 no-padding-margin">
        <div class="card">
            <div class="card-header">
                <h4>Produk Snapshot</h4>
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
                            <th class="col-4">Diubah Tanggal</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($snapshots as $snapshot)
                            <tr>
                                <td class="py-4">
                                    <x-iterate :pagination="$snapshots" :loop="$loop"></x-iterate>
                                </td>
                                <td>{{ $snapshot->name }}</td>
                                <td>Rp. {{ $snapshot->price_formatted }}</td>
                                <td>{{ $snapshot->supplier->name }}</td>
                                <td>{{ $snapshot->unit }}</td>
                                <td>{{ $snapshot->note ?? '-' }}</td>
                                <td>{{ $snapshot->created_at->format('d F Y H:i:s') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" style="text-align: center;">Data Empty</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

                {{ $snapshots->links() }}
            </div>
        </div>
    </div>
@endsection

@section('content-modal')
    <x-modal.delete :name="'Produk Histori'"></x-modal.delete>
@endsection
