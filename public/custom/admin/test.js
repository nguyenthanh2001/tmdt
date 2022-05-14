console.log('hello');
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
            "url": "http://localhost:8080/laravel/public/admin/banh",
            "type": "GET"
        },
        columns: [
            { data: 'stt' },
            { data: 'tenbanh' },
            { data: 'hinhanh', "width": "20%" } ,
            { data: 'soluong' },
            { data: 'mota' },
            { data: 'giabanh' },
            { data: 'loaibanh' },
            { data: 'khuyenmai' },
            { data: 'btn-sua' },
            { data: 'btn-xoa' },
        ]
    });

  
}