<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Banh as ControllersBanh;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banh;
use App\Models\Sizebanh;
use App\Models\Loaibanh;
use App\Models\Khuyenmai;
use App\Models\Anhct;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File; 
use Illuminate\Validation\Rule;
use Nette\Utils\Arrays;
use Illuminate\Support\Facades\Storage;
use phpDocumentor\Reflection\PseudoTypes\False_;
use App\Models\User;

class QLbanh extends Controller
{
    public function Showbanh(Request $request)
    {
        $banh = Banh::orderBy('mabanh', 'desc')->with(['loaibanh', 'khuyenmai'])->get()->toArray();
    //    $test = Banh::where('maloai_id',1)->with(['loaibanh', 'khuyenmai'])->get();
    //    dd($test);
    //dd(Auth::user());
        if ($request->ajax()) {
            $custom  = array();
            foreach ($banh as $key => $value) {
                $custom[$key]['stt'] = $key + 1;
                $custom[$key]['tenbanh'] = $value['tenbanh'];
                $custom[$key]['soluong'] = $value['soluong'];
                $custom[$key]['hinhanh'] = '<img style="width:100%;height: 200px;object-fit: contain;" src="'.asset('upload/imgCake/'.$value['hinhanh']).'" alt="'.$value['tenbanh'].'" class="img-thumbnail hact"  onclick="seeimg(this)" data-original="'.asset('upload/imgCake/'.$value['hinhanh']).'" >';
                $custom[$key]['mota'] = Str::limit($value['mota'], 30);
                if($value['giabanh'] == 0){
                    $custom[$key]['giabanh'] ='<button class="badge badge-pil badge-success">Bánh có nhiều Size</button>';
                }else{
                    $custom[$key]['giabanh'] = number_format($value['giabanh']);   
                }
                $custom[$key]['loaibanh'] = '<span class="badge badge-pill badge-info">'.$value["loaibanh"]["tenloai"].'</span> ';
                if(!empty($value["khuyenmai"])){
                    $custom[$key]['khuyenmai'] = $value["khuyenmai"]["giatri"];
                }else{
                    $custom[$key]['khuyenmai'] =0;
                }
                $custom[$key]['btn-sua'] = '
                <button onclick="editCake(' . $value['mabanh'] . ')" class="btn btn-warning btn-circle btn-sm" data-toggle="modal" data-target="#suabanh">
                      <i class="fas fa-edit"></i>
                </button>';
                $custom[$key]['btn-xoa'] = '
                <button onclick="deleteCake(' . $value['mabanh'] . ')" class="btn btn-danger btn-circle btn-sm">
                          <i class="fas fa-trash"></i>
                </button>
                ';
            }
            return response()->json(['data' => $custom]);
        }

        $loaibanh = Loaibanh::orderBy('maloai', 'desc')->get();
        $khuyenmai = Khuyenmai::orderBy('giatri', 'desc')->get();
        return view('admin.banh', compact('banh', 'loaibanh', 'khuyenmai'));
    }

