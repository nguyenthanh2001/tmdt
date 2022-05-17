function see(id) {
    console.log(id);
    $('.detailBill').empty();
    $('.TotalPrice').empty();
  $.ajax({
    url : Linksee,
    method: 'POST',
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
    data: {
        "mahd":id,
      },
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
      console.log(data2.data);
      var arr =data2.data;
      var gia=0;
      var html='';
      var total=0;
      for (const key in arr) {
          if(arr[key].masize == null){
           gia = arr[key].gia;
          }else{
            gia = arr[key].size.gia;
          }
         html +=` 
        <tr>
        <td class="shoping__cart__item">
            <img class="imgDetailBill" src="${linkImg+'/'+arr[key].banh.hinhanh}" alt="">
            <h5>${arr[key].banh.tenbanh}</h5>
        </td>
        <td class="shoping__cart__price">
            ${new Intl.NumberFormat().format(gia)}
        </td>
        <td class="shoping__cart__quantity">
            ${arr[key].soluong}                                         
        </td>
        <td class="shoping__cart__total">
            ${new Intl.NumberFormat().format(arr[key].tonggia)}
        </td>                                      
    </tr>`;
          total += arr[key].tonggia;
      }

        $('.detailBill').html(html);
        $('.TotalPrice').html(new Intl.NumberFormat().format(total)+' VNĐ');
        swal.close();             
    }
  });
}