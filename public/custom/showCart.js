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
              if(data2.data){
                toastr.success('Cập nhật thành công', 'Thông báo');
                loaddata();
                
              }
           
            },
             error: function (data2) { 
                 console.log(data2.responseJSON.message);
               
             }

        });  
    });
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
          if(data.data){
            toastr.success('Xóa thành công', 'Thông báo');
            loaddata();
            
          }
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
    function loaddata() {
      $('#dataTable').DataTable({
          destroy: true,
          searching: true,
          processing: true,
          language: {
              "sProcessing": "Đang xử lý...",
              "sLengthMenu": "Xem thông tin _MENU_ mục",
              "sZeroRecords": "Không tìm thấy dòng nào phù hợp",
              "sInfo": "Đang xem _START_ đến _END_ trong tổng số _TOTAL_ mục",
              "sInfoEmpty": "Đang xem 0 đến 0 trong tổng số 0 mục",
              "sInfoFiltered": "(được lọc từ _MAX_ mục)",
              "sInfoPostFix": "",
              "sSearch": "Tìm thông tin:",
              "sUrl": "",
              "oPaginate": {
                  "sFirst": "Đầu",
                  "sPrevious": "Trước",
                  "sNext": "Tiếp",
                  "sLast": "Cuối"
              }
          },
          ajax: {
              "url": load,
              "type": "GET"
          },
          columns: [
              { data: 'stt' },
              { data: 'tenbanh' },
              { data: 'sizebanh' },
              { data: 'hinhanh', "width": "20%" } ,
              { data: 'khuyenmai' },     
              { data: 'gia' },
              { data: 'soluongmua' },    
              { data: 'tonggia' },
              { data: 'btnXoa' },
          ]
      });

      $.ajax({
        url : load,
        method: 'GET',   
        success: function (data) {            
          console.log(data);
          $('.TotalPrice').html(data.total)
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

 
