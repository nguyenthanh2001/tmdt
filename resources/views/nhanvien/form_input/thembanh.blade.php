<div class="modal fade" id="thembanh">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Thêm Hải sản</h4>
                <button type="button" class="close" data-dismiss="modal"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form method="POST" enctype="multipart/form-data" id="formAddCake">
                @csrf
                <div class="form-group">
                    <label for="exampleFormControlTextarea1" class="font-weight-bold">Tên Hải sản</label>
                    <input type="text" class="form-control" placeholder="Nhập tên hải sản" name="tenbanh" required>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1" class="font-weight-bold">Số lượng</label>
                    <input type="number" class="form-control" placeholder="Thêm số lượng" name="soluong" required>
                </div>      

                <div class="form-group">
                    <label for="exampleFormControlFile1" class="font-weight-bold">Thêm hình ảnh hải sản</label>
                    <input type="file" accept=".png, .jpg, .jpeg" class="form-control-file" id="idAnh" name="hinhanh" required>
                    <img id="duongdan" src="" alt="" class="img-rounded">
                </div>

                <div class="form-group">
                    <label for="exampleFormControlFile1" class="font-weight-bold">Thêm ảnh chỉ tiết</label>
                    <input type="file" accept=".png, .jpg, .jpeg" id="file-input" onchange="preview()" class="form-control-file" name="hinhanhct[]" multiple required>
                    <div id="images" class="imgAddEdit"></div>
                </div>

                <div class="form-group">
                    <label class="font-weight-bold" for="flexCheckIndeterminate">Size Hải sản</label>
                    <input type="checkbox" id="size" data-toggle="toggle" data-size="sm" data-onstyle="outline-primary"
                        data-offstyle="outline-secondary" name="sizebanh">
                </div>
                
                <div class="form-group" id="size_div">
                    <label for="exampleFormControlTextarea1" class="font-weight-bold">Giá Hải sản</label>
                    <div class="input-group mb-3">                
                        <div class="input-group-prepend">
                          <span class="input-group-text">VNĐ</span>
                        </div>
                        <input type="number" class="form-control" aria-label="Amount (to the nearest dollar)" placeholder="Nhập giá hải sản" name="giabanh" required>
                        <div class="input-group-append">
                          <span class="input-group-text">.000</span>
                        </div>
                    </div>
    
                </div>

                <div class="form-group">
                    <label for="exampleFormControlTextarea1" class="font-weight-bold">Mã khuyến mãi</label>
                    <select class="custom-select mr-sm-2" aria-label=".form-select-lg example" name="makm" required>
                        <option value="" disabled selected >Chọn mã khuyến mãi</option>
                        <option value="0">Không Khuyến Mãi</option>
                        @foreach ($khuyenmai as $khuyenmai) 
                        <option value="{{$khuyenmai->makm  }}">{{ $khuyenmai->tenkm }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1" class="font-weight-bold">Mã loại</label>
                        <select class="custom-select mr-sm-2" aria-label=".form-select-lg example" name="maloai" required>
                            <option value="" selected disabled>Chọn mã loại</option>
                            @foreach ($loaibanh as $loaibanh) 
                            <option value="{{ $loaibanh->maloai }}">{{ $loaibanh->tenloai }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1" class="font-weight-bold">Mô tả</label>
                        <textarea type="text" id="editor" class="form-control" placeholder="Nhập mô tả" name="mota" required></textarea>
                    </div>
                    <div class="form-group ">
                        <button type="submit" name="submit" value="Gửi" id="btn_them"
                            class="btn btn-success">Thêm</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
