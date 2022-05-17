@extends('master_layout.layout_trangchu')
@push('css')
    <style>
        .iconPhone {
            margin-top: 15px;
        }      
        .checkout__input input {
            color: #212529;
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
                        <h2>Checkout</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.html">Home</a>
                            <span>Checkout</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="checkout spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h6><span class="icon_tag_alt"></span>Vui lòng tra sản phẩm và thông tin cá nhân để thanh toán
                    </h6>
                </div>
            </div>
      
            <div class="checkout__form">
                <h4>HÓA ĐƠN</h4>
                <form action="{{route('home.HandleCheckout')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="checkout__input">
                                <p>Tên người dùng<span>*</span></p>
                                <input  type="text" value="{{Auth::user()->name}}" readonly>
                            </div>                       
                            <div class="checkout__input">
                                <p>Xã-Phường-Thị Trấn , Quận-Huyện , Tỉnh-Thành Phố<span>*</span></p>
                                <input  type="text" placeholder="Street Address" class="checkout__input__add" value="{{$name->name}} - {{$name->huyen->name}} - {{$name->huyen->thanhpho->name}}" readonly>
                            </div>
                            <div class="checkout__input">
                                <p>Địa chỉ<span>*</span></p>
                                <input  type="text" value="{{Auth::user()->diachi}}" readonly>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Số điện thoại<span>*</span></p>
                                        <input type="text" value="{{Auth::user()->sdt}}" readonly>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Email<span>*</span></p>
                                        <input class="inputCheckout" type="text" value="{{Auth::user()->email}}" readonly>
                                    </div>
                                </div>
                            </div>                                             
                            <div class="checkout__input">
                                <p>Ghi chú<span></span></p>
                                <input type="text" name="note" placeholder="Thêm lời nhắn với cửa hàng">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="checkout__order">
                                <h4>Sản phẩm trong giỏ hàng</h4>
                                <div class="checkout__order__products">Sản phẩm <span>Giá</span></div>
                                <ul>
                                    @forelse ($Cart as $Checkout)
                                    @if (empty($Checkout['masize']))
                                    <li>{{$Checkout['tenbanh']}} <span>{{number_format($Checkout['tonggia'])}}</span></li>    
                                    @else
                                    <li>{{$Checkout['tenbanh']}} - Size {{$Checkout['sizebanh']}} <span>{{number_format($Checkout['tonggia'])}}</span></li>
                                    @endif
                                                       
                                    @empty                            
                                    @endforelse
                                 
                                </ul>
                                <div class="checkout__order__subtotal">Tổng phụ<span>{{number_format($Total)}} VNĐ</span></div>
                                <div class="checkout__order__total">Toàn bộ<span>{{number_format($Total)}} VNĐ</span></div>
                                <div class="checkout__input__checkbox">
                                    <p>Kiểm tra sản phẩm trước khi thanh toán</p>
                                </div>
                                
                                {{-- <div class="checkout__input__checkbox">
                                    <label for="payment">
                                        Check Payment
                                        <input type="checkbox" id="payment">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="checkout__input__checkbox">
                                    <label for="paypal">
                                        Paypal
                                        <input type="checkbox" id="paypal">
                                        <span class="checkmark"></span>
                                    </label>
                                </div> --}}
                                <div style="text-align: center;">
                                    <button type="submit" class="site-btn" style="width:50%;">Thanh Toán</button>
                                </div>
                               
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
@push('js')
    <script>
        document.querySelector(".order").classList.add('active');
        document.querySelector(".hero").classList.add("hero-normal");
    </script>
    <!-- Page level custom scripts -->
    <script></script>
@endpush
