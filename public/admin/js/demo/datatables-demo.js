//Call the dataTables jQuery plugin
$(document).ready(function() {
  $('#dataTable').DataTable({
    language: {
      "sProcessing":   "Đang xử lý...",
      "sLengthMenu":   "Xem thông tin _MENU_ mục",
      "sZeroRecords":  "Không tồn tại dữ liệu",
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
  }
  });
  
});


// $(document).ready(function() {
//   $('#dataTable').DataTable({
//     language: {
//       "sProcessing":   "Đang xử lý...",
//       "sLengthMenu":   "Xem thông tin _MENU_ mục",
//       "sZeroRecords":  "Không tồn tại dữ liệu",
//       "sInfo":         "Đang xem _START_ đến _END_ trong tổng số _TOTAL_ mục",
//       "sInfoEmpty":    "Đang xem 0 đến 0 trong tổng số 0 mục",
//       "sInfoFiltered": "(được lọc từ _MAX_ mục)",
//       "sInfoPostFix":  "",
//       "sSearch":       "Tìm thông tin:",
//       "sUrl":          "",
//       "oPaginate": {
//           "sFirst":    "Đầu",
//           "sPrevious": "Trước",
//           "sNext":     "Tiếp",
//           "sLast":     "Cuối"
//       }
//     },
//     "ajax": {
//       url: "/admin/haisan",
//     type: "POST",
//     data: function(d) {
//         d._token = "{{ csrf_token() }}";
//     },
//     error: function(jqXHR, textStatus, errorThrown) {
//         console.log("ajax error: " + textStatus + ' : ' + errorThrown);
//     }
//     },
//   });
// });

