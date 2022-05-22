<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Loaibanh;
use App\Http\Services\admin\Thongke as TK;
use Illuminate\Support\Arr;

class Thongke extends Controller
{
    public function Thongke()
    {
        $TopCake = new TK();
        $result = $TopCake->TopCake();
        $arrTop = array();
        foreach ($result as $key => $value) {
          $arrTop['nameCake'][] =  $value->banh->tenbanh;
          $arrTop['quantity'][] = $value->Tongsoluong;
     }
       return view('admin.thongke',compact('arrTop'));
    }
    public function TKLoai(Request $request)
    {
       if ($request->ajax()) {
        $LoaiCake = new TK();
        $loai = $LoaiCake->LoaiCake();
        $arr = array();
        foreach ($loai as $key => $value) {
             $arr[$key]['maloai']= $value->maloai;
             $arr[$key]['tenloai']= $value->tenloai;
             $arr[$key]['soluongbanh']= $value->banh->count();
        }
       return response()->json(['arr' => $arr]);
    }
     return abort(404);
    }
    public function TopCake(Request $request)
    {
    //    if ($request->ajax()) {
    //     $LoaiCake = new TK();
        
    //    return response()->json();
    // }
    //  return abort(404);

    }

}
