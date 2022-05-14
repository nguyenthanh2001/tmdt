<?php

namespace App\Http\Controllers;
use Illuminate\Support\Collection;
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
use App\Http\Services\home\Detail;
use App\Http\Services\home\Cart;
use App\Models\Sizebanh;
use phpDocumentor\Reflection\PseudoTypes\False_;

class Home extends Controller
{
    protected $CakeDetail;
    protected $Cart;
    public function __construct(Detail $dataDetail,Cart $cart)
    {
        $this->CakeDetail = $dataDetail;
        $this->Cart = $cart;
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
       ->paginate(9);

       $coutCake = Banh::whereNull('makm')->count();
       $CoutSale = Banh::whereNotNull('makm')->count();
       return view('shop',compact('custom','khuyenmai','indexCake','coutCake','CoutSale'));
    }
    public function Category($id,Request $request)
    {
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

       $indexCake = Banh::whereNull('makm')->where('maloai_id',$id)
       ->orderBy('mabanh', 'desc')      
       ->paginate(9);

       $coutCake = Banh::whereNull('makm')->where('maloai_id',$id)->count();
       $CoutSale = Banh::whereNotNull('makm')->count();
       return view('shop',compact('custom','khuyenmai','indexCake','coutCake','CoutSale'));
    }
    public function Details($id){
        $detail = Banh::find($id);
        if (empty($detail)) {
            return abort(404);
        }
        $detail->load(['loaibanh','khuyenmai','anhct','sizebanh']);     
        $price = $this->CakeDetail->CheckPriceCake($detail);
        // foreach ($price['giabanh'] as $key => $value) {
        //   echo  $value['giagoc'];
        // }
       //$this->CakeDetail->CheckPriceCake($detail)
        return view('details',compact('detail','price'));
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
      if ($request->ajax()) {
        $name = $request->tp;
        $b=Diachi::Where('name','like','%'.$name.'%')->with('huyen','huyen.thanhpho')->get()->toArray();
        return response()->json(['dataName' => $b]);  
    }
     return response('',404);
    }
  
    public function AddCart(Request $request)
    {  
        if (Auth::check()) {
            $rule = [
                'mabanh' => 'required|numeric|exists:banh,mabanh',
                'soluong'=> 'required|numeric'
            ];
            $mess = [
                'required' => 'Không được bỏ trống dữ liệu',
                'numeric' => 'Vui lòng nhập số',
                'mabanh.exists'=>'Bánh không tồn tại',
            ];
            $validator = Validator::make($request->all(), $rule, $mess);
            $validator->validate();
            
            if (!$validator->fails()) {    
                $product = array(); 
                if ($request->has('masize')) {
                    $product[$request->mabanh] = array(
                                                'mabanh'=>$request->mabanh ,
                                                'masize'=>array($request->masize =>$request->soluong)
                                                ); 
                }
                else{
                    $product[$request->mabanh] = array('mabanh'=>$request->mabanh,'soluong'=>$request->soluong); 
                }               
                if (session()->has('Cart')) {
                    $checkExists = 0;                 
                    foreach (session('Cart') as $key => $value) {                 
                        if ($request->has('masize')) {
                            if (array_key_exists($request->mabanh, $value) && array_key_exists($request->masize, $value[$request->mabanh]['masize'])) {           
                                $value[$request->mabanh]['masize'][$request->masize] += $request->soluong;   
                                session()->put('Cart.'.$key.'.'.$request->mabanh.'.masize.'.$request->masize.'' ,$value[$request->mabanh]['masize'][$request->masize]);      
                                $checkExists++;                    
                            }else if(array_key_exists($request->mabanh, $value) && !array_key_exists($request->masize, $value[$request->mabanh]['masize'])){                      
                                session()->push('Cart.'.$key.'.'.$request->mabanh.'.masize.'.$request->masize.'',$request->soluong);
                                session()->put('Cart.'.$key.'.'.$request->mabanh.'.masize.'.$request->masize.'',$request->soluong);
                                $checkExists++;  
                            }                    
                        }
                        else{
                            if (array_key_exists($request->mabanh, $value)) {           
                                $value[$request->mabanh]['soluong'] += $request->soluong;   
                                session()->put('Cart.'.$key.'.'.$request->mabanh.'.soluong' ,$value[$request->mabanh]['soluong']);      
                                $checkExists++;                    
                            }
                        }                        
                    }
    
                    if ($checkExists == 0) {
                        session()->push('Cart',$product);
                    }
                }else{           
                    session()->push('Cart',$product);
                }               
            }
            return response()->json(['data' => True]);
        }      
        return response()->json(['data' => False]);  

    }
    public function ShowCart(Request $request)
    {
        $arCartID =[];
       //$request->session()->forget('Cart');
       //dd(session('Cart'));
        if (session()->has('Cart')) {    
            $arCart = $this->Cart->HandlingSeesonCart(session('Cart'));                 
                foreach ($arCart as $key => $value) {
                    $infoCake = Banh::find($key)->load('khuyenmai','sizebanh');
                    if($infoCake->sizebanh->isEmpty()){
                        $arrTmp = $this->Cart->ArrCartNoSize($value,$infoCake);           
                        array_push($arCartID ,$arrTmp);
                    }else{
                       foreach ($value['masize'] as $key2 => $value2) {
                        $infoCakeSize = Sizebanh::find($key2);
                        $arrTmp = $this->Cart->ArrCartHaveSize($value2,$infoCakeSize,$infoCake); 
                        array_push($arCartID ,$arrTmp);
                       }               
                    }               
                   
                } 
        }else{
            //giỏ hàng rỗng
            $arCartID =[]; 
        }
       // dd($arCartID);
        return view('cart',compact('arCartID'));
    }
    public function UpdateCartQuantity(Request $request){       
        $cart = session('Cart');
        $quantity = $request->quantity;
        foreach ($cart as $key => $value) {         
            foreach ($value as $key2 => $value2) {              
                if (isset($quantity["mabanh"]) ) { // chi update banh ko size
                   foreach ($quantity["mabanh"] as $key3 => $value3) {
                       if($key3 == $value2['mabanh']){
                        $cart[$key][$key2]["soluong"] = $value3;
                       }
                   }
                }
            }              
        }

        return response()->json(['data' => $request->all()]);  

    }
}
