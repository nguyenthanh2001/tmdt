<div class="modal fade" id="themtk">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Thêm Tài Khoản</h4>
                <button type="button" class="close" data-dismiss="modal"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form method="POST" enctype="multipart/form-data" id="formaddtk">
                    @csrf
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1" class="font-weight-bold">Tên người dùng</label>
                        <input type="text" class="form-control" placeholder="Tên người dùng" name="hoten" required>
                        <span style="color: red" class="er er_hoten"></span>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1" class="font-weight-bold">Email</label>
                        <input type="email" class="form-control tags" placeholder="Email" name="email"
                            required>
                        <span style="color: red" class="er er_email"></span >
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1" class="font-weight-bold">Mật Khẩu</label>
                        <input type="password" class="form-control tags"  placeholder="mật khẩu"
                            name="matkhau" required>
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
                                max="{{ date('Y-m-d') }}" placeholder="Nhập Ngày Sinh" required>
                            <span style="color: red" class="er er_ngaysinh"></span>
                        </div>

                        <div class="col-sm-6">
                            <input type="number" class="form-control form-control-user" placeholder="Số Điện Thoại"
                                name="sdt" max="9999999999" min="0" required>
                            <span style="color: red" class="er er_sdt"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1" class="font-weight-bold">Xã - Huyện - Thành phố</label>
                        <input type="text" class="form-control diachi" placeholder="Xã - Huyện - Thành phố"
                            required>
                        <input type="hidden" class="form-control xaid" name="xaid" required>
                    </div>
                    <div class="form-group ">
                        <label for="exampleFormControlTextarea1" class="font-weight-bold">Địa chỉ</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Địa Chỉ" name="diachi"
                            required></textarea>
                        <span style="color: red" class="er er_diachi"></span>
                    </div>
                    <div class="form-group ">
                        <label for="exampleFormControlTextarea1" class="font-weight-bold">Phân quyền</label>
                        <select class="form-control" aria-label="Default select example" name="maquyen" required>
                            <option selected>Chọn quyền</option>
                            @foreach ($quyen as $quyen)
                            <option value="{{ $quyen->maquyen }}">{{ $quyen->tenquyen }}</option>
                            @endforeach
                          </select>
                          <span style="color: red" class="er er_maquyen"></span>
                    </div>

                    <div class="form-group ">
                        <button type="submit" name="submit" id="btnEditSize" value=""
                            class="btn btn-success">Thêm</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

