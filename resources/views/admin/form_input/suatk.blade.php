<div class="modal fade" id="edittaikhoan">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" >
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Sửa tài khoản</h4>
                <button type="button" class="close" data-dismiss="modal"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form method="POST" id="form-edit" action="">
                    @csrf
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1" class="font-weight-bold">Tên người dùng</label>
                        <input type="text" class="form-control" disabled placeholder="Tên người dùng" name="hoten" id="tenne" required>
                        <span style="color: red" class="er er_hoten"></span>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1" class="font-weight-bold">Email</label>
                        <input type="email" class="form-control tags" disabled placeholder="Email" name="email" id="email"
                            required>
                        <span style="color: red" class="er er_email"></span >
                    </div>
                    </div>
                    <div class="form-group">
                    <div class="form-group ">
                        <label for="exampleFormControlTextarea1" class="font-weight-bold">Phân quyền</label>
                        <select class="form-control" aria-label="Default select example" name="maquyen" required>
                            <!-- <option selected>Chọn quyền</option> -->
                            @foreach ($quyen as $quyen)
                            <option value="{{ $quyen->maquyen }}">{{ $quyen->tenquyen }}</option>
                            @endforeach
                          </select>
                          <span style="color: red" class="er er_maquyen"></span>
                    </div>
                    <div class="form-group ">
 
                    <button type="submit " name="submit" id="btn-edit-from" class="btn btn-success">Sửa</button>

                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

