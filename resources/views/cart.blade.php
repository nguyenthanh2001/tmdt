@extends('master_layout.layout_trangchu')
@push('css')
    <link href=" {{ asset('admin/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <style>
        .iconPhone {
            margin-top: 15px;
        }
        .imgCart {
            width: 100%;
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
                        <h2>Shopping Cart</h2>
                        <div class="breadcrumb__option">
                            <a href="#">Home</a>
                            <span>Shopping Cart</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Breadcrumb Section End -->
    <section class="shoping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__table">
                        <form  method="POST" id="updatecart" enctype="multipart/form-data">  
                            @csrf
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>stt</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Size bánh</th>
                                    <th>Hình ảnh</th>
                                    <th>Khuyến mãi</th>
                                    <th>Giá</th>
                                    <th>Số lượng</th>
                                    <th>Tổng giá</th>
                                    <th></th>
                                </tr>
                            </thead>
                       
                            <tbody>   
                    
                                @forelse ($arCartID as $arCartID)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>
                                            <h5>{{ $arCartID['tenbanh'] }}</h5>
                                        </td>
                                        <td>
                                            @if (!empty($arCartID['sizebanh']))
                                                Size {{ $arCartID['sizebanh'] }}
                                            @endif
                                        </td>
                                        <td>
                                            <img src="{{ asset('upload/imgCake/' . $arCartID['hinhanh']) }}" alt=""
                                                class="imgCart img-thumbnail hact">
                                        </td>
                                        <td>
                                            @if (!empty($arCartID['khuyenmai']))
                                                {{ $arCartID['khuyenmai'] }}%
                                            @endif
                                        </td>
                                        <td>
                                            {{ $arCartID['gia'] }}
                                        </td>
                                        <td class="shoping__cart__quantity">                       
                                            <div class="quantity">
                                                <div class="pro-qty">
                                                    @if (!empty($arCartID['sizebanh']))
                                                    <input class="quantityCart" type="text" name="quantity[masize][{{ $arCartID['mabanh'] }}][{{ $arCartID['masize'] }}]"
                                                    value="{{ $arCartID['soluongmua'] }}" min="1" max="500" step="1">
                                                    @else
                                                    <input class="quantityCart" type="text" name="quantity[mabanh][{{ $arCartID['mabanh'] }}]"
                                                    value="{{ $arCartID['soluongmua'] }}" min="1" max="500" step="1">
                                                    @endif
                                                

                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            {{ $arCartID['tonggia'] }}
                                        </td>
                                        <td>
                                            @if (!empty($arCartID['sizebanh']))
                                            <button type="button" class="btn btn-danger btn-circle btn-sm" data-item="{{ $arCartID['mabanh'] }}"  data-size="{{ $arCartID['masize'] }}" onclick="DeleteItem(this);">
                                                <i class="fa fa-trash" aria-hidden="true"></i>
                                            </button>
                                            @else
                                            <button type="button" class="btn btn-danger btn-circle btn-sm"  data-item="{{ $arCartID['mabanh'] }}" onclick="DeleteItem(this);">
                                                <i class="fa fa-trash" aria-hidden="true"></i>
                                            </button>
                                            @endif
                                          
                                        </td>
                                    </tr>
                                @empty
                                @endforelse                                
                            </tbody>
                        </table>
                    
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__btns">
                        <a href="#" class="primary-btn cart-btn">CONTINUE SHOPPING</a>
                        <a href="#" class="primary-btn cart-btn cart-btn-right"><span class="icon_loading"></span>
                            Upadate Cart</a>
                    </div>
                     <input type="submit" >
                    </form>    
                </div>  
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
                <div class="col-lg-6">
                    <div class="shoping__checkout">
                        <h5>Tổng giỏ hàng</h5>
                        <ul>
                            <li>Tổng phụ <span>{{$Total}} VNĐ</span></li>
                            <li>Toàn bộ <span>{{$Total}} VNĐ</span></li>
                        </ul>
                        <a href="#" class="primary-btn">TIẾN HÀNH THANH TOÁN</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('js')
    <script>
        document.querySelector(".cart").classList.add('active');
        document.querySelector(".hero").classList.add("hero-normal");
    </script>
    <script>
     var urlUpdate = '{{route('home.UpdateCartQuantity')}}';
     var urlDelete ='{{route('home.DeleteItem')}}';
    </script>
    <script src="{{ asset('custom/showCart.js') }}"></script>
    <script src="{{ asset('admin/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <!-- Page level custom scripts -->
    <script src="{{ asset('admin/js/demo/datatables-demo.js') }}"></script>
@endpush
