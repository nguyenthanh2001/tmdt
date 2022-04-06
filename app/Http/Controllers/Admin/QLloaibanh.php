<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Loaibanh;
use Illuminate\Support\Facades\Validator;

class QLloaibanh extends Controller
{
    // public function index(Request $request)
    // {
    //     $test = Loaibanh::find(1)->banh;
    //     return view('admin.trangchu');
    // }
    public function getloaibanh(Request $request)
    {
        $ad_lb = Loaibanh::orderBy('maloai', 'desc')->get();
        if ($request->ajax()) {
            $custom  = array();
            foreach ($ad_lb as $key => $value) {
                $custom[$key]['stt'] = $key + 1;
                $custom[$key]['tenloai'] = $value->tenloai;
                $custom[$key]['btn-sua'] = '
                  <button onclick="sualoaibanh(' . $value->maloai . ')" class="btn btn-warning btn-circle btn-sm" data-toggle="modal" data-target="#sualoaibanh">
                        <i class="fas fa-edit"></i>
                  </button>';
                $custom[$key]['btn-xoa'] = '
                  <button onclick="xoaloaibanh(' . $value->maloai . ')" class="btn btn-danger btn-circle btn-sm">
                            <i class="fas fa-trash"></i>
                  </button>
                  ';
            }
            return response()->json(['data' => $custom]);
        }
        return view('admin.loaibanh', compact('ad_lb'));
    }
    public function postloaibanh(Request $request)
    {
        $rule = [
            'tenloai' => 'required|unique:loaibanh',
        ];
        $mess = [
            'required' => 'Không được bỏ trống dữ liệu',
            'tenloai.unique' => 'Loại Bánh tồn tại trên hệ thống',
        ];
        $validator = Validator::make($request->all(), $rule, $mess);
        $validator->validate();
        if (!$validator->fails()) {
            $addlb = new Loaibanh();
            $addlb->tenloai = $request->tenloai;
            $trangthai = $addlb->save();
            return response()->json(['status' => $trangthai]);
        }
    }

    public function get_edit_loaibanh($id, Request $request)
    {
        if ($request->ajax()) {
            $loaibanh = Loaibanh::find($id);
            if (!empty($loaibanh)) {
                return response()->json(['datalb' => $loaibanh]);
            }
        }
        return redirect()->route('admin.getloaibanh');
    }

    public function post_edit_loaibanh(Request $request, $id)
    {
        $rule = [
            'tenloai' => 'required|unique:loaibanh',
        ];
        $mess = [
            'required' => 'Không được bỏ trống dữ liệu',
            'tenloai.unique' => 'Loại Bánh tồn tại trên hệ thống',
        ];
        $validator = Validator::make($request->all(), $rule, $mess);
        $validator->validate();
        if (!$validator->fails()) {
            $addlb = Loaibanh::find($id);
            $addlb->tenloai = $request->tenloai;
            $trangthai = $addlb->save();
            return response()->json(['status' => $trangthai]);
        }
    }
    public function get_delete_loaibanh($id)
    {
        $loaibanh = Loaibanh::find($id);
        if (!empty($loaibanh)) {
            try {
                $status = $loaibanh->delete();
                return response()->json(['status' => $status]);
            } catch (\Throwable $th) {
                return response()->json(['status' => false]);
            }
        }
        return redirect()->route('admin.get-edit-loaibanh');
    }
}
