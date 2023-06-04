@extends('master_layout.admin.layout_admin')
@push('css')
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
<style>
    .ui-front {
    z-index: 9999999 !important;
}
</style>
@endpush
<!-- Begin Page Content -->
@section('main_admin')
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Quản Lý Size hải sản</h1>
    <p class="mb-4 text-info">Tại đây quản trị có thể thêm Size hải sản , sửa Size hải sản , xóa Size hải sản ,
         xem thông tin Size hải sản , tìm kiếm tất cả thông tin của Size hải sản
    </p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between">
            <div class="m-0 font-weight-bold text-primary">
                Size hải sản
             </div>
             <div class="m-0 font-weight-bold text-primary">
                <button class="btn btn-success btn-icon-split" onclick="opensize()" data-toggle="modal" data-target="#themsize">
                    <span class="icon text-white-50">
                        <i class="fa-duotone fa-plus"></i>
                    </span>
                    <span class="text">Thêm Size hải sản</span>
                </button>
             </div>
        </div>
        <div class="card-body" >
            <div class="table-responsive ">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>                
                            <th>STT</th>
                            <th>Tên Size</th>
                            <th>Tên hải sản</th>
                            <th>Giá Size VNĐ</th>
                            <th>Sửa</th>
                            <th>Xóa</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>STT</th>
                            <th>Tên Size</th>
                            <th>Tên hải sản</th>
                            <th>Giá Size VNĐ</th>
                            <th>Sửa</th>
                            <th>Xóa</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($size as $size)
                        <tr>                               
                            <td>{{($loop->index)+1}}</td>
                            <td>Size {{ $size->tensize }}</td>
                            <td>{{ $size->banh->tenbanh }}</td>
                            <td>{{ number_format($size->gia) }}</td>
                            <td>                                    
                                <button onclick="EditSize({{ $size->masize }})" class="btn btn-warning btn-circle btn-sm" data-toggle="modal" data-target="#suasize">
                                    <i class="fas fa-edit"></i>
                                </button>
                            </td>
                            <td>
                            <button onclick="DeleteSize({{ $size->masize }})" class="btn btn-danger btn-circle btn-sm">
                                <i class="fas fa-trash"></i>
                            </button>
                            </td>
                        </tr>  
                        @endforeach
                                          
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection
@include('admin.form_input.themsize')
@include('admin.form_input.suasize')
@push('js')
<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
<script src="{{ asset('custom/admin/qlsizebanh.js') }}"></script>
@endpush

