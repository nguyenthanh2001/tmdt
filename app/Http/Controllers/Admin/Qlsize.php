<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sizebanh;

class Qlsize extends Controller
{
  
     public function Showsize(Request $request)
    {
        $size =Sizebanh::orderBy('masize', 'desc')->with('banh')->get();
            if ($request->ajax()) {
                $custom  = array();
                foreach ($size as $key => $value) {
                    $custom[$key]['stt'] = $key + 1;
                    $custom[$key]['tensize'] = $value->tensize;
                    $custom[$key]['tenbanh'] = $value->banh->tenbanh;              
                    $custom[$key]['giabanh'] = number_format($value->gia);                   
                    $custom[$key]['btn-sua'] = '
                    <button onclick="EditSize(' . $value->masize . ')" class="btn btn-warning btn-circle btn-sm" data-toggle="modal" data-target="#suabanh">
                          <i class="fas fa-edit"></i>
                    </button>';
                    $custom[$key]['btn-xoa'] = '
                    <button onclick="DeleteSize(' . $value->masize . ')" class="btn btn-danger btn-circle btn-sm">
                              <i class="fas fa-trash"></i>
                    </button>
                    ';
                }
                return response()->json(['data' => $custom]);
            }
    
        //     $loaibanh = Loaibanh::orderBy('maloai', 'desc')->get();
        //     $khuyenmai = Khuyenmai::orderBy('giatri', 'desc')->get();
            return view('admin.sizebanh', compact('size'));
    }
}
