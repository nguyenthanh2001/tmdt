 <!-- Page Preloder -->
 @yield('load')

<!-- Humberger Begin -->

<div class="humberger__menu__overlay"></div>
<div class="humberger__menu__wrapper">
    <div class="humberger__menu__logo">
        <a href=""><img src="{{ asset('asset/img/logo2.png') }}" alt=""></a>
    </div>
    <div class="humberger__menu__cart">
        <ul>
            <li><a href="#"><i class="fa fa-heart"></i> <span>1</span></a></li>
            <li><a href="#"><i class="fa fa-shopping-bag"></i> <span>3</span></a></li>
        </ul>
        <div class="header__cart__price">item: <span>$150.00</span></div>
    </div>
    <div class="humberger__menu__widget">

        <div class="header__top__right__language">
            
            @if (Auth::check())
            <div>
                <i class="fa fa-address-card" aria-hidden="true"></i>
                 Thông tin cá nhân
            </div>
            <span class="arrow_carrot-down"></span>
            <ul>
                <li><a href="#">Hồ sơ</a></li>
                <li><a href="#">Đăng xuất</a></li>
            </ul>
            @else
            <div>Đăng ký</div>
            @endif          
        </div>
        <div class="header__top__right__auth">
            @if (Auth::check())
            <div>
                <i class="fa fa-user"></i>
                <span>{{Auth::user()->name}}</span>
            </div>
            @else
            <a href="#"><i class="fa fa-user"></i>Đăng Nhập</a>
            @endif
        
        </div>
    </div>
    <nav class="humberger__menu__nav mobile-menu">
        <ul>
            <li class="home"><a href="{{ route('index') }}">Trang Chủ</a></li>
            <li class="shop"><a href="{{ route('home.shop') }}">Cửa Hàng</a></li>
            <!-- <li class="details"><a>Details</a></li> -->
            <li class="cart"><a href="{{ route('home.ShowCart') }}">Giỏ Hàng</a></li>
            <li class="order"><a>Đơn hàng</a>
                <ul class="header__menu__dropdown">
                    <li><a href="{{ route('home.chechout') }}">Thủ tục thanh toán</a></li>
                    <li><a href="{{route('home.Waiting')}}">Chờ xác nhận</a></li>
                    <li><a href="./blog-details.html">Đã xác nhận</a></li>
                    <li><a href="./blog-details.html">Đã nhận</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="mobile-menu-wrap"></div>
    <div class="header__top__right__social">
        <a href="#"><i class="fa fa-facebook"></i></a>
        <a href="#"><i class="fa fa-twitter"></i></a>
        <a href="#"><i class="fa fa-linkedin"></i></a>
        <a href="#"><i class="fa fa-pinterest-p"></i></a>
    </div>
    <div class="humberger__menu__contact">
        <ul>
            <li><i class="fa fa-envelope"></i> 19004184@st.vlute.edu.vn</li>
            <li>Miễn phí giao hàng trong khu vực Vĩnh Long</li>
        </ul>
    </div>
</div>
<!-- Humberger End -->

