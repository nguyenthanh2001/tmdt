$(document).ready(function () {
    $('#dangnhap').on('submit', function (event) {
        $('.er').text("");
      event.preventDefault();
      $.ajax({
         url : "dang-nhap",
        method: 'POST',
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        success: function (data2) {            
          console.log(data2);
          var trangthai=data2.status;
          if (trangthai == true) {
            toastr.success('Hệ Thống sẽ chuyển hướng', 'Hệ thông');
            toastr.success('Đăng nhập thành công', 'Thông báo');
            setTimeout(function(){
              window.location.replace(data2.link);
          }, 2000);

          }
          else{
            toastr.error("Sai thông tin đăng nhập vui lòng kiểm tra lại","Thông báo")
          }
        },
         error: function (data2) { 
         console.log(data2); 
         let mess =data2.responseJSON.errors
         console.log(mess);  
         for (const key in mess) {
             console.log(mess[key]);
             $('.er_'+key).text(mess[key][0]);
         }
         }
        
      });
  
    });
  });