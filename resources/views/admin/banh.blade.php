@extends('master_layout.admin.layout_admin')
@push('css')
    <link href=" {{ asset('admin/hashtag/tagsinput.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
@endpush
<!-- Begin Page Content -->
@section('main_admin')
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Quản Lý Bánh Ngọt</h1>
        <p class="mb-4 text-info">Tại đây quản trị có thể thêm Bánh, sửa Bánh , xóa Bánh ,
            xem thông tin Bánh , tìm kiếm tất cả thông tin của Bánh
        </p>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between">
                <div class="m-0 font-weight-bold text-primary">
                    Quản Lý Bánh
                </div>
                <div class="m-0 font-weight-bold text-primary">
                    <button class="btn btn-success btn-icon-split" data-toggle="modal" data-target="#thembanh">
                        <span class="icon text-white-50">
                            <i class="fa-duotone fa-plus"></i>
                        </span>
                        <span class="text">Thêm Bánh</span>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive ">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Tên Tên Bánh</th>
                                <th>Hình Ảnh</th>
                                <th>Số Lượng</th>
                                <th>Mô Tả</th>
                                <th>Gía Bánh</th>
                                <th>Loại Bánh</th>
                                <th>Khuyến Mãi %</th>
                                <th>Sửa</th>
                                <th>Xóa</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>STT</th>
                                <th>Tên Tên Bánh</th>
                                <th>Hình Ảnh</th>
                                <th>Số Lượng</th>
                                <th>Mô Tả</th>
                                <th>Gía Bánh</th>
                                <th>Loại Bánh</th>
                                <th>Khuyến Mãi %</th>
                                <th>Sửa</th>
                                <th>Xóa</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($banh as $item)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $item['tenbanh'] }}</td>
                                    <td>{{ $item['hinhanh'] }}</td>
                                    <td>{{ $item['soluong'] }}</td>
                                    <td> {{ Str::limit($item['mota'], 30) }}</td>
                                   
                                    <td>{{ $item['giabanh'] }}</td>
                                    @if (!empty($item['loaibanh']))
                                        <td>{{ $item['loaibanh']['tenloai'] }}</td>
                                    @else
                                        <td>Không có Loại Bánh</td>
                                    @endif

                                    @if (!empty($item['khuyenmai']))
                                        <td>{{ $item['khuyenmai']['giatri'] }}</td>
                                    @else
                                        <td>0</td>
                                    @endif

                                    <td>
                                        <button onclick="suabanh({{ $item['mabanh'] }})"
                                            class="btn btn-warning btn-circle btn-sm" data-toggle="modal"
                                            data-target="#suabanh">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    </td>
                                    <td>
                                        <button onclick="xoakm({{ $item['mabanh'] }})"
                                            class="btn btn-danger btn-circle btn-sm">
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
    @include('admin.form_input.thembanh')
    
@endsection
@push('js')
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
    <script src="{{ asset('custom/admin/qlbanh.js') }}"></script>
    <script src="{{ asset('admin/hashtag/tagsinput.js') }}"></script>  
@endpush
