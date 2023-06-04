@extends('master_layout.admin.layout_admin')
<!-- Begin Page Content -->
@push('css')
<link rel="stylesheet" href="{{ asset('asset/css/style.css') }}" type="text/css">
<style>
       .imgDetailBill{
            width:25%;
            height: 200px;
            object-fit: contain;
        } 
</style>
@endpush
@section('main_admin')
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Quản Lý Đơn hàng</h1>
        <p class="mb-4 text-info">Tại đây quản trị có thể Xem đơn hàng , duyệt đơn
        </p>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between">
                <div class="m-0 font-weight-bold text-primary">
                    Đơn hàng
                 </div>          
            </div>
            <div class="card-body" >
                <div class="table-responsive ">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>stt</th>
                                <th>Tên người dùng</th>
                                <th>Ngày đặt</th>
                                <th>Chỗ ở hiện tại</th>
                                <th>Địa chỉ</th>
                                <th>Ghi chú</th>
                                <th>Trạng thái</th>
                                <th>Xem</th>
                                @if ($trangthai != 2)
                                <th>Duyệt</th>
                                @endif
                                @if ($trangthai == 0)
                                <th>Xóa</th>                                         
                                @endif
                                @if ($trangthai == 1)
                                    <th>In</th>
                                @endif                               
                            </tr>
                        </thead>                                      
                        <tbody>  
                           
                            @forelse ($dataBill as $dataBill)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{$dataBill->user->name}}</td>
                                <td>{{$dataBill->created_at}}</td>                        
                                <td>{{$dataBill->noi->name}}-{{$dataBill->noi->huyen->name}}-{{$dataBill->noi->huyen->thanhpho->name}}</td>
                                <td>{{$dataBill->diachi}}</td>
                                <td>{{$dataBill->note}}</td>
                                <td>
                                    @if ($dataBill->trangthai == 0)
                                    <span class="badge badge-primary">Chờ duyệt đơn hàng</span>                                     
                                    @endif
                                    @if ($dataBill->trangthai == 1)
                                    <span class="badge badge-primary">Chờ nhận hàng</span>                                    
                                    @endif
                                    @if ($dataBill->trangthai == 2)
                                    <span class="badge badge-primary">Đã nhận hàng</span>                                  
                                    @endif
                                </td>
                                <td>
                                    <button type="button" class="btn btn-info rounded-circle btn-sm"  onclick="see({{$dataBill->mahd}})" data-toggle="modal" data-target="#xemhd0">
                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                    </button>
                                </td>
         
                                @if ($trangthai != 2)
                                <td>
                                    <form action="{{route('admin.updateBillAdmin')}}" method="POST"> 
                                        @csrf
                                    <input type="hidden" name="mahd" value="{{$dataBill->mahd}}">
                                    <button type="submit" class="btn btn-success rounded-circle btn-sm" >
                                        <i class="fa fa-truck" aria-hidden="true"></i>
                                    </button>
                                    </form>
                                </td>
                                @endif
                                @if ($trangthai == 0)
                                <td>
                                    <form action="{{route('admin.adminDeteleBill')}}" method="POST"> 
                                        @csrf
                                        <input type="hidden" name="mahd" value="{{$dataBill->mahd}}">
                                    <button type="submit" class="btn btn-danger rounded-circle btn-sm">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                    </button>
                                    </form>
                                </td>
                                @endif    
                                @if ($trangthai == 1)
                                <td><a href="{{route('admin.showBill',['id'=>$dataBill->mahd])}}" target="_blank" class="btn btn-primary rounded-circle btn-sm"><i class="fa fa-print" aria-hidden="true"></i></a></td>
                                @endif                       
                            </tr> 
                            @empty
                            @endforelse
                                                    
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="xemhd0">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Đơn hàng</h4>
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="shoping__cart__table">
                                <table>
                                    <thead>
                                        <tr>
                                            <th class="shoping__product">Sản phẩm</th>
                                            <th>Giá</th>
                                            <th>Số lượng</th>
                                            <th>Tổng giá</th>                  
                                        </tr>
                                    </thead>
                                    <tbody class="detailBill">
                                                                          
                                    </tbody>
                                </table>
                            </div>
                        </div>                
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                        </div>
                        <div class="col-lg-8">
                            <div class="shoping__checkout">
                                @if ($trangthai == 0)
                                <h5>Tổng giá đơn hàng đang chờ xác nhận</h5>
                                @else
                                @if ($trangthai == 1)
                                <h5>Tổng giá đơn hàng đã xác nhận</h5>
                                @else
                                <h5>Tổng giá đơn hàng đã nhận</h5>
                                @endif
                                @endif                               
                                <ul>                               
                                    <li>Tổng phụ <span class="TotalPrice"> VNĐ</span></li>
                                    <li>Toàn bộ <span class="TotalPrice"> VNĐ</span></li>
                                    @if ($trangthai == 2)
                                    <li>Đã thanh toán</li>
                                    @endif
                                </ul>                 
                            </div>
                        </div>
                    </div>
                    <div class="form-group ">                   
                        <button type="button" class="btn btn-danger"  data-dismiss="modal">Cancel</button>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
<script>
    var Linksee ='{{route('home.see')}}';
    var linkImg='{{asset('upload/imgCake')}}';
    </script>
    <script src="{{ asset('custom/waiting.js') }}"></script>
@endpush
