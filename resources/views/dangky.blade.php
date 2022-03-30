@extends('master_layout.admin.login')
@section('dangnhap_dangky')
<style>
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}
</style>

<div class="container">
    
    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                <div class="col-lg-7">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Tạo Tài Khoản</h1>
                        </div>
                        <form class="user" id="dangky"  method="POST">
                            @csrf
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" 
                                    placeholder="Nhập Họ Tên" name="hoten" required>
                                    <span style="color: red" class="er er_hoten"></span>
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control form-control-user" 
                                    placeholder="Tài Khoản Email" name="email" required>
                                    <span style="color: red" class="er er_email"></span >
                            </div>     
                            <div class="form-group">
                                <input type="password" class="form-control form-control-user" 
                                    placeholder="Nhập Mật Khẩu" name="matkhau" required>
                                    <span style="color: red" class="er er_matkhau"></span>
                            </div>

                            <div class="form-check form-check-inline form-group">
                                <input class="form-check-input" type="radio" name="gioitinh" value="0" checked>
                                <label class="form-check-label" for="inlineRadio1">Nam</label>
                            </div>

                            <div class="form-check form-check-inline form-group">
                                <input class="form-check-input" type="radio" name="gioitinh" value="1">
                                <label class="form-check-label" for="inlineRadio2">Nữ</label>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="date" class="form-control form-control-user" name="ngaysinh" min="1990-01-01" 
                                    max="{{ date('Y-m-d')}}"
                                    placeholder="Nhập Ngày Sinh" required>
                                <span style="color: red" class="er er_ngaysinh"></span>
                                </div>
                                <div class="col-sm-6">
                                    <input type="number" class="form-control form-control-user" 
                                        placeholder="Số Điện Thoại" name="sdt" max="9999999999" min="0" required>
                                        <span style="color: red" class="er er_sdt"></span>
                                </div>                             
                            </div>                       
                     
                            
                            <div class="form-group">
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Địa Chỉ" name="diachi" required></textarea>
                                    <span style="color: red" class="er er_diachi"></span>
                            </div>  
                            <input type="submit" class="btn btn-primary btn-user btn-block" value="Đăng ký">                        
                        </form>
                        <hr>
                        <div class="text-center">
                            <a class="small" href="{{ route('home.dangnhap') }}">Đăng Nhập</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
@push('js')
<script src="{{ asset('custom/dangky.js') }}"></script>
@endpush