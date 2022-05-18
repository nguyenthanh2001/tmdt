@extends('master_layout.admin.layout_admin')
<!-- Begin Page Content -->
@push('css')
<style>
 
</style>
@endpush
@section('main_admin')
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Thông kê</h1>
    <!-- Content Row -->
    <div class="row">

        <div class="col-xl-8 col-lg-7">
            <!-- Bar Chart -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Bar Chart</h6>
                </div>
                <div class="card-body">
                    <div class="chart-bar">
                        <canvas id="myBarChart"></canvas>
                    </div>
                    <hr>
                    Styling for the bar chart can be found in the
                    <code>/js/demo/chart-bar-demo.js</code> file.
                </div>
            </div>

        </div>
    
    </div>

</div>
@endsection
@push('js')
    <script src="{{ asset('admin/js/demo/chart-bar-demo.js') }}"></script>
@endpush
