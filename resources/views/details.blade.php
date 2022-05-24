@extends('master_layout.layout_trangchu')
@push('css')
    <style>
        .iconPhone {
            margin-top: 15px;
        }

        .nameCake {
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 1;
            /* number of lines to show */
            line-clamp: 1;
            -webkit-box-orient: vertical;
        }

        .iconCake {
            margin-top: 10px;
        }

    </style>
@endpush

@include('block.load')
@section('main')
    {{-- @dd(session('key')[0]) --}}

    <section class="breadcrumb-section set-bg" data-setbg="{{ asset('asset/img/breadcrumb.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Chi tiết sản phẩm</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.html">Home</a>
                            <a href="./index.html">Detail</a>
                            <span>{{ $detail->tenbanh }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Product Details Section Begin -->
    <section class="product-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__pic">
                        <div class="product__details__pic__item">
                            <img class="product__details__pic__item--large"
                                src="{{ asset('upload/imgCake/' . $detail->hinhanh) }}" alt="">
                        </div>
                        <div class="product__details__pic__slider owl-carousel">
                            <img data-imgbigurl="{{ asset('upload/imgCake/' . $detail->hinhanh) }}"
                                src="{{ asset('upload/imgCake/' . $detail->hinhanh) }}" alt="">
                            @foreach ($detail->anhct as $itemImg)
                                <img data-imgbigurl="{{ asset('upload/imgCakes/' . $itemImg->link) }}"
                                    src="{{ asset('upload/imgCakes/' . $itemImg->link) }}" alt="" style="object-fit: cover;height: 150px;
                                    width: 100%;">
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__text">
                        <h3>{{ $detail->tenbanh }}</h3>

                        <div class="row col-lg-12 col-md-12 col-sm-12 col-12 px-0">
                            <div class="col-lg-10 col-md-10 col-sm-10 col-10 ">

                                @if (isset($price['giabanh'][0]['tensize']))
                                    {{-- btn co size --}}
                                    @foreach ($price['giabanh'] as $detailItem)
                                        @if (isset($detailItem['giagiam']))
                                            <button type="button" data-giagiam="{{ $detailItem['giagiam'] }}"
                                                data-giagoc="{{ $detailItem['giagoc'] }}"
                                                class="btn btn-outline-primary m-1 btnPrice"
                                                value="{{ $detailItem['masize'] }}">Size
                                                {{ $detailItem['tensize'] }}</button>
                                        @else
                                            <button type="button" data-giagoc="{{ $detailItem['giagoc'] }}"
                                                class="btn btn-outline-primary m-1 btnPrice"
                                                value="{{ $detailItem['masize'] }}">Size
                                                {{ $detailItem['tensize'] }}</button>
                                        @endif
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        @if (isset($price['giabanh'][0]['giagiam']))
                            {{-- co giam gia --}}
                            <div class="product__details__price" data-giamgia='{{ $price['giabanh'][0]['giagiam'] }}'
                                data-giagoc='{{ $price['giabanh'][0]['giagoc'] }}'
                                data-price="{{ $price['giabanh'][0]['giagiam'] }}">
                                <del>{{ $price['giabanh'][0]['giagoc'] }} VND</del>
                                <span class="ml-1">{{ $price['giabanh'][0]['giagiam'] }} VND</span>

                            </div>
                        @else
                            <div class="product__details__price" data-giagoc='{{ $price['giabanh'][0]['giagoc'] }}'
                                data-price="{{ $price['giabanh'][0]['giagoc'] }}">{{ $price['giabanh'][0]['giagoc'] }}
                                VND</div>
                        @endif

                        <p>{!! Str::limit($detail->mota, 30) !!}</p>

                        <form method="post" id="addCart">
                            @csrf
                            <div class="product__details__quantity">
                                <div class="quantity">
                                    <div class="pro-qty">
                                        <input type="number" name="soluong" value="1">
                                    </div>
                                </div>
                            </div>

                            <input type="hidden" name="mabanh" value="{{ $detail->mabanh }}" readonly required>
                            @if (isset($price['giabanh'][0]['tensize']))
                                <input type="hidden" name="masize" value="{{ $price['giabanh'][0]['masize'] }}" id="masize"
                                    readonly required>
                            @endif
                            <button type="submit" class="primary-btn">Thêm vào giỏ hàng</button>

                        </form>
                        <ul>
                            <li><b>Kho</b> <span>Bánh sẽ được làm sau khi đặt hàng</span></li>
                            <li><b>Shipping</b> <span>sau 1 ngày tính từ lúc duyệt đơn hàng. </span></li>
                            <li><b>Đơn hàng</b> <span>Miễn phí ship nội thành với số lượng trên 5</span></li>
                            <li><b>Địa chỉ</b> <span><a class="badge badge-primary"
                                        href="https://www.google.com/maps/dir/?api=1&destination=10.253395%2C105.975496&fbclid=IwAR0mjBTMyRYJ3RZ-JvBpzvC1tUoPbaav56RS_fcR7P__p7yU97F4cjYdCAg">
                                        Số 14, Đường 2/9, Phường 1
                                        Vĩnh Long</a></span></li>
                            <li><b>Thông tin về quán</b>
                                <div class="share">
                                    <a href="https://www.facebook.com/tiembanhgiahy"><i class="fa fa-facebook"></i></a>

                                </div>
                            </li>

                        </ul>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="product__details__tab">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab"
                                    aria-selected="true">Mô tả sản phẩm</a>
                            </li>

                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>Thông tin sản phẩm</h6>
                                    {!! $detail->mota !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Details Section End -->

    <!-- Related Product Section Begin -->
    <section class="related-product">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title related__product__title">
                        <h2>Hình ảnh liên quan</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($indexCake as $itemCake)
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="product__item">
                            <div class="product__item__pic set-bg"
                                data-setbg="{{ asset('upload/imgCake/' . $itemCake->hinhanh) }}">
                                <ul class="product__item__pic__hover">
                                    <li><a href="{{ route('home.details', ['id' => $itemCake->mabanh]) }}"><i
                                                class="iconCake fa fa-eye"></i></a></li>
                                </ul>
                            </div>
                            <div class="product__item__text">
                                <h6 class="nameCake"><a
                                        href="{{ route('home.details', ['id' => $itemCake->mabanh]) }}">{{ $itemCake->tenbanh }}</a>
                                </h6>
                                @if ($itemCake->giabanh == 0)
                                    <h5 class="product__item__price">
                                        <p class="badge badge-pill badge-success">bánh có nhiều size</p>
                                    </h5>
                                @else
                                    <h5>{{ number_format($itemCake->giabanh) }} VNĐ</h5>
                                @endif

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
@push('js')
    <script>
        document.querySelector(".details").classList.add('active');
        document.querySelector(".hero").classList.add("hero-normal");
    </script>
    <script src="{{ asset('custom/detail.js') }}"></script>
    <script>
        var urlAddCart = '{{ route('home.addCart') }}';
    </script>
    <script src="{{ asset('custom/addCart.js') }}"></script>
@endpush
