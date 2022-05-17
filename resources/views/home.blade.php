@extends('master_layout.layout_trangchu')
@push('css')
<link rel="stylesheet" href="{{ asset('custom/css/home.css') }}">
@endpush
@section('img_sidebar')
<div class="hero__item set-bg" data-setbg="{{ asset('asset/img/hero/banner.jpg') }}">
   
</div>
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
@endpush


