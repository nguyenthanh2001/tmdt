@extends('master_layout.admin.layout_admin')
@push('css')
@endpush
<!-- Begin Page Content -->
@section('main_admin')
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Quản Lý Tài Khoản</h1>
    <p class="mb-4 text-info">Tại đây quản trị có thể thêm Tài Khoản , sửa Tài Khoản , xóa Tài Khoản ,
         xem thông tin Tài Khoản , tìm kiếm tất cả thông tin của Tài Khoản
    </p>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between">
            <div class="m-0 font-weight-bold text-primary">
                Tài Khoản
             </div>
             <div class="m-0 font-weight-bold text-primary">
                <button class="btn btn-success btn-icon-split" data-toggle="modal" data-target="#themtk">
                    <span class="icon text-white-50">
                        <i class="fa-duotone fa-plus"></i>
                    </span>
                    <span class="text">Thêm Tài Khoản</span>
                </button>
             </div>
        </div>
        <div class="card-body" >
            <div class="table-responsive ">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>                
                            <th>STT</th>
                            <th>Tên Người Dùng</th>
                            <th>Email</th>
                            <th>Giới Tính</th>
                            <th>Ngày Sinh</th>
                            <th>Số Điện Thoại</th>
                            <th>Địa Chỉ</th>
                            <th>Quyền</th>
                            <th>Sửa</th>
                            <th>Xóa</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>STT</th>
                            <th>Tên Người Dùng</th>
                            <th>Email</th>
                            <th>Giới Tính</th>
                            <th>Ngày Sinh</th>
                            <th>Số Điện Thoại</th>
                            <th>Địa Chỉ</th>
                            <th>Quyền</th>
                            <th>Sửa</th>
                            <th>Xóa</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($Account as $Account)
                        <tr>                               
                            <td>{{($loop->index)+1}}</td>
                            <td>{{ $Account->name }}</td>
                            <td>{{ $Account->email }}</td>
                            @if ($Account->gioitinh == 0)
                            <td>Nam</td>
                            @else
                            <td>Nữ</td>
                            @endif
                            <td>{{ $Account->ngaysinh }}</td>
                            <td>{{ $Account->sdt }}</td>
                            <td>{{ $Account->diachi}}</td>
                            @if ($Account->maquyen == 1)
                            <td>Admim</td>
                            @else
                            <td>Khách Hàng</td>
                            @endif
                            <td>                                    
                                <button onclick="EditAccount({{ $Account->id }})" class="btn btn-warning btn-circle btn-sm" data-toggle="modal" data-target="#suatk">
                                    <i class="fas fa-edit"></i>
                                </button>
                            </td>
                            <td>
                            <button onclick="DeleteAccount({{ $Account->id }})" class="btn btn-danger btn-circle btn-sm">
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

@endpush