 <!-- Categories Section Begin -->
 <section class="categories product spad">
    <div class="container">
        <div class="row">
            <div class="section-title">
                <h3>Sản Phẩm Mới Nhất</h3>
            </div>
            <div class="categories__slider owl-carousel">
                @foreach ($banh as $item)
           
                <div class="col-lg-3">
                    <div class="categories__item set-bg" data-setbg="{{asset('upload/imgCake/'.$item->hinhanh)  }}">
                        <h5 class="text"><a style="background-color: #FAFDD6"  href="#">{{Str::limit($item->tenbanh, 15) }}</a></h5>
                    </div>
                </div>
                @endforeach             
            </div>
        </div>
    </div>
</section>


