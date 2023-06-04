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
        <div class="col-xl-8 col-lg-8">
            <!-- Bar Chart -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Loại hải sản</h6>
                </div>
                <div class="card-body">
                        <canvas id="myChart"></canvas>
                    <hr>
                   <p>Số lượng hải sản của các loại sản phẩm</p> 
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Top 5 sản phẩm</h6>
                </div>
                <div class="card-body test">       
                        <canvas id="CakeTop"></canvas>
                    <hr>
                    <p> Top 5 sản phẩm được mua nhiều nhất</p>        
                </div>        
        </div>
    </div>

    <div class="col-xl-8 col-lg-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Doanh thu 4 tháng</h6>
            </div>
            <div class="card-body">
                    <canvas id="CVturnover"></canvas>
                <hr>
                <p>Doanh thu 4 tháng gần đây </p> 
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-lg-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Top 5 người dùng trong 4 tháng</h6>
            </div>
            <div class="card-body test">       
                    <canvas id="CVuser"></canvas>
                <hr>
                <p> Top 5 người dùng có số lần mua nhiều trong 4 tháng</p>        
            </div>        
    </div>
</div>

</div>
@endsection
@push('js')
    <script>
        var urlLoai ='{{route('admin.TKLoai')}}';
        var NameTop = @json($arrTop['nameCake']);
        var QuantityTop = @json($arrTop['quantity']);
        // check neu khong co thi gan = null
        var NameMonthYear = @json(isset($arrTop['monthYear']) ? $arrTop['monthYear'] : null);
        var totalBill = @json(isset($arrTop['totalBill']) ? $arrTop['totalBill'] : null);
        var userBuyQuantity = @json(isset($arrTop['userBuyQuantity']) ? $arrTop['userBuyQuantity'] : null);
        var userName = @json(isset($arrTop['userName']) ? $arrTop['userName'] : null);
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js" integrity="sha512-QSkVNOCYLtj73J4hbmVoOV6KVZuMluZlioC+trLpewV8qMjsWqlIQvkn1KGX2StWvPMdWGBqim1xlC8krl1EKQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('custom/admin/thongke.js') }}"></script>
@endpush
