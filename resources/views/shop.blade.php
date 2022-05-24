@extends('master_layout.layout_trangchu')
@push('css')
<style>
    .nameCake {
   overflow: hidden;
   text-overflow: ellipsis;
   display: -webkit-box;
   -webkit-line-clamp: 1; /* number of lines to show */
           line-clamp: 1; 
   -webkit-box-orient: vertical;
}
.iconPhone{
    margin-top: 15px;
}
.iconCake{
    margin-top: 10px;
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
                    <h2>Cake Shop</h2>
                    <div class="breadcrumb__option">
                        <a href="./index.html">Home</a><span>Shop</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="product spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-5">
                <div class="sidebar">
                    <div class="sidebar__item">
                        <h4>Loại Bánh</h4>
                        <ul>  
                            <li><a href="{{route('home.shop') }}">Xem tất cả</a></li>                      
                            @forelse ($loaibanh as $loaibanhShop)                
                            <li><a href="{{route('home.category',['id' => $loaibanhShop->maloai ]) }}">{{$loaibanhShop->tenloai }}</a></li>
                            @empty
                            <li>Không có dữ liệu</li>
                            @endforelse                                       
                        </ul>
                    </div>           
                
           
                    <div class="sidebar__item">
                        <div class="latest-product__text">
                            <h4>Loại khuyến mãi</h4>
                            <div class="latest-product__slider owl-carousel">
                                @foreach ($custom as $value)
                                <div class="latest-prdouct__slider__item">
                                    @forelse ($value as $value2)                                  
                                    <a href="#" class="latest-product__item">
                                        <div class="latest-product__item__pic">
                                            <img src="{{ asset('upload/imgCake/'. $value2['hinhanh']) }}" alt="" style="width: 100px;object-fit: cover;">
                                        </div>
                                        
                                        <div class="latest-product__item__text">
                                            <h6>{{ $value2['tenbanh'] }}</h6>
                                            @if ($value2['giabanh']==0)
                                            <span>Bánh có nhiều Size</span> 
                                            @else
                                            @if ($value2['khuyenmai']==null)
                                            <span>{{ number_format($value2['giabanh']) }} VNĐ</span>
                                            @else
                                            <span style="font-size: 14px">giảm {{$value2['khuyenmai']['giatri'] }} %</span>
                                            <span style="font-size: 14px"> <del>{{ number_format($value2['giabanh']) }} VNĐ</del></span>
                                            <span>{{ number_format( ($value2['giabanh']*((100-$value2['khuyenmai']['giatri'])/100)) )}} VNĐ</span>                             
                                            @endif
                                           
                                            @endif
                                        </div>
                                    </a>
                                    @empty                                       
                                    @endforelse                                                                    
                                </div>   
                                @endforeach
                              
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 col-md-7">
                <div class="product__discount">
                    <div class="section-title product__discount__title">
                        <h2>Giảm giá</h2>
                    </div>             
                    <div class="filter__found">
                        <h6><span>{{ $CoutSale }}</span> Sản phẩm được giảm giá</h6>
                    </div>
                   
                    <div class="row">
                        <div class="product__discount__slider owl-carousel">
                        
                            @foreach ($khuyenmai as $khuyenmai)                  
                            <div class="col-lg-4">
                                <div class="product__discount__item">
                                    <div class="product__discount__item__pic set-bg"
                                        data-setbg="{{ asset('upload/imgCake/'.$khuyenmai['hinhanh']) }}">
                                        <div class="product__discount__percent">{{$khuyenmai['khuyenmai']['giatri']}}%</div>
                                        <ul class="product__item__pic__hover">                                                                           
                                            <li><a href="{{route('home.details',['id'=>$khuyenmai['mabanh']])}}"> <i class="iconCake fa fa-eye" aria-hidden="true"></i></a></li>
                                            <li><a href="#"><i class="iconCake fa fa-shopping-cart"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="product__discount__item__text">
                                        <span>{{$khuyenmai['loaibanh']['tenloai']}}</span>
                                        <h5><a href="{{route('home.details',['id'=>$khuyenmai['mabanh']])}}">{{$khuyenmai['tenbanh']}}</a></h5>
                                        @if ($khuyenmai['giabanh'] == 0)
                                        <div class="product__item__price"> <p class="badge badge-pill badge-success">bánh có nhiều size</p> </div>
                                        @else
                                        <div class="product__item__price">{{ number_format( ($khuyenmai['giabanh']*((100-$khuyenmai['khuyenmai']['giatri'])/100)) )}} VNĐ <span>{{ number_format($khuyenmai['giabanh']) }} VNĐ </span></div>
                                        @endif
                                      
                                    </div>
                                </div>
                            </div>
                                        
                            @endforeach
                           
                            
                          
                        </div>
                    </div>
                </div>

                <div class="filter__item">
                    <div class="row">
                        <div class="col-lg-4 col-md-5">
                            <div class="filter__sort">
                                <span>Sort By</span>
                                <select>
                                    <option value="0">Default</option>
                                    <option value="0">Default</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <div class="filter__found">
                                <h6><span>{{ $coutCake }}</span>Sản phẩm của shop</h6>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-3">
                            <div class="filter__option">
                                <span class="icon_grid-2x2"></span>
                                <span class="icon_ul"></span>
                            </div>
                        </div>
                    </div>
                </div>          
                <div class="row">
                    @foreach ($indexCake as $itemCake)
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="product__item">
                            <div class="product__item__pic set-bg" data-setbg="{{ asset('upload/imgCake/'.$itemCake->hinhanh) }}">
                                <ul class="product__item__pic__hover">
                                    <li><a href="{{route('home.details',['id'=>$itemCake->mabanh])}}"><i class="iconCake fa fa-eye"></i></a></li>
                                </ul>
                            </div>
                            <div class="product__item__text">
                                <h6 class="nameCake"><a href="{{route('home.details',['id'=>$itemCake->mabanh])}}">{{ $itemCake->tenbanh }}</a></h6>
                                @if ($itemCake->giabanh == 0)
                                <h5 class="product__item__price"> <p class="badge badge-pill badge-success">bánh có nhiều size</p> </h5>
                                @else
                                <h5>{{ number_format($itemCake->giabanh) }} VNĐ</h5>
                                @endif
                              
                            </div>
                        </div>
                    </div> 
                    @endforeach
                    

                </div>
                
                 
                    {{$indexCake->links("pagination::bootstrap-4")}}
                
            
                    
               
            </div>
        </div>
    </div>
</section>
@endsection
@push('js')
<script>
    document.querySelector(".shop").classList.add('active');
    document.querySelector(".hero").classList.add("hero-normal");
</script>
@endpush