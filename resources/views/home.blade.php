@extends('master_layout.layout_trangchu')
@push('css')
<link rel="stylesheet" href="{{ asset('custom/css/home.css') }}">
@endpush
@section('img_sidebar')
<div class="hero__item set-bg" data-setbg="{{ asset('asset/img/hero/banner.jpg') }}">
    <div class="hero__text">
        <span>FRUIT FRESH</span>
        <h2>Vegetable <br />100% Organic</h2>
        <p>Free Pickup and Delivery Available</p>
        <a href="#" class="primary-btn">SHOP NOW</a>
    </div>
</div>
@endsection
@section('main')
@include('main.main_trangchu')
@endsection
@push('js')
@if (session('mess'))
   <script>
        toastr.error("{{session('mess')}}","Thông báo !") 
   </script>
@endif
@endpush


