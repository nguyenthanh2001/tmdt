@extends('master_layout.admin.layout_admin')
@push('css')

@endpush
<!-- Begin Page Content -->
@section('main_admin')
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Top 5 user</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between">
            <div class="m-0 font-weight-bold text-primary">
                Tài Khoản
             </div>         
        </div>
        <div class="card-body" >
            <div class="table-responsive ">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>                
                            <th>STT</th>
                            <th>Tên Người Dùng</th>
                            <th>Số lần quay lại</th>                                 
                            <th>Gửi Email</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>STT</th>
                            <th>Tên Người Dùng</th>
                            <th>Số lần quay lại</th>                      
                            <th>Gửi Email</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($Account as $Account)
                        <tr>                               
                            <td>{{($loop->index)+1}}</td>
                            <td>{{ $Account->name }}</td>
                            <td>{{ $Account->khachquaylai }}</td>                                                                
                            <td>
                            <a href="{{ route('admin.email',['id'=>$Account->users_id]) }}" class="btn btn-info btn-circle btn-sm">
                                <i class="fa fa-envelope" aria-hidden="true"></i>
                            </a>
                            </td>
                        </tr>  
                        @endforeach
                                          
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
@push('js')
@endpush