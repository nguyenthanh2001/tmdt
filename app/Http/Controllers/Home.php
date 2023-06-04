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
use App\Models\Hoadon;
use App\Models\CThoadon;
use App\Models\Khuyenmai;
use App\Http\Services\home\Detail;
use App\Http\Services\home\Cart;
use App\Models\Sizebanh;
use App\Http\Services\home\Checkout;
use phpDocumentor\Reflection\PseudoTypes\False_;
use phpDocumentor\Reflection\PseudoTypes\True_;
use RealRashid\SweetAlert\Facades\Alert;
class Home extends Controller
{
    protected $CakeDetail;
    protected $Cart;
    public function __construct(Detail $dataDetail, Cart $cart)
    {
        $this->CakeDetail = $dataDetail;
        $this->Cart = $cart;
    }
    public function index(Request $request)
    {
        $banh = Banh::orderBy('mabanh', 'desc')->with(['loaibanh', 'khuyenmai'])->skip(0)->take(10)->get();
        $Cakehot = Loaibanh::orderBy('maloai', 'desc')->with(['banh' => function ($query) {
            $query->orderBy('mabanh', 'desc')->skip(0)->take(2)->get();
        }, 'banh.khuyenmai'])->skip(0)->take(4)->get()->toArray();
        return view('home', compact('banh', 'Cakehot'));
    }

    public function shop(Request $request)
    {    
        $custom = array();
        $Cakehot = Loaibanh::all()->sortBy([['maloai', 'desc']])->take(4)->toArray();
        foreach ($Cakehot as $key => $value) {
            $Banh = Banh::where('maloai_id', $value['maloai'])->with('khuyenmai')->orderBy('mabanh', 'desc')->get()->take(3)->toArray();
            array_push($custom, $Banh);
        };
        $khuyenmai = Banh::whereNotNull('makm')
            ->orderByDesc('mabanh')
            ->with('khuyenmai', 'loaibanh')
            ->get()->toArray();
        if ($request->has('q') && !empty($request->query('q'))) {
            $q =$request->query('q');
            $indexCake = Banh::whereNull('makm')
            ->where('tenbanh','LIKE','%'.$q.'%')
            ->orderBy('mabanh', 'desc')
            ->paginate(9);
            $indexCake->appends(['q' => $q]);
        }else{
            $indexCake = Banh::whereNull('makm')
            ->orderBy('mabanh', 'desc')
            ->paginate(9);
        }    
        $coutCake = Banh::whereNull('makm')->count();
        $CoutSale = Banh::whereNotNull('makm')->count();
        return view('shop', compact('custom', 'khuyenmai', 'indexCake', 'coutCake', 'CoutSale'));
    }
    public function Category($id, Request $request)
    {
        $custom = array();
        $Cakehot = Loaibanh::all()->sortBy([['maloai', 'desc']])->take(4)->toArray();
        foreach ($Cakehot as $key => $value) {
            $Banh = Banh::where('maloai_id', $value['maloai'])->with('khuyenmai')->orderBy('mabanh', 'desc')->get()->take(3)->toArray();
            array_push($custom, $Banh);
        };
        $khuyenmai = Banh::whereNotNull('makm')
            ->orderByDesc('mabanh')
            ->with('khuyenmai', 'loaibanh')
            ->get()->toArray();

        $indexCake = Banh::whereNull('makm')->where('maloai_id', $id)
            ->orderBy('mabanh', 'desc')
            ->paginate(9);

        $coutCake = Banh::whereNull('makm')->where('maloai_id', $id)->count();
        $CoutSale = Banh::whereNotNull('makm')->count();
        return view('shop', compact('custom', 'khuyenmai', 'indexCake', 'coutCake', 'CoutSale'));
    }
    public function Details($id)
    {
        $detail = Banh::find($id);
        if (empty($detail)) {
            return abort(404);
        }
        $detail->load(['loaibanh', 'khuyenmai', 'anhct', 'sizebanh']);
        $price = $this->CakeDetail->CheckPriceCake($detail); 
        $indexCake = Banh::whereNull('makm')
        ->where('maloai_id',$detail->maloai_id)   
        ->get()->random(1)->sortByDesc('mabanh'); 
        return view('details', compact('detail', 'price','indexCake'));
        //trangchitiet
    }

