<div class="modal fade" id="thembanh">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Thêm bánh</h4>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                @csrf
                <div class="form-group">
                    <label for="exampleFormControlTextarea1" class="font-weight-bold">Tên bánh</label>
                    <input type="text" class="form-control" placeholder="Thêm tên bánh" name="tenbanh" required>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1" class="font-weight-bold">Số lượng</label>
                    <input type="number" class="form-control" placeholder="Thêm số lượng" name="soluong" required>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlFile1" class="font-weight-bold">Thêm hình ảnh bánh</label>
                    <input type="file" class="form-control-file" id="idAnh" name="hinhanh" required>
                    <img id="duongdan" src="" alt="" class="img-rounded">
                </div>                  
                <div class="form-group">
                    <label for="exampleFormControlTextarea1" class="font-weight-bold">Giá bánh</label>
                    <input type="number" class="form-control" placeholder="Nhập giá bánh" name="giabanh" required>
                </div>
                <div class="form-group">
                    <label class="font-weight-bold" for="flexCheckIndeterminate">Size Bánh</label>
                    <input type="checkbox" id="size" data-toggle="toggle"  data-size="sm"  data-onstyle="outline-primary" data-offstyle="outline-secondary">
                </div>
                <div class="form-group" id="size_div">
                 </div>

                <div class="form-group">
                    <label for="exampleFormControlTextarea1" class="font-weight-bold">Mã khuyến mãi</label>
                    <select class="custom-select mr-sm-2" aria-label=".form-select-lg example" name="makm">
                        <option selected>Chọn mã khuyến mãi</option>
                        <option value="1">10%</option>
                        <option value="2">20%</option>
                        <option value="3">30%</option>
                    </select>
                </div>
                <div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1" class="font-weight-bold">Mã loại</label>
                        <select class="custom-select mr-sm-2" aria-label=".form-select-lg example" name="maloai">
                            <option selected>Chọn mã loại</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1" class="font-weight-bold">Mô tả</label>
                        <textarea type="text" id="editor"  class="form-control" placeholder="Nhập mô tả" name="mota" required></textarea>
                    </div>

                    <div class="form-group ">
                        <button type="submit " name="submit" value="Gửi" id="btn_them" class="btn btn-success">Thêm</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>  