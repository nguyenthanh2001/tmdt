@extends('master_layout.admin.login')
@section('dangnhap_dangky')
<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-xl-10 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Chào mừng bạn đã quay lại</h1>
                                </div>
                                <form class="user" id="dangnhap" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <input type="email" class="form-control form-control-user"
                                            placeholder="Nhập Email" name="email" required>
                                        <span style="color: red" class="er er_email"></span>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user"
                                            placeholder="Password" name="matkhau" required>
                                            <span style="color: red" class="er er_matkhau"></span>
                                    </div>
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox small">
                                            <input type="checkbox" name="remember" class="custom-control-input" id="customCheck">
                                            <label class="custom-control-label" for="customCheck">Remember
                                                Me</label>
                                        </div>
                                    </div>
                                    <input type="submit" class="btn btn-primary btn-user btn-block" value="Đăng nhập">                             
                                </form>
                                <hr>                             
                                <div class="text-center">
                                    <a class="small" href="{{ route('home.dangky') }}">Đăng ký</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>
@endsection

@push('js')
<script src="{{ asset('custom/dangnhap.js') }}"></script>
@endpush