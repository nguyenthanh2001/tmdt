$(document).ready(function () {
    $('#dangky').on('submit', function (event) {
      event.preventDefault();
      $.ajax({
         url : "dang-ky",
        method: 'POST',
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        success: function (data2) {
          toastr.success('Đăng ký thành công', 'Thông báo')
        },
        error: function (data2) { 
         console.log(data2); 
         let mess =data2.responseJSON.errors
         console.log(mess);  
         $('.er').text("");
         for (const key in mess) {
             console.log(mess[key]);
             $('.er_'+key).text(mess[key][0]);
         }

         }
        
      });
  
    });
  });