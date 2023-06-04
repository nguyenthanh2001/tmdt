<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\phanquyen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Qltaikhoan extends Controller
{
    public function ShowTk(Request $request)
    {
        $Account  = User::where('id', '!=', Auth::user()->id)->orderBy('id', 'desc')->get();
        $quyen = phanquyen::all();
        return view('admin.taikhoan', compact('Account', 'quyen'));
    }
    public function addTK(Request $reques)
    {
        //xu ly dang ky
        $rule = [
            'hoten' => 'required',
            'email' => 'required|email|unique:users',
            'matkhau' => 'required|min:6',
            'gioitinh' => 'required|boolean',
            'ngaysinh' => 'required',
            'sdt' => 'required|numeric',
            'diachi' => 'required',
            'xaid' => 'required|numeric|exists:devvn_xaphuongthitran,xaid',
            'maquyen' => 'required|numeric|exists:phanquyen,maquyen'
        ];
        $mess =
            [
                'required' => 'Không được bỏ trống dữ liệu',
                'boolean' => 'Chọn đúng giới tính',
                'size' => 'Vui lòng nhập đúng qui định',
                'email' => 'Sai định dạng email',
                'email.unique' => 'email tồn tại trên hệ thống',
                'min' => 'Mật khẩu dài hơn 6 ký tự',
                'xaid.exists' => 'Đỉa chỉ không tồn tại'
            ];
        $validator = Validator::make($reques->all(), $rule, $mess);
        $validator->validate();
        if (!$validator->fails()) {
            $user = new User();
            $user->name = $reques->hoten;
            $user->email = $reques->email;
            $user->password =  bcrypt($reques->matkhau); //password_hash($request->matkhau,PASSWORD_DEFAULT),   
            $user->gioitinh = $reques->gioitinh;
            $user->ngaysinh = $reques->ngaysinh;
            $user->sdt = $reques->sdt;
            $user->diachi = $reques->diachi;
            $user->maquyen = $reques->maquyen;
            $user->xaid = $reques->xaid;
            try {
                $trangthai = $user->save();
            } catch (\Throwable $th) {
                return response()->json(['status' => $th->getMessage()]);
            }
            return response()->json(['status' => $trangthai]);
        }
    }
    public function deleteTk($id)
    {
        try {
            $tk = User::find($id);
            $tk->delete();  
        } catch (\Throwable $th) {
            return back()->with('xoatktb','kiểm tra lại dữ liệu trước khi xóa');
     
        }
        return back()->with('xoatk','Xóa tài khoản thành công');;
       
    }
}
