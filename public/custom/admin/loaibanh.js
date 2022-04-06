$(document).ready(function () {
    $('#formloaibanh').on('submit', function (event) {
        event.preventDefault();
        $.ajax({
           url : "postloaibanh",
           method: 'POST',
           data: new FormData(this),
           contentType: false,
           cache: false,
           processData: false,
           success: function (data2) {            
             console.log(data2);
             var trangthai=data2.status;
             if (trangthai == true) {               
               toastr.success('Thêm loại bánh thành công', 'Thông báo');  
               loaddata();            
             }
             else{
               toastr.error('Thêm loại bánh thất bại',"Thông báo")
               setTimeout(function(){
                location.reload();
            }, 1000);
             }
           },
            error: function (data2) { 
                console.log(data2);
                toastr.warning(data2.responseJSON.message,"Thông báo") 
            }
           
         });
    });


    $('#form-edit').on('submit', function (event) {
      
      event.preventDefault();
      var id =$("#btn-edit-from").val();  
      var url_form_edit = 'edit-loaibanh/'+id;
      $.ajax({
         url : url_form_edit,
         method: 'POST',
         data: new FormData(this),
         contentType: false,
         cache: false,
         processData: false,
         success: function (data2) {              
           var trangthai=data2.status;
           if (trangthai == true) {               
             toastr.success('Sửa loại bánh thành công', 'Thông báo');                         
             loaddata();            
           }
           else{
             toastr.error('Sửa loại bánh thất bại',"Thông báo")
             setTimeout(function(){
              location.reload();
          }, 1000);
           }                 
         },
          error: function (data_er) { 
            console.log(data_er);
              toastr.warning(data_er.responseJSON.message,"Thông báo") 
          }
         
       });

  });
});
function loaddata(){
  $('#dataTable').DataTable( {
    destroy: true,
    searching: true,
    language: {
      "sProcessing":   "Đang xử lý...",
      "sLengthMenu":   "Xem thông tin _MENU_ mục",
      "sZeroRecords":  "Không tìm thấy dòng nào phù hợp",
      "sInfo":         "Đang xem _START_ đến _END_ trong tổng số _TOTAL_ mục",
      "sInfoEmpty":    "Đang xem 0 đến 0 trong tổng số 0 mục",
      "sInfoFiltered": "(được lọc từ _MAX_ mục)",
      "sInfoPostFix":  "",
      "sSearch":       "Tìm thông tin:",
      "sUrl":          "",
      "oPaginate": {
          "sFirst":    "Đầu",
          "sPrevious": "Trước",
          "sNext":     "Tiếp",
          "sLast":     "Cuối"
      }
    },
    ajax: 'loai-banh',
    columns: [
        { data: 'stt' },
        { data: 'tenloai' },
        { data: 'btn-sua' },
        { data: 'btn-xoa' },
    ]
} );
}


function sualoaibanh(id) {  
  var url_edit='edit-loaibanh/'+id;
  $.ajax({
    url : url_edit,
    method: 'GET',
    contentType: false,
    cache: false,
    processData: false,
    beforeSend: function () {
      Swal.fire({
        title: 'Đảng tải...',
        html: 'Vui lòng chờ đợi...',
        allowEscapeKey: false,
        allowOutsideClick: false,
        didOpen: () => {
          Swal.showLoading()
        }
      });
    },
    success: function (data2) {                 
      console.log(data2.datalb.tenloai);
        $('#tenloaibanh').val(data2.datalb.tenloai);
        $("#btn-edit-from").attr('value', data2.datalb.maloai);  
        swal.close();             
    }
  });
}




function xoaloaibanh(id) {
  var url_delete = 'delete-loaibanh/'+id;

  Swal.fire({
    title: 'Bạn có chắc muốn xóa Loại Bánh này không ?',
    text: "Dữ liệu này sẽ mất không thể khôi phục ",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    cancelButtonText: 'Không đồng ý',
    confirmButtonText: 'Đồng ý xóa'

  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url : url_delete,
        method: 'GET',
        contentType: false,
        cache: false,
        processData: false,
        success: function (data2) {              
          var trangthai=data2.status;
          if (trangthai == true) {               
            toastr.success('Xóa loại bánh thành công', 'Thông báo');                         
            loaddata();            
          }
          else{
            toastr.error('Không thể xóa loại bánh này',"Thông báo")
         }                 
        },
         error: function (data_er) { 
           console.log(data_er);
             toastr.warning(data_er.responseJSON.message,"Thông báo") 
             location.reload();
         }
        
      });

    }
  });
  
}


