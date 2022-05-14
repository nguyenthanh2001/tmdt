@extends('master_layout.admin.layout_admin')
@push('css')
    <link href=" {{ asset('admin/hashtag/tagsinput.css') }}" rel="stylesheet">
    <link href=" {{ asset('custom/css/formAddCake.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
@endpush
<!-- Begin Page Content -->
@section('main_admin')
   
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    <thead>
        <tr>
            <th>STT</th>
            <th>Tên Tên Bánh</th>   
            <th>STT</th>
            <th>Tên Tên Bánh</th>  
            <th>STT</th>
            <th>Tên Tên Bánh</th>  
            <th>STT</th>
            <th>Tên Tên Bánh</th>     
            <th>STT</th>
            <th>Tên Tên Bánh</th>  
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th>STT</th>
            <th>Tên Tên Bánh</th>  
            <th>STT</th>
            <th>Tên Tên Bánh</th>  
            <th>STT</th>
            <th>Tên Tên Bánh</th>  
            <th>STT</th>
            <th>Tên Tên Bánh</th>  
            <th>STT</th>
            <th>Tên Tên Bánh</th>  
        </tr>
    </tfoot>
    <tbody>
      <tr>
          <td>a</td>
          <td>a</td>
          <td>a</td>
          <td>a</td>
          <td>a</td>
          <td>a</td>
          <td>a</td>
          <td>a</td>
          <td>a</td>
          <td>a</td>
      </tr>
    </tbody>

</table>

@endsection
@push('js')
    <script src="{{ asset('custom/admin/test.js') }}"></script>

@endpush