    public function PostAddCake(Request $request)
    {
        $checkSize = ($request->has('sizebanh')) ? true : false;
        if ($request->has('sizebanh')) {
            $rule = [
                'tenbanh' => 'required|unique:banh,tenbanh',
                'soluong' => 'required|numeric|min:1',
                'hinhanh' => 'required',
                'hinhanhct.*' => 'required',
                //
                'tensize.*' => 'required',
                'gia.*' => 'required|numeric|min:1',
                //
                'makm' => 'required|numeric',
                'maloai' => 'required|numeric',
                'mota' => 'required',
            ];
            $mess = [
                'required' => 'Không được bỏ trống dữ liệu',
                'tenbanh.unique' => 'Tên bánh tồn tại trông hệ thống',
                'numeric' => 'Vui lòng nhập số',
                'min' => 'Gía trị khuyến mãi không nhỏ hơn 1',
            ];
        } else {
            $rule = [
                'tenbanh' => 'required|unique:banh,tenbanh',
                'soluong' => 'required|numeric|min:1',
                'hinhanh' => 'required',
                'hinhanhct.*' => 'required',
                'giabanh' => 'required|numeric|min:1',
                'makm' => 'required|numeric',
                'maloai' => 'required|numeric',
                'mota' => 'required',
            ];
            $mess = [
                'required' => 'Không được bỏ trống dữ liệu',
                'tenbanh.unique' => 'Tên bánh tồn tại trông hệ thống',
                'numeric' => 'Vui lòng nhập số',
                'min' => 'Gía trị khuyến mãi không nhỏ hơn 1',
            ];
        }


        $validator = Validator::make($request->all(), $rule, $mess);
        $validator->validate();


        if (!$validator->fails()) {
            //check file              
            $fileCake = $request->file('hinhanh');
            $fileCakes = $request->file('hinhanhct');

            //imgCoke
            $fileExtensionCake = $fileCake->extension();

            if ($fileExtensionCake != 'jpg' && $fileExtensionCake != 'png' && $fileExtensionCake != 'jpeg') {
                return response()->json(['status' => false, 'dataErro' => 'File không hợp lệ']);
            }
            foreach ($fileCakes as $key => $value) {
                $fileExtensionCakes = $value->extension();
                if ($fileExtensionCakes != 'jpg' && $fileExtensionCakes != 'png' && $fileExtensionCakes != 'jpeg') {
                    return response()->json(['status' => false, 'dataErro' => 'File chi tiết không hợp lệ']);
                }
            }

            $nameCake = $fileCake->hashName();
            //  $fileCake->move('upload/imgCake', $nameCake);           
            //insert banh          
            $addCake = new Banh();
            $addCake->tenbanh = $request->tenbanh;
            $addCake->soluong = $request->soluong;
            $addCake->hinhanh = $nameCake;
            $addCake->mota = $request->mota;
            if (!$checkSize) {
                $addCake->giabanh = $request->giabanh.'000';
            }
            if ($request->makm != 0) {
                $addCake->makm = $request->makm;
            }
            $addCake->maloai_id = $request->maloai;

            //save img Cake
            $fileCake->move('upload/imgCake', $nameCake);
            if ($addCake->save()) {
                //insert chi tiet anh     
                foreach ($fileCakes as $key => $value) {
                    $addDetailedImg = new Anhct();
                    $nameCakes = $value->hashName();
                    $addDetailedImg->link = $nameCakes;
                    $addDetailedImg->mabanh = $addCake->mabanh;
                    $addDetailedImg->save();
                    $value->move('upload/imgCakes', $nameCakes);
                }
                if ($checkSize) {
                    //insert size banh    
                    for ($i = 0; $i < count($request->gia); $i++) {
                        $addSizeCake = new Sizebanh();
                        $addSizeCake->tensize = $request->tensize[$i];
                        $addSizeCake->mabanh = $addCake->mabanh;
                        $addSizeCake->gia = $request->gia[$i].'000';
                        $addSizeCake->save();
                    }
                }
                 return response()->json(['status' => true]);
            }
        }
    }

    public function getEditCake(Request $request,$id)
    {   
        if ($request->ajax()) {
            $banh = Banh::find($id)->load('sizebanh','anhct')->toArray();
            if (!empty($banh)) {
                $tmpNameCake = $banh["hinhanh"];
                $banh["hinhanh"] = asset('upload/imgCake/'.$tmpNameCake);
                if (count($banh["anhct"]) != 0) {
                    for ($i=0; $i < count($banh["anhct"]); $i++) { 
                       $tmpName =  $banh["anhct"][$i]["link"];
                       $path = asset('upload/imgCakes/'.$tmpName);
                       $banh["anhct"][$i]["link"] = $path;
                    }
                }
               
                return response()->json(['dataCake' => $banh]);
            }
      }
        return redirect()->route('admin.getbanh');
    }

