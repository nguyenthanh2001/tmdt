
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