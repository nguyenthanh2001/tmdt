<div class="modal fade" id="suabanh">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Sửa Hải sản</h4>
                <button type="button" class="close" data-dismiss="modal"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form  enctype="multipart/form-data" method="POST" id="formEditCake">
                @csrf
                <div class="form-group">
                    <label for="exampleFormControlTextarea1" class="font-weight-bold">Tên Hải sản</label>
                    <input type="text" class="form-control" placeholder="Thêm tên hải sản" name="tenbanh" id="editName" required>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1" class="font-weight-bold">Số lượng</label>
                    <input type="number" class="form-control" placeholder="Thêm số lượng" name="soluong" id="editQuantity" required>
                </div>      

                <div class="form-group">
                    <label for="exampleFormControlFile1" class="font-weight-bold">Thêm hình ảnh Hải sản</label>
                    <input type="file" accept=".png, .jpg, .jpeg" class="form-control-file" id="idAnhEdit" name="hinhanh">
                    <img id="duongdanEdit" src="" alt="" class="img-rounded imgCake">
                </div>

                <div class="form-group">
                    <label for="exampleFormControlFile1" class="font-weight-bold">Thêm ảnh chỉ tiết</label>
                    <input  type="file" onchange="previewEdit()" accept=".png, .jpg, .jpeg" class="form-control-file" id="file-input-Edit" name="hinhanhct[]" multiple >
                    <div id="imagesNew" class="imgAddEdit"></div>
                    <div id="images-edit" class="imgAddEdit"></div>          
                </div>      
                         
                <div class="form-group" id="editPrice">            
                </div>

                <div class="form-group">
                    <label for="exampleFormControlTextarea1" class="font-weight-bold">Mã khuyến mãi</label>
                    <select id="promotion" class="custom-select mr-sm-2" aria-label=".form-select-lg example" name="makm" required>
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
                        <select id="categoryEdit" class="custom-select mr-sm-2" aria-label=".form-select-lg example" name="maloai" required>
                            <option value="" selected disabled>Chọn mã loại</option>
                            @foreach ($loaibanh as $loaibanh) 
                            <option value="{{ $loaibanh->maloai }}">{{ $loaibanh->tenloai }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1" class="font-weight-bold">Mô tả</label>
                        <textarea type="text" id="editor1" class="form-control" placeholder="Nhập mô tả" name="mota" required></textarea>
                    </div>
                    <div class="form-group ">
                        <button type="submit" name="submit" value="Gửi" 
                            class="btn btn-success" id="btnEditCakeForm">Sửa</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
