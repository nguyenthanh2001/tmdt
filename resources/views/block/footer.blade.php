   <!-- Footer Section Begin -->
    <!-- cuoi -->
    <footer class="footer spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer__about">
                        <div class="footer__about__logo">
                            <a href="./index.html"><img src="{{ asset('asset/img/logo.png') }}" alt=""></a>
                        </div>
                        <ul>
                            <li>Address: 60-49 Road 11378 New York</li>
                            <li>Phone: +65 11.188.888</li>
                            <li>Email: hello@colorlib.com</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 offset-lg-1">
                    <div class="footer__widget">
                        <h6>Useful Links</h6>
                        <ul>
                            <li><a href="#">About Us</a></li>
                            <li><a href="#">About Our Shop</a></li>
                            <li><a href="#">Secure Shopping</a></li>
                            <li><a href="#">Delivery infomation</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                            <li><a href="#">Our Sitemap</a></li>
                        </ul>
                        <ul>
                            <li><a href="#">Who We Are</a></li>
                            <li><a href="#">Our Services</a></li>
                            <li><a href="#">Projects</a></li>
                            <li><a href="#">Contact</a></li>
                            <li><a href="#">Innovation</a></li>
                            <li><a href="#">Testimonials</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="footer__widget">
                        <h6>Join Our Newsletter Now</h6>
                        <p>Get E-mail updates about our latest shop and special offers.</p>
                        <form action="#">
                            <input type="text" placeholder="Enter your mail">
                            <button type="submit" class="site-btn">Subscribe</button>
                        </form>
                        <div class="footer__widget__social">
                            <a href="#"><i class="fa fa-facebook iconPhone"></i></a>
                            <a href="#"><i class="fa fa-instagram iconPhone"></i></a>
                            <a href="#"><i class="fa fa-twitter iconPhone"></i></a>
                            <a href="#"><i class="fa fa-pinterest iconPhone"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="footer__copyright">
                        <div class="footer__copyright__text"><p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
  Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
  <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p></div>
                        <div class="footer__copyright__payment"><img src="{{ asset('asset/img/payment-item.png') }}" alt=""></div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

@if (Auth::check())
<div class="modal" id="infouser">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Hồ sơ</h4>
                <button type="button" class="close" data-dismiss="modal"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('home.infoUser') }}" enctype="multipart/form-data">
                @csrf
                <div class="container rounded bg-white mt-5 mb-5">
                    <div class="row">
                        <div class="col-md-3 border-right">
                            <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5" width="150px" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcThLP6xJXBY_W2tT5waakogfnpHk4uhpVTy7A&usqp=CAU"><span class="font-weight-bold">{{ Auth::user()->name }}</span><span class="text-black-50">{{ Auth::user()->email }}</span><span> </span></div>
                        </div>
                        <div class="col-md-9 border-right">
                            <div class="p-3 py-5">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h4 class="text-right">Hồ sở thông tin của {{ Auth::user()->name }}</h4>
                                </div>                           
                                <div class="row mt-1">
                                    <div class="col-md-12"><label class="labels">Tên người dùng</label><input type="text" class="form-control" placeholder="Nhập người dùng" name="name" value="{{ Auth::user()->name }}" required></div>
                                    <div class="col-md-12"><label class="labels">Địa chỉ</label><input type="text" class="form-control" placeholder="Địa chỉ" name="diachi" value="{{$info->diachi}}" required></div>
                                    <div class="col-md-12"><label class="labels">Nởi ở</label><input type="text" class="form-control diachi" placeholder="Nơi ở" value="{{$info->Diachi->name}} - {{$info->Diachi->huyen->name}} - {{$info->Diachi->huyen->thanhpho->name}}"></div>
                                    <input type="hidden" class="xaid" name="xaid" value="{{$info->xaid }}">
                                    <div class="col-md-12"><label class="labels">Số điện thoại</label><input type="text" class="form-control" placeholder="Số điện thoại" value="{{$info->sdt}}" readonly></div>
                                    <div class="col-md-12"><label class="labels">Email</label><input type="text" class="form-control" placeholder="email" value="{{$info->email}}" readonly></div>
                      
                                <div class="mt-5 text-center"><button class="btn btn-primary profile-button" type="submit">Lưu</button></div>
                            </div>
                        </div>
                        
                    </div>
                </div>
                
                </form>
            </div>
        </div>
    </div>
</div>
@endif