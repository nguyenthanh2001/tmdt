var src = document.getElementById("idAnh");
var target = document.getElementById("duongdan");
showImage(src, target);
function showImage(idAnh, duongdan) {
    var fr = new FileReader();
    // when image is loaded, set the src of the image where you want to display it
    fr.onload = function (e) { duongdan.src = this.result; };
    idAnh.addEventListener("change", function () {
        // fill fr with image data    
        fr.readAsDataURL(idAnh.files[0]);
        duongdan.style.width = "70%";
        duongdan.style.height = "auto";
        duongdan.style.position = "relative";
        duongdan.style.margin = "auto";
        duongdan.style.display = "flex";
        duongdan.style.gap = "20px";
    });
}

var srcEdit = document.getElementById("idAnhEdit");
var targetEdit = document.getElementById("duongdanEdit");
showImageEdit(srcEdit, targetEdit);
function showImageEdit(idAnh, duongdan) {
    var fr = new FileReader();
    // when image is loaded, set the src of the image where you want to display it
    fr.onload = function (e) { duongdan.src = this.result; };
    idAnh.addEventListener("change", function () {
        // fill fr with image data    
        fr.readAsDataURL(idAnh.files[0]);
        duongdan.style.width = "70%";
        duongdan.style.height = "auto";
        duongdan.style.position = "relative";
        duongdan.style.margin = "auto";
        duongdan.style.display = "flex";
        duongdan.style.gap = "20px";
    });
}

function preview() {
    //vào css lại
    let fileInput = document.getElementById("file-input");
    let imageContainer = document.getElementById("images");
    imageContainer.innerHTML = "";
    for (i of fileInput.files) {
      let reader = new FileReader();
      let figure = document.createElement("figure");
      let figCap = document.createElement("figcaption");
      figCap.innerText = i.name;
      figure.appendChild(figCap);
      reader.onload = () => {
        let img = document.createElement("img");
        img.setAttribute("src", reader.result);
        figure.insertBefore(img, figCap);
      }
      imageContainer.appendChild(figure);
      reader.readAsDataURL(i);
    }

  }


function size_banh(number) {
    var html = `
    <div class="form-group">
    <label for="exampleFormControlTextarea1" class="font-weight-bold">Size Bánh Thứ ${number + 1}</label>
    <input type="number" class="form-control" placeholder="Nhập Size" name="tensize[]" required>
    </div>
    <label for="exampleFormControlTextarea1" class="font-weight-bold">Gía Bánh Size Thứ ${number + 1} </label>
                <div class="input-group mb-3">                
                    <div class="input-group-prepend">
                      <span class="input-group-text">VNĐ</span>
                    </div>
                    <input type="number" class="form-control" aria-label="Amount (to the nearest dollar)" placeholder="Nhập giá bánh" name="gia[]" required>
                    <div class="input-group-append">
                      <span class="input-group-text">.000</span>
                    </div>
                </div>
    `
    return html;
}

$(document).ready(function () {
    var html_size = `
    <label for="exampleFormControlTextarea1" class="font-weight-bold">Chọn số lượng size</label>
    <select class="custom-select mr-sm-2" id="size_select" aria-label=".form-select-lg example" name="chonsize" required>
        <option selected disabled>Bánh có bao nhiêu size</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
    </select>
    <div class="form-group" id="size_div_2">
    </div>
    `
    $("#size").change(function () {
        if (this.checked) {
            $("#size_div").html(html_size)
            $("#size_select").change(function () {
                var html = "";
                var size_select = this.value;
                for (var index = 0; index < size_select; index++) {
                    html += size_banh(index);
                }
                html += '<hr style="height:1px;border:none;color:#333;background-color:#333;" />';
                $("#size_div_2").html(html)
            });
        } else {
            var htmlPrice = `      
            <label for="exampleFormControlTextarea1" class="font-weight-bold">Giá bánh</label>
            <div class="input-group mb-3">                
                <div class="input-group-prepend">
                  <span class="input-group-text">VNĐ</span>
                </div>
                <input type="number" class="form-control" aria-label="Amount (to the nearest dollar)" placeholder="Nhập giá bánh" name="giabanh" required>
                <div class="input-group-append">
                  <span class="input-group-text">.000</span>
                </div>
            </div>
`
            $("#size_div").html(htmlPrice);
        }
    });
});

function loaddata() {
    $('#dataTable').DataTable({
        destroy: true,
        searching: true,
        processing: true,
        language: {
            "sProcessing": "Đang xử lý...",
            "sLengthMenu": "Xem thông tin _MENU_ mục",
            "sZeroRecords": "Không tìm thấy dòng nào phù hợp",
            "sInfo": "Đang xem _START_ đến _END_ trong tổng số _TOTAL_ mục",
            "sInfoEmpty": "Đang xem 0 đến 0 trong tổng số 0 mục",
            "sInfoFiltered": "(được lọc từ _MAX_ mục)",
            "sInfoPostFix": "",
            "sSearch": "Tìm thông tin:",
            "sUrl": "",
            "oPaginate": {
                "sFirst": "Đầu",
                "sPrevious": "Trước",
                "sNext": "Tiếp",
                "sLast": "Cuối"
            }
        },
        ajax: {
            "url": "banh",
            "type": "GET"
        },
        columns: [
            { data: 'stt' },
            { data: 'tenbanh' },
            { data: 'hinhanh', "width": "20%" } ,
            { data: 'soluong' },
            { data: 'mota' },
            { data: 'giabanh' },
            { data: 'loaibanh' },
            { data: 'khuyenmai' },
            { data: 'btn-sua' },
            { data: 'btn-xoa' },
        ]
    });
}

function editCake(id) {
    var url_edit='editCake/'+id;
    $.ajax({
      url : url_edit,
      method: 'GET',
      contentType: false,
      cache: false,
      processData: false,
      beforeSend: function () {
        Swal.fire({
          title: 'Đảng tải...',
          html: 'Vui lòng chờ đợi...',
          allowEscapeKey: false,
          allowOutsideClick: false,
          didOpen: () => {
            Swal.showLoading()
          }
        });
      },
      success: function (data2) {  
          console.log(data2);         
        //   $('#tenkm').val(data2.datakm.tenkm);
        //   $('#giatri').val(data2.datakm.giatri);
        //   $("#btn-edit-from").attr('value', data2.datakm.makm);  
          swal.close();             
      }
    });
}

$(document).ready(function () {
    //loaddata();
    $('#formAddCake').on('submit', function (event) {
        event.preventDefault();
        for ( instance in CKEDITOR.instances ) {
            CKEDITOR.instances[instance].updateElement();
        }
        $.ajax({
            url: "addCake",
            method: 'POST',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data2) {
                console.log(data2);
                var trangthai = data2.status;
                if (trangthai == true) {
                    toastr.success('Thêm Bánh thành công', 'Thông báo');
                    loaddata();
                }
                else {
                    toastr.error(data2.dataErro, "Thông báo")
                    setTimeout(function () {
                        location.reload();
                    }, 1000);
                }
            },
            error: function (data2) {
                console.log(data2);
                toastr.warning(data2.responseJSON.message, "Thông báo")
            }

        });
    });
});


