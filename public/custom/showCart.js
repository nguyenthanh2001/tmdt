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
    
});