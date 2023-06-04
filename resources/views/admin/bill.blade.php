<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bill</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        body {
            background: #eee;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-center row">
            <div class="col-md-8">
                <div class="p-3 bg-white rounded">
                    <div class="row">
                        <div class="col-md-6">
                            <h1 class="text-uppercase">HÓA ĐƠN</h1>
                            <div class="billed"><span class="font-weight-bold text-uppercase">KHÁCH HÀNG:</span><span class="ml-1">{{$bill->user->name}}</span></div>
                            <div class="billed"><span class="font-weight-bold text-uppercase">NGÀY ĐẶT MUA:</span><span class="ml-1">{{\Carbon\Carbon::parse($bill->created_at)->format('d-m-Y')}}</span></div>
                            <div class="billed"><span class="font-weight-bold text-uppercase">NGÀY GIAO HÀNG:</span><span class="ml-1">{{\Carbon\Carbon::now()->format('d-m-Y')}}</span></div>
                            <div class="billed"><span class="font-weight-bold text-uppercase">MÃ HÓA ĐƠN:</span><span class="ml-1">{{$bill->mahd}}</span></div>
                            <div class="billed"><span class="font-weight-bold text-uppercase">NỞI Ở:</span><span class="ml-1">{{$bill->noi->name}} - {{$bill->noi->huyen->name}} - {{$bill->noi->huyen->thanhpho->name}}</span></div>
                            <div class="billed"><span class="font-weight-bold text-uppercase">ĐỊA CHỈ:</span><span class="ml-1">{{$bill->diachi}}</span></div>
                            
                        </div>
                        <div class="col-md-6 text-right mt-3">
                            <h4 class="text-danger mb-0">hải sản Vĩnh Long</h4><span>hải sản Vĩnh Long</span></div>
                    </div>
                    <div class="mt-3">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Stt</th>
                                        <th>Tên hải sản</th>
                                        <th>Size hải sản</th>
                                        <th>Số lượng</th>
                                        <th>Giá</th>
                                        <th>Tổng giá</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($databill as $databill)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{$databill->banh->tenbanh}}</td>
                                        @if (empty($databill->masize))
                                            <td></td>
                                        @else
                                            <td>Size {{$databill->size->tensize}}</td>
                                        @endif
                                        <td>{{$databill->soluong}}</td>
                                        <td>{{number_format($databill->gia)}} VNĐ</td>
                                        <td>{{number_format($databill->tonggia)}} VNĐ</td>
                                    </tr>    
                                    @empty
                                    @endforelse  
                                    <tr>
                                        <td></td>  
                                        <td></td>                                                          
                                        <td colspan="2"><H5>Tổng thanh toán: </H5> </td>
                                        <td colspan="2"><H5> {{number_format($Total)}} VNĐ</H5></td>
                                    </tr>                         
                                </tbody>
                            </table>
                        </div>
                    </div>
                    {{-- <div class="text-right mb-3"><button class="btn btn-danger btn-sm mr-5" type="button">Pay Now</button></div> --}}
                </div>
            </div>
        </div>
    </div>

   
</body>

</html>
