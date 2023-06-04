@extends('master_layout.layout_trangchu')
@push('css')
<link rel="stylesheet" href="{{ asset('custom/css/home.css') }}">
<style>
    .hero__item {
        display: none;
    }
</style>
@endpush
@section('img_sidebar')
<div class="hero__item set-bg" data-setbg="{{ asset('asset/img/hero/banner1.jpg') }}"></div>
<div class="hero__item set-bg" data-setbg="{{ asset('asset/img/hero/banner2.jpg') }}"></div>
<div class="hero__item set-bg" data-setbg="{{ asset('asset/img/hero/banner3.jpg') }}"></div>
@endsection
@section('main')
@include('main.main_trangchu')
@endsection
@push('js')
<script>
    document.querySelector(".home").classList.add('active');
</script>
@if (session('mess'))
   <script>
        toastr.error("{{session('mess')}}","Thông báo !") 
   </script>
@endif
<script>
    let heroItems = document.querySelectorAll('.hero__item');
    let currentHeroItemIndex = 0;
    heroItems[currentHeroItemIndex].style.display = 'block';

    setInterval(() => {
        heroItems[currentHeroItemIndex].style.display = 'none';
        currentHeroItemIndex = (currentHeroItemIndex + 1) % heroItems.length;
        heroItems[currentHeroItemIndex].style.display = 'block';
    }, 1500); // Thay đổi ảnh sau mỗi 3 giây
</script>
@endpush



