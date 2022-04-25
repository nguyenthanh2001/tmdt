<div class="modal fade" id="suasize">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Sửa size</h4>
                <button type="button" class="close" data-dismiss="modal"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form method="POST" enctype="multipart/form-data" id="formEditSize">
                @csrf
                <div class="form-group">
                    <label for="exampleFormControlTextarea1" class="font-weight-bold">Tên size</label>
                    <input type="number" class="form-control" id="tensize" placeholder="Size Bánh" name="tensize" required>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1" class="font-weight-bold">Tên bánh</label>
                    <input type="text" class="form-control tags" id="tenbanh" placeholder="Thêm tên bánh" name="tenbanh" required>
                    <input type="hidden" class="form-control mabanh editsize" id="mabanh" name="mabanh" >
                </div>       
                <div class="form-group">
                    <label for="exampleFormControlTextarea1" class="font-weight-bold">Giá size</label>
                    <div class="input-group mb-3">                
                        <div class="input-group-prepend">
                          <span class="input-group-text">VNĐ</span>
                        </div>
                        <input type="number" id="gia" class="form-control" aria-label="Amount (to the nearest dollar)" placeholder="Giá size" name="gia" required>               
                    </div>
                </div>             
                    <div class="form-group ">
                        <button type="submit" name="submit" id="btnEditSize" value=""
                            class="btn btn-success">Sửa</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>