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

function size_banh(number) {
    var html = `
    <div class="form-group">
    <label for="exampleFormControlTextarea1" class="font-weight-bold">Size Bánh Thứ ${number+1}</label>
    <input type="number" class="form-control" placeholder="Nhập Size" name="tensize[]" required>
    </div>
    <div class="form-group">
    <label for="exampleFormControlTextarea1" class="font-weight-bold">Gía Bánh Size Thứ ${number+1}</label>
    <input type="number" class="form-control" placeholder="Giá" name="gia[]" required>
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
                var html="";
                var size_select = this.value;
                for (var index = 0; index < size_select; index++) {
                    html += size_banh(index);                                      
                }            
                html +='<hr style="height:1px;border:none;color:#333;background-color:#333;" />';
                $("#size_div_2").html(html)
         });      
        } else {
            console.log('khong');
            $("#size_div").empty();
        }
    });
});