@extends('master_layout.layout_trangchu')
{{-- @section('load')
@include('block.load')
@endsection --}}
@section('main')
<form action="" method="post" id="aa">
    @csrf
    <input type="text" name="name" value="" placeholder="Nhập Tên" >
       <span class="er er_name"></span>
    <input type="submit" name="sb" value="gui">
</form>
@endsection
@push('js')
    <script>
           $(document).ready(function () {
       $('#aa').on('submit', function (event) {
         event.preventDefault();
         $.ajax({
            url : "new",
           method: 'POST',
           data: new FormData(this),
           contentType: false,
           cache: false,
           processData: false,
           success: function (data2) {
             console.log(data2);                        
           },
           error: function (data2) { 
            let a =data2.responseJSON.errors
            console.log(a);  
            $('.er').text("");
            for (const key in a) {
                console.log(a[key]);
                $('.er_'+key).text(a[key][0]);
            }

            }
           
         });
     
       });
     });
    </script>
@endpush