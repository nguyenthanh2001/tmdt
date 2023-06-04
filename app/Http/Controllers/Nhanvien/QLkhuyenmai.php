<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Khuyenmai;
use Illuminate\Validation\Rule;
class QLkhuyenmai extends Controller
{
    public function Showkhuyenmai(Request $request)
    {     
        $khuyenmai = Khuyenmai::orderBy('makm', 'desc')->get();
        if ($request->ajax()) {
            $custom  = array();
            foreach ($khuyenmai as $key => $value) {
                $custom[$key]['stt'] = $key + 1;
                $custom[$key]['tenkm'] = $value->tenkm;
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
        return view('admin.khuyenmai', compact('khuyenmai'));
    }
    public function Post_add_khuyenmai(Request $request)
    {
        $rule = [
            'tenkm' => 'required|unique:khuyenmai',
            'giatri' => 'required|numeric|min:1|max:100|unique:khuyenmai'
        ];
        $mess = [
            'required' => 'Không được bỏ trống dữ liệu',
            'numeric' => 'Gía trị khuyễn mãi là số',
            'min' => 'Gía trị khuyến mãi không nhỏ hơn 1',
            'max' => 'Gía trị khuyến mãi không lớn hơn 100',
            'tenkm.unique' => 'Tên khuyến mãi tồn tại trên hệ thống',
            'giatri.unique' => 'Gía trị khuyến mãi tồn tại trong hệ thống'
        ];
        $validator = Validator::make($request->all(), $rule, $mess);
        $validator->validate();
        if (!$validator->fails())
        {
            $addkm = new Khuyenmai();
            $addkm->giatri = $request->giatri;
            $addkm->tenkm = $request->tenkm;
            $trangthai = $addkm->save(); 
            return response()->json(['status' => $trangthai]);    
        }
    }
    public function get_edit_khuyen_mai($id,Request $request){
        if ($request->ajax()) {
            $khuyenmai = Khuyenmai::find($id);
            if (!empty($khuyenmai)) {
                return response()->json(['datakm' => $khuyenmai]);
            }
        }
        return redirect()->route('admin.getkhuyenmai'); 

    }
    public function post_edit_khuyen_mai(Request $request,$id){
        $addkm = Khuyenmai::find($id);
        $rule = [
            'tenkm' =>  ['required',Rule::unique('khuyenmai')->ignore($addkm->tenkm,'tenkm')],
            'giatri' =>  ['required','numeric','min:1','max:99',Rule::unique('khuyenmai')->ignore($addkm->giatri,'giatri')]
        ];
        $mess = [
            'required' => 'Không được bỏ trống dữ liệu',
            'numeric' => 'Gía trị khuyễn mãi là số',
            'min' => 'Gía trị khuyến mãi không nhỏ hơn 1',
            'max' => 'Gía trị khuyến mãi không lớn hơn 100',
            'tenkm.unique' => 'Tên khuyến mãi tồn tại trên hệ thống',
            'giatri.unique' => 'Gía trị khuyến mãi tồn tại trong hệ thống'
        ];
        $validator = Validator::make($request->all(), $rule, $mess);
        $validator->validate();
        if (!$validator->fails())
        {
            $addkm->giatri = $request->giatri;
            $addkm->tenkm = $request->tenkm;
            $trangthai = $addkm->save(); 
            return response()->json(['status' => $trangthai]);    
        }

    }

    public function get_delete_khuyen_mai($id){
        $khuyenmai = Khuyenmai::find($id);
        if (!empty($khuyenmai)) {
            try {
                $status = $khuyenmai->delete();
                return response()->json(['status' => $status]);
            } catch (\Throwable $th) {
                return response()->json(['status' => false]);
            }          
        }
        return redirect()->route('admin.getkhuyenmai'); 
    }
}
