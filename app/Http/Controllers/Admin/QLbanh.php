<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banh;
use Illuminate\Support\Facades\Validator;
use Nette\Utils\Arrays;

class QLbanh extends Controller
{
    public function Showbanh(Request $request){
        $banh = Banh::orderBy('mabanh', 'desc')->with(['loaibanh','khuyenmai'])->get()->toArray();       
        if ($request->ajax()) {
            $custom  = array();
            foreach ($banh as $key => $value) {
                $custom[$key]['stt'] = $key + 1;
                $custom[$key]['tenkm'] = $value->tenbanh;
                $custom[$key]['tenkm'] = $value->soluong;
                $custom[$key]['tenkm'] = $value->hinhanh;
                $custom[$key]['tenkm'] = $value->mota;
                $custom[$key]['tenkm'] = $value->giabanh;
                $custom[$key]['giatri'] = $value->giatri;
                $custom[$key]['btn-sua'] = '
                <button onclick="suakm(' . $value->makm . ')" class="btn btn-warning btn-circle btn-sm" data-toggle="modal" data-target="#suakhuyenmai">
                      <i class="fas fa-edit"></i>
                </button>';
                $custom[$key]['btn-xoa'] = '
                <button onclick="xoakm(' . $value->makm . ')" class="btn btn-danger btn-circle btn-sm">
                          <i class="fas fa-trash"></i>
                </button>
                ';
            }
            return response()->json(['data' => $custom]);
        }
       return view('admin.banh', compact('banh'));
    }
}
