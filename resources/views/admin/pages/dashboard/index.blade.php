@extends('layouts.admin.admin')

@section('content-title', 'Dashboard')

@section('content-body')
    <div class="row">
        <div class="col-3">
            <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                    <i class="fas fa-check"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Cuti Diterima</h4>
                    </div>
                    <div class="card-body">
{{--                        {{ $totalLeavesApproved }}--}}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                    <i class="fas fa-times"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Cuti Ditolak</h4>
                    </div>
                    <div class="card-body">
{{--                        {{ $totalLeavesRejected }}--}}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Cuti Pending</h4>
                    </div>
                    <div class="card-body">
{{--                        {{ $totalLeavesPending }}--}}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                    <i class="fas fa-user"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Pegawai</h4>
                    </div>
                    <div class="card-body">
{{--                        {{ $totalEmployee }}--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4>Statistik</h4>
                </div>
                <div class="card-body"><div class="chartjs-size-monitor" style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
                    <canvas id="myChart" height="576" width="950" style="display: block; width: 950px; height: 576px;" class="chartjs-render-monitor"></canvas>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('stack-script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js" integrity="sha512-QSkVNOCYLtj73J4hbmVoOV6KVZuMluZlioC+trLpewV8qMjsWqlIQvkn1KGX2StWvPMdWGBqim1xlC8krl1EKQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

@endpush
