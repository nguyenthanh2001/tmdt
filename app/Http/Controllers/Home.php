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
use App\Models\Diachi;
use App\Models\Banh;
use App\Models\Loaibanh;
use App\Models\Khuyenmai;


class Home extends Controller
{
    
    public function __construct()
    {

    }
    public function index(Request $request){
        $banh = Banh::orderBy('mabanh', 'desc')->with(['loaibanh', 'khuyenmai'])->skip(0)->take(10)->get();
        $Cakehot =Loaibanh::orderBy('maloai', 'desc')->with(['banh'=>function ($query){
            $query->orderBy('mabanh', 'desc')->skip(0)->take(2)->get();
        },'banh.khuyenmai'])->skip(0)->take(4)->get()->toArray();
        return view('home',compact('banh','Cakehot'));
    }

    public function shop(Request $request){
        $custom = Array();
        $Cakehot =Loaibanh::all()->sortBy([ ['maloai', 'desc']])->take(4)->toArray();
       foreach ($Cakehot as $key => $value) {
        $Banh = Banh::where('maloai_id',$value['maloai'])->with('khuyenmai')->orderBy('mabanh', 'desc')->get()->take(3)->toArray();
        array_push($custom,$Banh);
       };
       $khuyenmai = Banh::whereNotNull('makm')
       ->orderByDesc('mabanh')
       ->with('khuyenmai','loaibanh')
       ->get()->toArray();

       $indexCake = Banh::whereNull('makm')
       ->orderBy('mabanh', 'desc')      
       ->paginate(12);
       //dd($indexCake);
       return view('shop',compact('custom','khuyenmai','indexCake'));
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
        'diachi'=>'required',
        'xaid'=> 'required|numeric|exists:devvn_xaphuongthitran,xaid' 
    ];
        $mess=
        [
        'required' => 'Không được bỏ trống dữ liệu',
        'boolean' => 'Chọn đúng giới tính',
        'size'=>'Vui lòng nhập đúng qui định',
        'email'=>'Sai định dạng email',
        'email.unique'=>'email tồn tại trên hệ thống',
        'min'=>'Mật khẩu dài hơn 6 ký tự',
        'xaid.exists'=>'Đỉa chỉ không tồn tại'
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
            $user->maquyen = 2; 
            $user->xaid =$request->xaid;
            try {
                $trangthai = $user->save(); 
            } catch (\Throwable $th) {
                return response()->json(['status'=>$th->getMessage()]);
            }      
                     
            return response()->json(['status'=>$trangthai]);
       }
  
    }


    public function CheckDiaChi(Request $request){       
       // $a = Diachi::find(1)->load('quanhuyen','quanhuyen.thanhpho')->toArray();
        // $b=Thanhpho::Where('name','like','%Vĩnh long%')->with('quanhuyen:maqh,name,matp','quanhuyen.xaphuong:xaid,name,maqh')->get()->toArray();
        // $b=Thanhpho::Where('name','like','%Vĩnh long%')->with(['quanhuyen' => function ($query) {
        //     $query->Where('name','like','%Long hồ%')->get();
        // },'quanhuyen.xaphuong'=> function ($query2) {
        //     $query2->Where('name','like','%thị%')->get();
        // }
        // ])->get()->toArray();
        
        // dd($b);
      if ($request->ajax()) {
        $name = $request->tp;
        $b=Diachi::Where('name','like','%'.$name.'%')->with('huyen','huyen.thanhpho')->skip(0)->take(10)->get()->toArray();
        return response()->json(['dataName' => $b]);  
    }
     return response('',404);
    }
    public function form(Request $Request){
        $a = Array('name'=>'required');
        $b = Array('required'=>'không bỏ trống');
        $v = Validator::make($Request->all(),$a,$b);
        $v->validate();
        return response()->json(['trangthai'=>'thanhcong']);
    }
    
}