    public function getDeleteImgCakes(Request $request,$id)
    {  
        if ($request->ajax()) {
            $imgDetailed = Anhct::find($id);
            if (!empty($imgDetailed) && File::exists(public_path('upload/imgCakes/'.$imgDetailed->link))) {
                File::delete(public_path('upload/imgCakes/'.$imgDetailed->link));
               $status = $imgDetailed->delete();
               return response()->json(['status' => $status]);
            }
        }
        return redirect()->route('admin.getbanh');
    }
    public function EditPostCake(Request $request,$id){
        if ($request->ajax()) {
            $Cake = Banh::find($id);
            if (!empty($Cake)) {
                if ($request->has('giabanh')) {
                    $rule = [
                        'tenbanh' =>['required',Rule::unique('banh')->ignore($Cake->tenbanh,'tenbanh')],
                        'soluong' => 'required|numeric|min:1',
                        'giabanh' => 'required|numeric|min:1',
                        'makm' => 'required|numeric',
                        'maloai' => 'required|numeric',
                        'mota' => 'required',
                    ];
                }else{
                    $rule = [
                        'tenbanh' =>['required',Rule::unique('banh')->ignore($Cake->tenbanh,'tenbanh')],
                        'soluong' => 'required|numeric|min:1',
                        'makm' => 'required|numeric',
                        'maloai' => 'required|numeric',
                        'mota' => 'required',
                    ];
                }
               
                $mess = [
                    'required' => 'Không được bỏ trống dữ liệu',
                    'tenbanh.unique' => 'Tên bánh tồn tại trông hệ thống',
                    'numeric' => 'Vui lòng nhập số',
                    'min' => 'Gía trị khuyến mãi không nhỏ hơn 1',
                ];
                $validator = Validator::make($request->all(), $rule, $mess);
                $validator->validate();
                $checkImgCake =null;
                $checkImgCakes = null;
                if (!$validator->fails()) {
                    //check file      
                    if($request -> hasFile('hinhanh')){
                        $fileCake = $request->file('hinhanh');
                        $fileExtensionCake = $fileCake->extension();
                        if ($fileExtensionCake != 'jpg' && $fileExtensionCake != 'png' && $fileExtensionCake != 'jpeg') {
                            return response()->json(['status' => false, 'dataErro' => 'File không hợp lệ']);
                        }
                        $checkImgCake =0;
                    }
                    if($request -> hasFile('hinhanhct')){
                        $fileCakes = $request->file('hinhanhct');
                        foreach ($fileCakes as $key => $value) {
                            $fileExtensionCakes = $value->extension();
                            if ($fileExtensionCakes != 'jpg' && $fileExtensionCakes != 'png' && $fileExtensionCakes != 'jpeg') {
                                return response()->json(['status' => false, 'dataErro' => 'File chi tiết không hợp lệ']);
                            }
                        }
                        $checkImgCakes = 0;
                    }  
                    //insert banh          
                    $Cake->tenbanh = $request->tenbanh;
                    $Cake->soluong = $request->soluong;             
                    $Cake->mota = $request->mota;
                    if ($request->has('giabanh')) {
                        $Cake->giabanh = $request->giabanh;
                    }else{
                        $Cake->giabanh = 0;
                    }
                    if ($request->makm != 0) {
                        $Cake->makm = $request->makm;
                    }else{
                        $Cake->makm =null;
                    }
                    $Cake->maloai_id = $request->maloai;
                    //save img Cake
                    if($checkImgCake === 0 && File::exists(public_path('upload/imgCake/'.$Cake->hinhanh))){
                        $nameCake = $fileCake->hashName();      
                        File::delete(public_path('upload/imgCake/'.$Cake->hinhanh));
                        $Cake->hinhanh = $nameCake;
                        $fileCake->move('upload/imgCake', $nameCake);
                    }
                    if ($Cake->save()) {
                        //insert chi tiet anh    
                        if($checkImgCakes === 0){
                            foreach ($fileCakes as $key => $value) {
                                $addDetailedImg = new Anhct();
                                $nameCakes = $value->hashName();
                                $addDetailedImg->link = $nameCakes;
                                $addDetailedImg->mabanh = $Cake->mabanh;
                                $addDetailedImg->save();
                                $value->move('upload/imgCakes', $nameCakes);
                            }
                        }                  
                         return response()->json(['status' => true]);
                    }
                    else{
                        return response()->json(['status' => False,'dataErro' => 'Thêm bánh thất bại']);
                    }
                }
             
            }  
            return response()->json(['status' => False],500);
        }
        return redirect()->route('admin.getbanh');
    }

    public function DeleteCake(Request $request,$id)
    {  
       if ($request->ajax()) {
            $Cake = Banh::find($id)->load('anhct')->toArray();
            $CakeDelete = Banh::find($id);
            if (!empty($Cake) && File::exists(public_path('upload/imgCake/'.$Cake["hinhanh"]))) {             
                File::delete(public_path('upload/imgCake/'.$Cake["hinhanh"]));
                if(!empty($Cake["anhct"])){
                    foreach ($Cake["anhct"] as $key => $value) {
                        if(File::exists(public_path('upload/imgCakes/'.$value["link"]))){
                            File::delete(public_path('upload/imgCakes/'.$value["link"]));
                        }
                    }
                }
               $status = $CakeDelete->delete();
               return response()->json(['status' => $status]);
            }
            return response()->json(['status' => false]);
       }
        return redirect()->route('admin.getbanh');
    }
}
