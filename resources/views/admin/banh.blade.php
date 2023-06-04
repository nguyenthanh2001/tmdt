@extends('master_layout.admin.layout_admin')
@push('css')
    <link href=" {{ asset('admin/hashtag/tagsinput.css') }}" rel="stylesheet">
    <link href=" {{ asset('custom/css/formAddCake.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
@endpush
<!-- Begin Page Content -->
@section('main_admin')
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Quản Lý Hải Sản</h1>
        <p class="mb-4 text-info">Tại đây quản trị có thể thêm Hải sản, sửa Hải sản , xóa Hải sản ,
            xem thông tin Hải sản , tìm kiếm tất cả thông tin của Hải sản
        </p>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between">
                <div class="m-0 font-weight-bold text-primary">
                    Quản Lý Hải Sản
                </div>
                <div class="m-0 font-weight-bold text-primary">
                    <button class="btn btn-success btn-icon-split" data-toggle="modal" data-target="#thembanh">
                        <span class="icon text-white-50">
                            <i class="fa-duotone fa-plus"></i>
                        </span>
                        <span class="text">Thêm Hải Sản</span>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Tên Hải sản</th>
                                <th>Hình Ảnh</th>
                                <th>Số Lượng</th>
                                <th>Mô Tả</th>
                                <th>Giá Hải sản VNĐ</th>
                                <th>Loại Hải sản</th>
                                <th>Khuyến Mãi %</th>
                                <th>Sửa</th>
                                <th>Xóa</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>STT</th>
                                <th>Tên Hải sản</th>
                                <th>Hình Ảnh</th>
                                <th>Số Lượng</th>
                                <th>Mô Tả</th>
                                <th>Giá Hải sản VNĐ</th>
                                <th>Loại Hải sản</th>
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
                                    <td style="width:20%"><img style="width:100%;height: 200px;object-fit: contain;" src="{{asset('upload/imgCake/'.$item['hinhanh'])  }}" alt="{{ $item['tenbanh'] }}" class="img-thumbnail hact" onclick="seeimg(this)" data-original="{{asset('upload/imgCake/'.$item['hinhanh'])  }}"></td>
                                    <td>{{ $item['soluong'] <= 0 ? 'Hết hàng' : $item['soluong'] }}</td>
                                    <td> {{ Str::limit($item['mota'], 30) }}</td>
                                   @if ($item['giabanh'] == 0)
                                   <td><button class="badge badge-pil badge-success">Hải sản có nhiều Size</button></td>
                                   @else
                                   <td>{{ number_format($item['giabanh']) }}</td>
                                   @endif

                                    <td><span class="badge badge-pill badge-info">{{ $item['loaibanh']['tenloai'] }}</span> </td>
                                    @if (!empty($item['khuyenmai']))
                                        <td>{{ $item['khuyenmai']['giatri'] }}</td>
                                    @else
                                        <td>0</td>
                                    @endif

                                    <td>
                                        <button onclick="editCake({{ $item['mabanh'] }})"
                                            class="btn btn-warning btn-circle btn-sm" data-toggle="modal"
                                            data-target="#suabanh">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    </td>
                                    <td>
                                        <button onclick="deleteCake({{ $item['mabanh'] }})"
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

    <div >
        <div class="show-img">
        <img class="full" src="" alt="" >
        </div>
    </div>


    @include('admin.form_input.thembanh')
    @include('admin.form_input.suabanh')

@endsection
@push('js')
<script src="https://platform.linkedin.com/badges/js/profile.js" async defer type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
    <script src="{{ asset('custom/admin/qlbanh.js') }}"></script>
    <script src="{{ asset('custom/admin/SeeImgCake.js') }}"></script>
    <script src="{{ asset('admin/hashtag/tagsinput.js') }}"></script>
    <script src="https://cdn.ckeditor.com/4.18.0/standard/ckeditor.js"></script>
    <script>
         CKEDITOR.replace( 'editor' );
         CKEDITOR.replace( 'editor1' );
    </script>
@endpush
