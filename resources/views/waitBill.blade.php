@extends('master_layout.layout_trangchu')
@push('css')
<link href="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <style>
        .iconPhone {
            margin-top: 12px;
        }    
        .imgDetailBill{
            width:25%;
            height: 200px;
            object-fit: contain;
        }   
    </style>
@endpush

@include('block.load')
@section('main')
    <section class="breadcrumb-section set-bg" data-setbg="{{ asset('asset/img/breadcrumb.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Đơn hàng</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.html">Home</a>
                            @if ($trangthai == 0)
                            <span>Chờ xác nhận</span>
                            @else
                                @if ($trangthai == 1)
                                <span>Đã xác nhận</span>
                                @else
                                <span>Đã nhận</span>
                                @endif
                            @endif
                         
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="shoping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__table">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>stt</th>
                                    <th>Tên người dùng</th>
                                    <th>Ngày đặt</th>
                                    <th>Chỗ ở hiện tại</th>
                                    <th>Địa chỉ</th>
                                    <th>Ghi chú</th>
                                    <th>Xem</th>
                                    @if ($trangthai == 0)
                                    <th>Xóa</th>                                         
                                    @endif
                                   
                                </tr>
                            </thead>                                      
                            <tbody>   
                                @forelse ($dataBill as $dataBill)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{Auth::user()->name}}</td>
                                    <td>{{$dataBill->created_at}}</td>
                                    <td>{{$dataBill->user->Diachi->name}}-{{$dataBill->user->Diachi->huyen->name}}-{{$dataBill->user->Diachi->huyen->thanhpho->name}}</td>
                                    <td>{{$dataBill->diachi}}</td>
                                    <td>{{$dataBill->note}}</td>
                                    <td>
                                        <button type="button" class="btn btn-info rounded-circle btn-sm"  onclick="see({{$dataBill->mahd}})" data-toggle="modal" data-target="#xemhd0">
                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                        </button>
                                    </td>
                                    @if ($trangthai == 0)
                                    <td>
                                        <form action="{{route('home.detelebill')}}" method="POST"> 
                                            @csrf
                                            <input type="hidden" name="mahd" value="{{$dataBill->mahd}}">
                                        <button type="submit" class="btn btn-danger rounded-circle btn-sm">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                        </button>
                                        </form>
                                    </td>
                                    @endif                           
                                </tr> 
                                @empty
                                @endforelse
                                                        
                            </tbody>
                        </table>
                    
                    </div>
                </div>
            </div>
            <div class="row">             
                <div class="col-lg-6">
                    <div class="shoping__continue">
                        <div class="shoping__discount">
                            <h5 style="font-family: 'FontAwesome';">Lưu ý</h5>
                            <li><b>Kho :</b> <span>Bánh sẽ được làm sau khi đặt hàng</span></li>
                            <li><b>Shipping :</b> <span>sau 1 ngày tính từ lúc duyệt đơn hàng. </span></li>
                            <li><b>Đơn hàng :</b> <span>Miễn phí ship nội thành với số lượng trên 5</span></li>
                            <li><b>Địa chỉ :</b> <span><a class="badge badge-primary"
                                        href="https://www.google.com/maps/dir/?api=1&destination=10.253395%2C105.975496&fbclid=IwAR0mjBTMyRYJ3RZ-JvBpzvC1tUoPbaav56RS_fcR7P__p7yU97F4cjYdCAg">
                                        Số 14, Đường 2/9, Phường 1
                                        Vĩnh Long</a></span></li>
                            <li><b>Thông tin về quán: </b>
                                <span class="share" >
                                    <a href="https://www.facebook.com/tiembanhgiahy" style="font-size: 18px;"><i class="fa fa-facebook"></i></a>
                                </span>
                            </li>
    
                        </ul>
                        </div>
                    </div>
                    <ul>
                       
                </div>                
            </div>
        </div>
    </section>
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
        document.querySelector(".order").classList.add('active');
        document.querySelector(".hero").classList.add("hero-normal");
    </script>
    <script src="{{ asset('admin/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <!-- Page level custom scripts -->
    <script src="{{ asset('admin/js/demo/datatables-demo.js') }}"></script>
    <script>
    var Linksee ='{{route('home.see')}}';
    var linkImg='{{asset('upload/imgCake')}}';
    </script>
    <script src="{{ asset('custom/waiting.js') }}"></script>
@endpush