    public function dangnhap()
    {
        //trangdangnhap
        return view('dangnhap');
    }
    public function dangxuat(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return view('dangnhap');
    }
    public function handle_dangnhap(Request $request)
    {
        //xu ly dang nhap
        $remember = ($request->has('remember')) ? true : false;
        $rule = [
            'email' => 'required|email',
            'matkhau' => 'required|min:6',
        ];
        $mess = [
            'required' => 'Không được bỏ trống dữ liệu',
            'min' => 'Mật khẩu phải dài hơn 6 ký tự',
            'email' => 'Email không hợp lệ'
        ];
        $validator = Validator::make($request->all(), $rule, $mess);
        $validator->validate();
        if (!$validator->fails()) {
            $data = [
                'email' => $request->email,
                'password' => $request->matkhau,
            ];
            if (Auth::attempt($data, $remember)) {
                $request->session()->regenerate();
                $maquyen = Auth::user()->maquyen; // lấy giá trị của mã quyền
                if ($maquyen == '1') { // kiểm tra giá trị của mã quyền
                   $link = route('admin.getbanh');
                   return response()->json(['status' => true, 'link' => $link]);           
                }
                elseif ($maquyen == '3') { // kiểm tra giá trị của mã quyền
                    $link = route('nhanvien.getloaibanh_nhanvien');
                    return response()->json(['status' => true, 'link' => $link]);           
                 } else {
                    $link = route('home.trangchu');
                   return response()->json(['status' => true, 'link' => $link]);
                }
                // $link = route('home.trangchu');
                // return response()->json(['status' => true, 'link' => $link]);
            }
        }
        return response()->json(['status' => false]);
    }
    public function dangky()
    {
        //trangdangnhap
        return view('dangky');
    }
    public function handle_dangky(Request $request)
    {
        //xu ly dang ky
        $rule = [
            'hoten' => 'required',
            'email' => 'required|email|unique:users',
            'matkhau' => 'required|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/',
            'gioitinh' => 'required|boolean',
            'ngaysinh' => 'required',
            'sdt' => 'required|numeric',
            'diachi' => 'required',
            'xaid' => 'required|numeric|exists:devvn_xaphuongthitran,xaid',
        ];
        $mess =
            [
                'required' => 'Không được bỏ trống dữ liệu',
                'boolean' => 'Chọn đúng giới tính',
                'size' => 'Vui lòng nhập đúng qui định',
                'email' => 'Sai định dạng email',
                'email.unique' => 'email tồn tại trên hệ thống',
                'min' => 'Mật khẩu dài hơn 8 ký tự',
                'matkhau.regex' => 'Mật khẩu phải có ít nhất 8 ký tự, bao gồm chữ in hoa, chữ số và ký tự đặc biệt',
                'xaid.exists' => 'Đỉa chỉ không tồn tại'
            ];
        $validator = Validator::make($request->all(), $rule, $mess);
        $validator->validate();
        if (!$validator->fails()) {

            $user = new User();
            $user->name = $request->hoten;
            $user->email = $request->email;
            $user->password =  bcrypt($request->matkhau); //password_hash($request->matkhau,PASSWORD_DEFAULT),   
            $user->gioitinh = $request->gioitinh;
            $user->ngaysinh = $request->ngaysinh;
            $user->sdt = $request->sdt;
            $user->diachi = $request->diachi;
            $user->maquyen = 2;
            $user->xaid = $request->xaid;
            try {
                $trangthai = $user->save();
            } catch (\Throwable $th) {
                return response()->json(['status' => $th->getMessage()]);
            }

            return response()->json(['status' => $trangthai]);
        }
    }


    public function CheckDiaChi(Request $request)
    {
        if ($request->ajax()) {
            $name = $request->tp;
            $b = Diachi::Where('name', 'like', '%' . $name . '%')->with('huyen', 'huyen.thanhpho')->get()->toArray();
            return response()->json(['dataName' => $b]);
        }
        return response('', 404);
    }

