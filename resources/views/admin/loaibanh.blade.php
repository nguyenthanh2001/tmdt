@extends('master_layout.admin.layout_admin')
<!-- Begin Page Content -->

@section('main_admin')
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Quản Lý Loại Bánh</h1>
        <p class="mb-4 text-info">Tại đây quản trị có thể thêm loại bánh , sửa loại bánh , xóa loại bánh ,
             xem thông tin loại bánh , tìm kiếm tất cả thông tin của loại bánh
        </p>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between">
                <div class="m-0 font-weight-bold text-primary">
                    Loại Bánh
                 </div>
                 <div class="m-0 font-weight-bold text-primary">
                    <button class="btn btn-success btn-icon-split" data-toggle="modal" data-target="#themloaibanh">
                        <span class="icon text-white-50">
                            <i class="fa-duotone fa-plus"></i>
                        </span>
                        <span class="text">Thêm Loại Bánh</span>
                    </button>
                 </div>
            </div>
            <div class="card-body" >
                <div class="table-responsive ">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>                
                                <th>STT</th>
                                <th>Tên Loại</th>
                                <th>Sửa</th>
                                <th>Xóa</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>STT</th>
                                <th>Tên Loại</th>
                                <th>Sửa</th>
                                <th>Xóa</th>
                            </tr>
                        </tfoot>
                        <tbody id="showloaibach">
                            @foreach ($ad_lb as $ad_lb)
                            <tr>                               
                                <td>{{($loop->index)+1}}</td>
                                <td>{{ $ad_lb->tenloai }}</td>
                                <td>                                    
                                    <button onclick="sualoaibanh({{ $ad_lb->maloai }})" class="btn btn-warning btn-circle btn-sm" data-toggle="modal" data-target="#sualoaibanh">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                </td>
                                <td>
                                <button onclick="xoaloaibanh({{ $ad_lb->maloai }})" class="btn btn-danger btn-circle btn-sm">
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
    
    <!-- modal them -->
    <div class="modal fade" id="themloaibanh">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Thêm loại bánh</h4>
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form id="formloaibanh" method="POST">
                        @csrf
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Tên Loại Bánh" name="tenloai" required>
                    </div>
                    <div class="form-group ">
                        <button type="submit " name="submit" value="Gửi" id="btn_them" class="btn btn-success">Thêm</button>
                        <button type="button" class="btn btn-danger"  data-dismiss="modal">Cancel</button>
                    </div>
                    </form>       
                </div>
            </div>
        </div>
    </div>
    <!-- modal sua -->
    <div class="modal fade" id="sualoaibanh">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Sửa loại bánh</h4>
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form id="form-edit" method="POST">
                        @csrf
                    <div class="form-group">
                        <input type="text" class="form-control" id="tenloaibanh" placeholder="Tên Loại Bánh" name="tenloai" required>
                    </div>
                    <div class="form-group ">
                        <button type="submit " name="submit" id="btn-edit-from" class="btn btn-success">Sửa</button>
                        <button type="button" class="btn btn-danger"  data-dismiss="modal">Cancel</button>
                    </div>
                    </form>       
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
<script src="{{ asset('custom/admin/loaibanh.js') }}"></script>
@endpush
