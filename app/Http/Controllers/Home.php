<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Nette\Utils\Validators;
use PhpParser\Node\Expr\Cast\Array_;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\HomeModel;
use App\Models\TaikhoanModel;
class Home extends Controller
{
    private $taikhoan;
    public function __construct()
    {
        $this->taikhoan =new TaikhoanModel();       
    }
    public function Index(){
        //trang chu
        return 'trang chu';
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
    public function handle_dangnhap(Request $request){
        //xu ly dang nhap
        $rule=[
            'taikhoan' => 'required',
            'matkhau' => 'required|min:6',           
        ];
        $mess=[
            'required' => 'Không được bỏ trống dữ liệu',
            'min'=>'Mật khẩu dài hơn 6 ký tự',
            ];
            $validator = Validator::make($request->all(), $rule,$mess);  
            $validator->validate();
            if (!$validator->fails()) {
                $data = [
                    'taikhoan' => $request->taikhoan,
                    'matkhau' =>$request->matkhau,
                ];
               $kq = $this->taikhoan->dangnhap($data);
               if($kq->count() > 0){
                $mang= $kq->first();
                $mk_hash = $mang->matkhau;
                if (password_verify($request->matkhau,$mk_hash)==true) {
                    //tạo session;
                    return response()->json(['status'=>true]);
                }
                }              
            }
          return response()->json(['status'=>false]);;
    }
    public function dangky(){
        //trangdangnhap
        return view('dangky');
    }
    public function handle_dangky(Request $request){
        //xu ly dang ky
        $rule=[
        'hoten' => 'required',
        'taikhoan' => 'required|unique:taikhoan',
        'matkhau' => 'required|min:6',
        'gioitinh' => 'required|boolean',
        'ngaysinh'=> 'required',
        'sdt'=> 'required|numeric',
        'gmail'=>'required|email|unique:taikhoan',
        'diachi'=>'required'  
    ];
        $mess=
        [
        'required' => 'Không được bỏ trống dữ liệu',
        'taikhoan.unique' => 'Tồn tại tài khoản này vui lòng đổi tài khoản khác',
        'boolean' => 'Chọn đúng giới tính',
        'integer' => 'Nhập số',
        'size'=>'Vui lòng nhập đúng qui định',
        'email'=>'Sai định dạng email',
        'gmail.unique'=>'email tồn tại trên hệ thống',
        'min'=>'Mật khẩu dài hơn 6 ký tự',

        ];
        $validator = Validator::make($request->all(), $rule,$mess);      
        $validator->validate();
        if (!$validator->fails()) {
            $data = [
                'hoten' => $request->hoten,
                'taikhoan' => $request->taikhoan,
                'matkhau' => password_hash($request->matkhau,PASSWORD_DEFAULT),
                'gioitinh' => $request->gioitinh,
                'ngaysinh'=> $request->ngaysinh,
                'sdt'=> $request->sdt,
                'gmail'=>$request->gmail,
                'diachi'=>$request->diachi,
                'maquyen'=>2
            ];
            $trangthai = $this->taikhoan->addtaikhoan($data);           
            return response()->json(['status'=>$trangthai]);
        }
       // $validator->data["hoten"];
        // if ($validator->fails()) {
        //     return response()->json(['error'=>$validator->errors()],201);
        // }
        // else{
        //     return response()->json(['success'=>'thành công']);
        // }
    }


    public function sayhi(){
        $test = new HomeModel();
        return dd($test->test());
       return view('welcome',compact('test'));
    }
    public function form(Request $Request){
        $a = Array('name'=>'required');
        $b = Array('required'=>'không bỏ trống');
       $v = Validator::make($Request->all(),$a,$b);

        $v->validate();
        return response()->json(['trangthai'=>'thanhcong']);
    }
    
}