    public function AddCart(Request $request)
    {
        if (Auth::check()) {
            $rule = [
                'mabanh' => 'required|numeric|exists:banh,mabanh',
                'soluong' => 'required|numeric'
            ];
            $mess = [
                'required' => 'Không được bỏ trống dữ liệu',
                'numeric' => 'Vui lòng nhập số',
                'mabanh.exists' => 'hải sản không tồn tại',
            ];
            $validator = Validator::make($request->all(), $rule, $mess);
            $validator->validate();

            if (!$validator->fails()) {
                $product = array();
                if ($request->has('masize')) {
                    $product[$request->mabanh] = array(
                        'mabanh' => $request->mabanh,
                        'masize' => array($request->masize => $request->soluong)
                    );
                } else {
                    $product[$request->mabanh] = array('mabanh' => $request->mabanh, 'soluong' => $request->soluong);
                }
                if (session()->has('Cart')) {
                    $checkExists = 0;
                    foreach (session('Cart') as $key => $value) {
                        if ($request->has('masize')) {
                            if (array_key_exists($request->mabanh, $value) && array_key_exists($request->masize, $value[$request->mabanh]['masize'])) {
                                $value[$request->mabanh]['masize'][$request->masize] += $request->soluong;
                                session()->put('Cart.' . $key . '.' . $request->mabanh . '.masize.' . $request->masize . '', $value[$request->mabanh]['masize'][$request->masize]);
                                $checkExists++;
                            } else if (array_key_exists($request->mabanh, $value) && !array_key_exists($request->masize, $value[$request->mabanh]['masize'])) {
                                session()->push('Cart.' . $key . '.' . $request->mabanh . '.masize.' . $request->masize . '', $request->soluong);
                                session()->put('Cart.' . $key . '.' . $request->mabanh . '.masize.' . $request->masize . '', $request->soluong);
                                $checkExists++;
                            }
                        } else {
                            if (array_key_exists($request->mabanh, $value)) {
                                $value[$request->mabanh]['soluong'] += $request->soluong;
                                session()->put('Cart.' . $key . '.' . $request->mabanh . '.soluong', $value[$request->mabanh]['soluong']);
                                $checkExists++;
                            }
                        }
                    }

                    if ($checkExists == 0) {
                        session()->push('Cart', $product);
                    }
                } else {
                    session()->push('Cart', $product);
                }
            }
            return response()->json(['data' => True]);
        }
        return response()->json(['data' => False]);
    }
    public function ShowCart(Request $request)
    {

        $arCartID = [];
        //$request->session()->forget('Cart');
        //dd(session('Cart'));
        $Total = 0;
        if (session()->has('Cart')) {
            $arCart = $this->Cart->HandlingSessionCart(session('Cart'));
            foreach ($arCart as $key => $value) {
                $infoCake = Banh::find($key)->load('khuyenmai', 'sizebanh');
                if ($infoCake->sizebanh->isEmpty()) {
                    $arrTmp = $this->Cart->ArrCartNoSize($value, $infoCake);
                    array_push($arCartID, $arrTmp);
                } else {
                    foreach ($value['masize'] as $key2 => $value2) {
                        $infoCakeSize = Sizebanh::find($key2);
                        $arrTmp = $this->Cart->ArrCartHaveSize($value2, $infoCakeSize, $infoCake);
                        array_push($arCartID, $arrTmp);
                    }
                }
            }
            foreach ($arCartID as $key => $value) {
                $Total += (float)$value['tonggia'];;
            }
            $Total = number_format($Total);
        } else {
            //giỏ hàng rỗng
            $arCartID = [];
        }


        return view('cart', compact('arCartID', 'Total'));
    }
    public function UpdateCartQuantity(Request $request)
    {
        $cart = session('Cart');
        $quantity = $request->quantity;
        foreach ($quantity as $key => $value) {
            if ($key == 'mabanh') {
                foreach ($quantity["mabanh"]  as $key2 => $value2) {
                    foreach ($cart as $i => $session) {
                        if (isset($cart[$i][$key2])) {
                            if ($cart[$i][$key2]["mabanh"] == $key2) {
                                $cart[$i][$key2]["soluong"] = $value2;
                            }
                        }
                    }
                }
            } else if ($key == 'masize') {
                foreach ($quantity["masize"]  as $key2 => $value2) {
                    foreach ($cart as $i => $session) {
                        if (isset($cart[$i][$key2]) && isset($cart[$i][$key2]["masize"])) {
                            foreach ($cart[$i][$key2]["masize"] as $key3 => $value3) {
                                foreach ($quantity["masize"][$key2] as $key4 => $value4) {
                                    if ($key4 == $key3) {
                                        $cart[$i][$key2]["masize"][$key3] = $value4;
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        session()->put('Cart', $cart);
        return response()->json(['data' => True]);
    }

    public function Delete(Request $request)
    {
        $cart = session('Cart');
        $mabanh = $request->mabanh;
        foreach ($cart as $key => $value) {
            if ($request->has('masize')) {
                $masize = $request->masize;
                foreach ($value as $key2 => $value2) {
                    if (isset($value2['masize'])) {
                        if (array_key_exists($masize, $value2['masize'])) {
                            unset($cart[$key][$key2]['masize'][$masize]);
                            if (empty($cart[$key][$key2]['masize'])) {
                                unset($cart[$key]);
                            }
                            session()->put('Cart', $cart);
                        }
                    }
                }
            } else {
                if (array_key_exists($mabanh, $value)) {
                    unset($cart[$key]);
                    session()->put('Cart', $cart);
                }
            }
        }
        return response()->json(['data' => True]);
    }
    public function ShowCartAjax(Request $request)
    {
        if (session()->has('Cart') && count(session('Cart')) > 0) {
            $itemSeeson = $this->Cart->HandlingSessionCart(session('Cart'));
            $Cart = $this->Cart->showDetailItemCart($itemSeeson);
            $custom = array();
            $Total = 0;
            foreach ($Cart as $key => $value) {
                $custom[$key]['stt'] = $key + 1;
                $custom[$key]['tenbanh'] = $value['tenbanh'];
                if (empty($value['sizebanh'])) {
                    $custom[$key]['sizebanh'] = null;
                    $custom[$key]['soluongmua'] = '<div class="quantity"><div class="pro-qty"><span class="dec qtybtn">-</span><input class="quantityCart" type="number" name="quantity[mabanh]['.$value['mabanh'].']"value="'.$value['soluongmua'].'" min="1" max="500" step="1"><span class="inc qtybtn">+</span></div></div>';
                    $custom[$key]['btnXoa'] = ' <button type="button" class="btn btn-danger rounded-circle btn-sm"  data-item="' . $value['mabanh'] . '" onclick="DeleteItem(this);"><i class="fa fa-trash" aria-hidden="true"></i></button>';
                } else {
                    $custom[$key]['sizebanh'] = 'Size ' . $value['sizebanh'];
                    $custom[$key]['soluongmua'] = '<div class="quantity"><div class="pro-qty"><span class="dec qtybtn">-</span><input class="quantityCart" type="number" name="quantity[masize][' . $value['mabanh'] . '][' . $value['masize'] . ']"value="' . $value['soluongmua'] . '" min="1" max="500" step="1"><span class="inc qtybtn">+</span></div></div>';
                    $custom[$key]['btnXoa'] = '<button type="button" class="btn btn-danger rounded-circle btn-sm" data-item="' . $value['mabanh'] . '"  data-size="' . $value['masize'] . '" onclick="DeleteItem(this);"><i class="fa fa-trash" aria-hidden="true"></i></button>';
                }
                $custom[$key]['hinhanh'] = '<img src="' . asset('upload/imgCake/' . $value['hinhanh']) . '" alt="" class="imgCart img-thumbnail hact">';
                if (empty($value['khuyenmai'])) {
                    $custom[$key]['khuyenmai'] = null;
                } else {
                    $custom[$key]['khuyenmai'] = $value['khuyenmai'];
                }
                $custom[$key]['gia'] = number_format($value['gia']);
                $custom[$key]['tonggia'] = number_format($value['tonggia']);
                $Total += (float)$value['tonggia'];
            }
        } else {
            $custom = [];
            $Total = 0;
        }
        return response()->json(['data' => $custom, 'total' => number_format($Total) . ' VNĐ']);
    }

    public function Checkout(Request $request)
    {
        // Alert::success('Success Title', 'Success Message');
        $Checkout = new Checkout();
        $name = $Checkout->ShowNameAddress();
        if (session()->has('Cart') && count(session('Cart')) > 0) {
            $Total = 0;
            $itemSeeson = $this->Cart->HandlingSessionCart(session('Cart'));
            $Cart = $this->Cart->showDetailItemCart($itemSeeson);
            foreach ($Cart as $key => $value) {
                $Total += (float)$value['tonggia'];
            }
        } else {
            $Cart = [];
            $Total = 0;
        }
        return view('Checkout', compact('name', 'Cart', 'Total'));

    }
    public function HandleCheckout(Request $request)
    {
        //dd($request->all(),session('Cart'));
        if(empty(session('Cart')))
        {
            Alert::warning('Không thể đặt hàng khi giỏ hàng trống', 'Không thể đặt hàng khi giỏ hàng trống');
            return back();
        }
        $itemSeeson = $this->Cart->HandlingSessionCart(session('Cart'));
        $Cart = $this->Cart->showDetailItemCart($itemSeeson);     
        $checkout = new Checkout();
        $mahd = $checkout->addBill($request);
        $kq = $checkout->addBillDetail($Cart,$mahd);
        if($kq){
            session()->forget('Cart');
        }
        Alert::success('Đặt hàng thành công', 'Đặt hàng thành công');
      return back();
    

    }
    public function Waiting(Request $request)
    {   
        $dataBill = Hoadon::where('users_id',Auth::user()->id)
        ->where('trangthai',0)
        ->with('noi.huyen.thanhpho')->get();
        $trangthai =0;
        return view('waitBill',compact('dataBill','trangthai'));
    }
    public function See(Request $request)
    {   
        $datasee = CThoadon::where('hoadon_id',$request->mahd)->with('banh','size')->get();
        return response()->json(['data' => $datasee]);
    }
    public function Deletebill(Request $request)
    {   
        $rule = [
            'mahd' => 'required|numeric|exists:hoadon,mahd',
        ];
        $mess = [
            'required' => 'Không được bỏ trống dữ liệu',
            'numeric' => 'Vui lòng nhập số',
            'mahd.exists' => 'hải sản không tồn tại',
        ];
        $validator = Validator::make($request->all(), $rule, $mess);
        $validator->validate();
        if (!$validator->fails()) {
            $billDetail = Hoadon::find($request->mahd);
            if($billDetail->users_id == Auth::user()->id && $billDetail->trangthai == 0){
                $billDetail->delete();
            }
        }
        return back();
    }
    public function confirmedBill(Request $request)
    {   
        $dataBill = Hoadon::where('users_id',Auth::user()->id)
        ->where('trangthai',1)
        ->with('noi.huyen.thanhpho')->get();
        $trangthai=1;
        return view('waitBill',compact('dataBill','trangthai'));
    }
    public function Success(Request $request)
    {   
        $dataBill = Hoadon::where('users_id',Auth::user()->id)
        ->where('trangthai',2)
        ->with('noi.huyen.thanhpho')->get();
        $trangthai=2;
        return view('waitBill',compact('dataBill','trangthai'));
    }
    public function infoUser(Request $request)
    {
        $rule = [
            'name' => 'required',
            'xaid'=>'required|numeric|exists:devvn_xaphuongthitran,xaid',
            'diachi'=>'required',
        ];
        $mess = [
            'required' => 'Không được bỏ trống dữ liệu',
            'xaid.exists' => 'Nơi ở không tồn tại',
            'numeric' => 'Vui lòng nhập số',  
        ];
        $validator = Validator::make($request->all(), $rule, $mess);
        $validator->validate();
         if (!$validator->fails()) {
            $update = User::find(Auth::user()->id);
            $update->name =$request->name;
            $update->diachi =$request->diachi;
            $update->xaid = $request->xaid;
            $update->save();
        
         }
        return back();
    }




}
