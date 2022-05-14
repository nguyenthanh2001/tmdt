
$(document).ready(function() {
 
    $(".btnPrice").first().addClass( "active" );   
    if ($(".btnPrice").first().is('[data-giagiam]')) {
        var Sale1 =  $(".btnPrice").first().data("giagiam");
        var giagoc1 =  $(".btnPrice").first().data("giagoc");
        var html1 = ` <del>${giagoc1} VND</del> <span class="ml-1">${Sale1} VND</span>`  
        $(".product__details__price").attr('data-giamgia',Sale1);  
        $(".product__details__price").attr('data-giagoc',giagoc1);  
        $(".product__details__price").attr('data-price',Sale1);        
        $(".product__details__price").html(html1) ;
    
    }
    else if ($(".btnPrice").first().is('[data-giagiam]') == false){
        var giagoc1 =  $(".btnPrice").first().data("giagoc");
        $(".product__details__price").attr('data-giagoc',giagoc1);  
        $(".product__details__price").attr('data-price',giagoc1); 
        $(".product__details__price").html(giagoc1) ;

    }
    else if($(".product__details__price").is('[data-giagiam]')){
        var Sale1 =  $(".product__details__price").data("giagiam");
        var giagoc1 =  $(".product__details__price").data("giagoc");
        var html1 = ` <del>${giagoc1} VND</del> <span class="ml-1">${Sale1} VND</span>`; 
        $(".product__details__price").attr('data-giamgia',Sale1);  
        $(".product__details__price").attr('data-giagoc',giagoc1); 
        $(".product__details__price").attr('data-price',Sale1); 
        $(".product__details__price").html(html1); 
     

    }
     
    //nhieu size
    $('.btnPrice').on('click', function (e) {
    $('.btn.btn-outline-primary.m-1.btnprice.active').removeClass('active');
    $(this).addClass( "active" );
    var masize = $(this).val();
    $("#masize").val(masize)
    if ($(this).is('[data-giagiam]')) {
        var Sale = $(this).data("giagiam");
        var giagoc = $(this).data("giagoc");
        var html = ` <del>${giagoc} VND</del> <span class="ml-1">${Sale} VND</span>`;
        $(".product__details__price").attr('data-giamgia',Sale);  
        $(".product__details__price").attr('data-giagoc',giagoc);
        $(".product__details__price").attr('data-price',Sale); 
        $(".product__details__price").html(html); 
 
     
    }
    else{
        var giagoc = $(this).data("giagoc");
        $(".product__details__price").attr('data-giagoc',giagoc); 
        $(".product__details__price").attr('data-price',giagoc); 
        $(".product__details__price").html(giagoc +' VND');
                          
    }
  
    
    });  
    $( "#test" ).click(function() {
        var  a = $(".product__details__price").data("price")
        console.log(a);
      });
});
