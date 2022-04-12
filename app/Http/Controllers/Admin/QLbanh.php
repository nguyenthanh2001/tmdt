<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banh;
use App\Models\Sizebanh;
use App\Models\Loaibanh;
use App\Models\Khuyenmai;
use App\Models\Anhct;
use Illuminate\Support\Facades\Validator;
use Nette\Utils\Arrays;
use Illuminate\Support\Facades\Storage;

class QLbanh extends Controller
{
    public function Showbanh(Request $request)
    {
        $banh = Banh::orderBy('mabanh', 'desc')->with(['loaibanh', 'khuyenmai'])->get()->toArray();
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
        $loaibanh = Loaibanh::orderBy('maloai', 'desc')->get();
        $khuyenmai = Khuyenmai::orderBy('giatri', 'desc')->get();
        return view('admin.banh', compact('banh', 'loaibanh', 'khuyenmai'));
    }
    public function PostAddCake(Request $request)
    {
        dd(public_path());
        $checkSize = ($request->has('sizebanh')) ? true : false;
        if ($request->has('sizebanh')) {
            $rule = [
                'tenbanh' => 'required|unique:banh,tenbanh',
                'soluong' => 'required|numeric|min:1',
                'hinhanh' => 'required',
                'hinhanhct.*' => 'required',
                'giabanh' => 'required|numeric|min:1',
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
                $addCake->giabanh = $request->giabanh;
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
                        $addSizeCake->gia = $request->gia[$i];
                        $addSizeCake->save();
                    }
                }
            }
        }
    }
}