<!-- Header Section Begin -->
<!-- dau -->
<header class="header">
    <div class="header__top">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="header__top__left">
                        <ul>
                            <li><i class="fa fa-envelope"></i> 19004184@st.vlute.edu.vn </li>
                            <li>Miễn phí giao hàng trong khu vực Vĩnh Long</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="header__top__right">
                        <div class="header__top__right__social">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <!-- <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-linkedin"></i></a>
                            <a href="#"><i class="fa fa-pinterest-p"></i></a> -->
                        </div>
                        <div class="header__top__right__language">
                            @if (Auth::check())
                            <div>
                                <i class="fa fa-address-card" aria-hidden="true"></i>
                                 Thông tin cá nhân
                            </div>
                            <span class="arrow_carrot-down"></span>
                            <ul>
                                <li><a  data-toggle="modal" data-target="#infouser">Hồ sơ</a></li>
                                <li><a href="{{ route('home.dangxuat') }}">Đăng xuất</a></li>
                            </ul>
                            @else
                            <a href="{{ route('home.dangky') }}">
                                <div>
                                 <i class="fa fa-address-card" aria-hidden="true"></i>
                                  Đăng ký
                                </div>
                            </a>
                           @endif
                            
                        </div>
                        <div class="header__top__right__auth">
                            @if (Auth::check())
                            <div><i class="fa fa-user"></i>
                                <span>{{ Auth::user()->name }}</span>
                            </div>
                            @else
                            <a href="{{ route('home.dangnhap') }}"><i class="fa fa-user"></i> Đăng nhập</a>
                            @endif                         
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="header__logo">
                    <a href="{{ route('index') }}"><img src="{{ asset('asset/img/logo3.png') }}" alt=""></a>
                </div>
            </div>
            <div class="col-lg-6">
                <nav class="header__menu">
                    <ul>
                        <li class="home"><a href="{{ route('index') }}">Trang Chủ</a></li>
                        <li class="shop"><a href="{{ route('home.shop') }}">Cửa Hàng</a></li>
                        <!-- <li class="details"><a>Details</a></li> -->
                        <li class="cart"><a href="{{ route('home.ShowCart') }}">Giỏ Hàng</a></li>
                        <li class="order"><a>Đơn hàng</a>
                            <ul class="header__menu__dropdown">
                                <li><a href="{{ route('home.chechout') }}">Thủ tục thanh toán</a></li>
                                <li><a href="{{route('home.Waiting')}}">Chờ xác nhận</a></li>
                                <li><a href="{{route('home.confirmedBill')}}">Đã xác nhận</a></li>
                                <li><a href="{{route('home.Success')}}">Đã nhận</a></li>
                            </ul>
                        </li>
                        
                    </ul>
                </nav>
            </div>
            <div class="col-lg-3">
                <div class="header__cart">
                    <ul>                   
                        @if (empty($itemCart))
                        <li><a href="{{ route('home.ShowCart') }}"><i class="fa fa-shopping-bag"></i> <span>0</span></a></li>
                        @else
                        <li><a href="{{ route('home.ShowCart') }}"><i class="fa fa-shopping-bag"></i> <span>{{$itemCart['numberOfItems']}}</span></a></li>
                        @endif
                       
                    </ul>
                    @if (empty($itemCart))
                          <div class="header__cart__price">Tổng giá: <span>0 VNĐ</span></div>
                        @else
                        <div class="header__cart__price">Tổng giá: <span class="TotalPrice">{{$itemCart['Total']}} VNĐ</span></div>
                        @endif
                    
                </div>
            </div>
        </div>
        <div class="humberger__open">
            <i class="fa fa-bars"></i>
        </div>
    </div>
</header>
<!-- Header Section End -->
<!-- Hero Section Begin -->
<section class="hero">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="hero__categories">
                    <div class="hero__categories__all">
                        <i class="fa fa-bars"></i>
                        <span>Loại Hải Sản</span>
                    </div>
                    <ul>                 
                        @forelse ($loaibanh as $loaibanh)
                        <li><a href="{{route('home.category',['id' => $loaibanh->maloai ]) }}">{{$loaibanh->tenloai }}</a></li>
                        @empty
                        <li>Không có dữ liệu</li>
                        @endforelse                    
                    </ul>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="hero__search">
                    <div class="hero__search__form">
                        <form action="{{ route('home.shop') }}" method="GET">
                            <div class="hero__search__categories">
                                Tất cả hải sản
                                <span class="arrow_carrot-down"></span>
                            </div>
                            <input type="text" name="q" placeholder="Nhập tên hải sản">
                            <button type="submit" class="site-btn">Tìm kiểm</button>
                        </form>
                    </div>
                    <div class="hero__search__phone">
                        <div class="hero__search__phone__icon">
                            <i class="fa fa-phone iconPhone"></i>
                        </div>
                        <div class="hero__search__phone__text">
                            <h5>+84 386541287</h5>
                            <span>Hỗ trợ 24/7 giờ</span>
                        </div>
                    </div>
                </div>
                @yield('img_sidebar')             
            </div>
        </div>
    </div>
</section>
<!-- Hero Section End -->
