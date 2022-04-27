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
          console.log(data2);
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

  $(function () {
    $(".diachi").autocomplete({
      source: function (request, response) {
      
        $.ajax({
          url: "test",
          method: 'Post',
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          data: {
            "tp": request.term
          },
          success: function (data) {  
            console.log(data);       
            response($.map(data.dataName, function (item) {
              return {
                label: item.name +' - '+ item.huyen.name + ' - ' + item.huyen.thanhpho.name,
                value: item.xaid
              }
            }));
          },       
        });
      },
      minLength: 4,
      select: function (event, ui) {
        $(".diachi").val(ui.item.label);
        $(".xaid").val(ui.item.value);
        return false;
      },
      open: function () {
        $(this).removeClass("ui-corner-all").addClass("ui-corner-top");
      },
      close: function () {
        $(this).removeClass("ui-corner-top").addClass("ui-corner-all");
      }
    });
  });