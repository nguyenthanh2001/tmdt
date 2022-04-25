function LoadData() {
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
    ajax: 'size',
    columns: [
      { data: 'stt' },
      { data: 'tensize' },
      { data: 'tenbanh' },
      { data: 'giabanh' },
      { data: 'btn-sua' },
      { data: 'btn-xoa' },
    ]
  });
}

function opensize() {
  $('#formAddSize')[0].reset();
  $(".addSize").val('');
}

$(function () {
  $(".tags").autocomplete({
    source: function (request, response) {
      $.ajax({
        url: "getName",
        method: 'Post',
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
          "tenbanh": request.term
        },
        success: function (data) {
          response($.map(data.dataName, function (item) {
            return {
              label: item.tenbanh,
              value: item.mabanh
            }
          }));
        }
      });
    },
    minLength: 2,
    select: function (event, ui) {
      $(".tags").val(ui.item.label);
      $(".mabanh").val(ui.item.value);
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

$('#formAddSize').on('submit', function (event) {
  event.preventDefault();
  $.ajax({
    url: 'addSize',
    method: 'POST',
    data: new FormData(this),
    contentType: false,
    cache: false,
    processData: false,
    success: function (data2) {
      console.log(data2);
      var trangthai = data2.status;
      if (trangthai == true) {
        toastr.success('Thêm size bánh thành công', 'Thông báo');
        LoadData();
      } else {
        toastr.error('Thêm size bánh thất bại', "Thông báo")
        setTimeout(function () {
          location.reload();
        }, 1000);
      }

    },
    error: function (data_er) {
      if (data_er.status >= 500) {
        location.reload();
      }
      console.log(data_er);
      toastr.warning(data_er.responseJSON.message, "Thông báo")
    }

  });
});

function EditSize(id) {
  $('#formEditSize')[0].reset();
  $(".editsize").val('');
  $.ajax({
    url: 'getIdSize/' + id,
    method: 'GET',
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
      console.log(data2);
      $('#tensize').val(data2.dataSize.tensize);
      $('#mabanh').val(data2.dataSize.mabanh);
      $('#tenbanh').val(data2.dataSize.banh.tenbanh);
      $('#gia').val(data2.dataSize.gia);
      $("#btnEditSize").attr('value', data2.dataSize.masize);
      swal.close();
    }
  });
}


$('#formEditSize').on('submit', function (event) {
  event.preventDefault();
  var id = $("#btnEditSize").val();
  $.ajax({
    url: 'editSize/' + id,
    method: 'POST',
    data: new FormData(this),
    contentType: false,
    cache: false,
    processData: false,
    success: function (data2) {
      var trangthai = data2.status;
      if (trangthai == true) {
        toastr.success('Sửa size bánh thành công', 'Thông báo');
        LoadData();
      }
      else {
        toastr.error('Sửa size bánh thất bại', "Thông báo")
        setTimeout(function () {
          location.reload();
        }, 1000);
      }
    },
    error: function (data_er) {
      if (data_er.status >= 500) {
        location.reload();
      }
      console.log(data_er);
      toastr.warning(data_er.responseJSON.message, "Thông báo")
    }

  });

});

function DeleteSize(id) {
  Swal.fire({
    title: 'Bạn có chắc muốn xóa Size Bánh này không ?',
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
        url: 'deleteSize/' + id,
        method: 'GET',
        success: function (data2) {
          var trangthai = data2.status;
          if (trangthai == true) {
            toastr.success('Xóa Size Bánh thành công', 'Thông báo');
            LoadData();
          }
          else {        
            toastr.error('Không thể xóa Size Bánh này', "Thông báo")
          }
        },
        error: function (data_er) {
          if (data_er.status >= 500) {
            location.reload();
          }
          console.log(data_er);
          toastr.warning(data_er.responseJSON.message, "Thông báo")        
        }

      });

    }
  });

}



