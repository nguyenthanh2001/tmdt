<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hoadon;
use App\Models\CThoadon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class Qldonhang extends Controller
{
    public function Qlbill(Request $request)
    {
        $dataBill = Hoadon::where('trangthai',0)
        ->orderByDesc('mahd')
        ->with('user','noi.huyen.thanhpho')->get();
        $trangthai =0;
        return view('admin.donhang',compact('dataBill','trangthai'));
    }
    public function Qlbillby1(Request $request)
    {
        $dataBill = Hoadon::where('trangthai',1)
        ->orderByDesc('mahd')
        ->with('user','noi.huyen.thanhpho')->get();
        $trangthai =1;
        return view('admin.donhang',compact('dataBill','trangthai'));
    }
    public function Qlbillby2(Request $request)
    {
        $dataBill = Hoadon::where('trangthai',2)
        ->orderByDesc('mahd')
        ->with('user','noi.huyen.thanhpho')->get();
        $trangthai =2;
        return view('admin.donhang',compact('dataBill','trangthai'));
    }

    public function OrderReview(Request $request)
    {   
        $rule = [
            'mahd' => 'required|numeric|exists:hoadon,mahd',
        ];
        $mess = [
            'required' => 'Không được bỏ trống dữ liệu',
            'numeric' => 'Vui lòng nhập số',
            'mahd.exists' => 'Bánh không tồn tại',
        ];
        $validator = Validator::make($request->all(), $rule, $mess);
        $validator->validate();
        if (!$validator->fails()) {
            $billDetail = Hoadon::find($request->mahd);
            if($billDetail->trangthai == 0){
                $billDetail->trangthai =1;
            }else if($billDetail->trangthai == 1){
                $billDetail->trangthai =2;
            }
            $billDetail->save();
        }
        return back();
    }
    public function Deletebill(Request $request)
    {   
        $rule = [
            'mahd' => 'required|numeric|exists:hoadon,mahd',
        ];
        $mess = [
            'required' => 'Không được bỏ trống dữ liệu',
            'numeric' => 'Vui lòng nhập số',
            'mahd.exists' => 'Bánh không tồn tại',
        ];
        $validator = Validator::make($request->all(), $rule, $mess);
        $validator->validate();
        if (!$validator->fails()) {
            $billDetail = Hoadon::find($request->mahd);
            if($billDetail->trangthai == 0){
                $billDetail->delete();
            }
        }
        return back();
    }
    public function showBill($id)
    {
        
        $databill = CThoadon::where('hoadon_id',$id)->with('banh','size')->get();
        $bill =Hoadon::find($id)->load('user','noi.huyen.thanhpho');
        $Total = $databill->sum('tonggia');
        return view('admin.bill',compact('databill','Total','bill'));
    }
  


}
