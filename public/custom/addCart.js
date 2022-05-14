$(document).ready(function() {
    $('#addCart').on('submit', function (event) {
        event.preventDefault();
        $.ajax({
            url : urlAddCart,
            method: 'POST',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {            
              if (data.data) {
                toastr.success('Đã thêm vào giỏ hàng', 'Thông báo');
              }else{
                toastr.error('Vui lòng đăng nhập', "Thông báo")   
              }
           
            },
             error: function (data_er) { 
                if (data_er.status >= 500) {
                    location.reload();
                  }
                  console.log(data_er);
                  toastr.warning(data_er.responseJSON.message, "Thông báo")        
             }

        });  
    });   
});