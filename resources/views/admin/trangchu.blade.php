@extends('master_layout.admin.layout_admin')
@push('css')
<link href=" {{ asset('admin/hashtag/tagsinput.css') }}" rel="stylesheet">
@endpush
<!-- Begin Page Content -->
@section('main_admin')

<input type="text" value="" data-role="tagsinput" >
<button type="button" class="btn btn-primary">Primary</button>

@endsection
@push('js')
<script src="{{ asset('custom/admin/qlbanh.js') }}"></script>
<script src="{{ asset('admin/hashtag/tagsinput.js') }}"></script>
@endpush