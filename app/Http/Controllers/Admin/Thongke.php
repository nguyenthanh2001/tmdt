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
       return view('admin.thongke');
    }
    public function TKLoai(Request $request)
    {
    //    if ($request->ajax()) {
    // }
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
}
