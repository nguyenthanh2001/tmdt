<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Nette\Utils\Validators;
use PhpParser\Node\Expr\Cast\Array_;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class Home extends Controller
{
    
    public function __construct()
    {

    }
    public function index(Request $request){
      
        return view('home');
    }
    public function chitietsp($id=null){
        if (empty($id)) {                
            return abort(404);
        }
       
        return 'day la chi tiet san pham cua '.$id;
        //trangchitiet

    }

    public function dangnhap(){
        //trangdangnhap
        return view('dangnhap');
    }
    public function dangxuat(Request $request){            
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return view('dangnhap');
    }
    public function handle_dangnhap(Request $request){      
        //xu ly dang nhap
        $remember = ($request->has('remember')) ? true :false;
        $rule=[
            'email' => 'required|email',
            'matkhau' => 'required|min:6',           
        ];
        $mess=[
            'required' => 'Không được bỏ trống dữ liệu',
            'min'=>'Mật khẩu dài hơn 6 ký tự',
            'email'=>'Email không hợp lệ'
            ];
            $validator = Validator::make($request->all(), $rule,$mess);  
            $validator->validate();
            if (!$validator->fails()) {
                $data = [
                    'email' => $request->email,
                    'password' =>$request->matkhau,
                ];
                if (Auth::attempt($data,$remember)) {
                    $request->session()->regenerate();
                    $link = route('home.trangchu');              
                    return response()->json(['status'=>true,'link'=>$link]);
                }             
            }                        
          return response()->json(['status'=>false]);
    }
    public function dangky(){
        //trangdangnhap
        return view('dangky');
    }
    public function handle_dangky(Request $request){
        //xu ly dang ky
        $rule=[
        'hoten' => 'required',
        'email'=>'required|email|unique:users',
        'matkhau' => 'required|min:6',
        'gioitinh' => 'required|boolean',
        'ngaysinh'=> 'required',
        'sdt'=> 'required|numeric',
        'diachi'=>'required'  
    ];
        $mess=
        [
        'required' => 'Không được bỏ trống dữ liệu',
        'boolean' => 'Chọn đúng giới tính',
        'size'=>'Vui lòng nhập đúng qui định',
        'email'=>'Sai định dạng email',
        'email.unique'=>'email tồn tại trên hệ thống',
        'min'=>'Mật khẩu dài hơn 6 ký tự',
        ];
        $validator = Validator::make($request->all(), $rule,$mess);      
        $validator->validate();

        if (!$validator->fails()) {
  
            $user = new User();
            $user->name = $request->hoten;
            $user->email = $request->email;
            $user->password =  bcrypt($request->matkhau);//password_hash($request->matkhau,PASSWORD_DEFAULT),   
            $user->gioitinh = $request->gioitinh;
            $user->ngaysinh = $request->ngaysinh;         
            $user->sdt = $request->sdt;
            $user->diachi =$request->diachi;
            $user->phanquyen_id = 2;       
            $trangthai = $user->save();           
            return response()->json(['status'=>$trangthai]);
       }
  
    }


    public function sayhi(){
      return view('home');
    }
    public function form(Request $Request){
        $a = Array('name'=>'required');
        $b = Array('required'=>'không bỏ trống');
        $v = Validator::make($Request->all(),$a,$b);
        $v->validate();
        return response()->json(['trangthai'=>'thanhcong']);
    }
    
}
