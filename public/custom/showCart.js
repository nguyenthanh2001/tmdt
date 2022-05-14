$(document).ready(function() {
    $( ".quantityCart" ).change(function() {
        var max = parseInt($(this).attr('max'));
        var min = parseInt($(this).attr('min'));
        if ($(this).val() > max)
        {
            $(this).val(max);
        }
        else if ($(this).val() < min)
        {
            $(this).val(min);
        }       
      }); 
});

$(document).ready(function() {
    $('#updatecart').on('submit', function (event) {
        event.preventDefault();
        $.ajax({
            url : urlUpdate,
            method: 'POST',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data2) {            
              console.log(data2);
           
            },
             error: function (data2) { 
                 console.log(data2);
               
             }

        });  
    });

//     $( ".DeleteItem" ).click(function() {
//         var item = this.data('item');
//         console.log(item);
// });
});
function DeleteItem(info) {
    if($(info).is('[data-size]')){
        var size = $(info).data("size");
    }
    var item = $(info).data("item");
    $.ajax({
        url : urlDelete,
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          data: {
            "mabanh": item,
            "masize":size
          },
        success: function (data) {            
          console.log(data);
       
        },
         error: function (data_er) { 
            // if (data_er.status >= 500) {
            //     location.reload();
            //   }
              console.log(data_er);
              toastr.warning(data_er.responseJSON.message, "Thông báo")        
         }

    }); 
    }

    
