// AJAX function in your JavaScript file
function edittaikhoan(id) {  
    console.log('suatk dang goi id tai khoan:', id);
    var url_edit = 'edit-tk/' + id;
    $.ajax({
        url: url_edit,
        method: 'GET',
        beforeSend: function () {
            Swal.fire({
                title: 'Đang tải...',
                html: 'Vui lòng chờ đợi...',
                allowEscapeKey: false,
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading()
                }
            });
        },
        success: function (data) {              
            console.log(data);   
            // console.log(data.taikhoan.name);
            $('#tenne').val(data.taikhoan.name);
            $('#email').val(data.taikhoan.email);
            $('select[name="maquyen"]').val(data.taikhoan.maquyen);
            $('#form-edit').attr("action",data.url);
            Swal.close();             
        }
    });
}

//


  