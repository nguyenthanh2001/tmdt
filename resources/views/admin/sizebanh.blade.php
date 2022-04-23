@extends('master_layout.admin.layout_admin')
@push('css')
@endpush
<!-- Begin Page Content -->
@section('main_admin')
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Quản Lý Size Bánh</h1>
    <p class="mb-4 text-info">Tại đây quản trị có thể thêm Size bánh , sửa Size bánh , xóa Size bánh ,
         xem thông tin Size bánh , tìm kiếm tất cả thông tin của Size bánh
    </p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between">
            <div class="m-0 font-weight-bold text-primary">
                Size Bánh
             </div>
             <div class="m-0 font-weight-bold text-primary">
                <button class="btn btn-success btn-icon-split" data-toggle="modal" data-target="#themloaibanh">
                    <span class="icon text-white-50">
                        <i class="fa-duotone fa-plus"></i>
                    </span>
                    <span class="text">Thêm Size Bánh</span>
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
                            <th>Tên Bánh</th>
                            <th>Giá Size VNĐ</th>
                            <th>Sửa</th>
                            <th>Xóa</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>STT</th>
                            <th>Tên Size</th>
                            <th>Tên Bánh</th>
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
                                <button onclick="EditSize({{ $size->masize }})" class="btn btn-warning btn-circle btn-sm" data-toggle="modal" data-target="#sualoaibanh">
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
@push('js')
<script src="{{ asset('custom/admin/qlsizebanh.js') }}"></script>
@endpush
