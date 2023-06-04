<div class="modal fade" id="themsize">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Thêm size</h4>
                <button type="button" class="close" data-dismiss="modal"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form method="POST" enctype="multipart/form-data" id="formAddSize">
                @csrf
                <div class="form-group">
                    <label for="exampleFormControlTextarea1" class="font-weight-bold">Tên size</label>
                    <input type="number" class="form-control" placeholder="Size hải sản" name="tensize" required>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1" class="font-weight-bold">Tên hải sản</label>
                    <input type="text" class="form-control tags" placeholder="Thêm tên hải sản" name="tenbanh" required>
                    <input type="hidden" class="form-control mabanh addSize" name="mabanh" >
                </div>       
                <div class="form-group">
                    <label for="exampleFormControlTextarea1" class="font-weight-bold">Giá size</label>
                    <div class="input-group mb-3">                
                        <div class="input-group-prepend">
                          <span class="input-group-text">VNĐ</span>
                        </div>
                        <input type="number" class="form-control" aria-label="Amount (to the nearest dollar)" placeholder="Giá size" name="gia" required>
                        <div class="input-group-append">
                          <span class="input-group-text">.000</span>
                        </div>
                    </div>
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

