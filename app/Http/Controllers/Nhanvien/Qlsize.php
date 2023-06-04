<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Banh;
use Illuminate\Http\Request;
use App\Models\Sizebanh;
use Illuminate\Support\Facades\Validator;

class Qlsize extends Controller
{
  
     public function Showsize(Request $request)
    {
        $size =Sizebanh::orderBy('masize', 'desc')->with('banh')->get();
            if ($request->ajax()) {
                $custom  = array();
                foreach ($size as $key => $value) {
                    $custom[$key]['stt'] = $key + 1;
                    $custom[$key]['tensize'] = 'Size '.$value->tensize;
                    $custom[$key]['tenbanh'] = $value->banh->tenbanh;              
                    $custom[$key]['giabanh'] = number_format($value->gia);                   
                    $custom[$key]['btn-sua'] = '
                    <button onclick="EditSize(' . $value->masize . ')" class="btn btn-warning btn-circle btn-sm" data-toggle="modal" data-target="#suasize">
                          <i class="fas fa-edit"></i>
                    </button>';
                    $custom[$key]['btn-xoa'] = '
                    <button onclick="DeleteSize(' . $value->masize . ')" class="btn btn-danger btn-circle btn-sm">
                              <i class="fas fa-trash"></i>
                    </button>
                    ';
                }
                return response()->json(['data' => $custom]);
            }
            return view('admin.sizebanh', compact('size'));
    }

    public function GetNamevsId(Request $request){
        if ($request->ajax()) {
            $nameCake = $request->tenbanh;
            $Cake = Banh::where('giabanh','=',0)
            ->where('tenbanh','like','%'.$nameCake.'%')
            ->select('mabanh','tenbanh')->skip(0)->take(10)->get()->toArray();
            return response()->json(['dataName' => $Cake]);
           // return $a;     
        }
        return response('',404);
    }

    public function AddSizeCake(Request $request){
        if ($request->ajax()) {
            $rule = [
                'tensize' => 'required|numeric|min:1|max:100',
                'mabanh'=>'required|numeric|exists:banh,mabanh',
                'gia'=>'required|numeric',

            ];
            $mess = [
                'required' => 'Không được bỏ trống dữ liệu',
                'mabanh.exists' => 'hải sản không tồn tại',
                'numeric' => 'Vui lòng nhập số',
                'min' => 'Size không nhỏ hơn 1',
                'max' => 'Size khuyến mãi không lớn hơn 100',
            ];
            $validator = Validator::make($request->all(), $rule, $mess);
            $validator->validate();
             if (!$validator->fails()) {
                $Cake = Banh::find($request->mabanh);
                if($Cake->giabanh != 0){
                    return response()->json(['status' => false]);
                }
                $addSize = new Sizebanh;
                $addSize->tensize = $request->tensize;
                $addSize->mabanh = $request->mabanh;
                $addSize->gia = $request->gia.'000';
                $trangthai = $addSize->save();
                return response()->json(['status' => $trangthai]);
            }
        }
        return response('',404);
    }

    public function getIdEditSize($id, Request $request)
    {
        if ($request->ajax()) {
            $Size = Sizebanh::find($id)->load('banh');
            if (!empty($Size)) {
                return response()->json(['dataSize' => $Size]);
            }
        }
        return redirect('',404);
    }

    public function postEditSize(Request $request, $id)
    {
        if ($request->ajax()) {
        $addSize = Sizebanh::find($id);
        $rule = [
            'tensize' => 'required|numeric|min:1|max:100',
            'mabanh'=>'required|numeric|exists:banh,mabanh',
            'gia'=>'required|numeric',

        ];
        $mess = [
            'required' => 'Không được bỏ trống dữ liệu',
            'mabanh.exists' => 'hải sản không tồn tại',
            'numeric' => 'Vui lòng nhập số',
            'min' => 'Size không nhỏ hơn 1',
            'max' => 'Size khuyến mãi không lớn hơn 100',
        ];
        $validator = Validator::make($request->all(), $rule, $mess);
        $validator->validate();
        if (!$validator->fails()) {
            $Cake = Banh::find($request->mabanh);
            if($Cake->giabanh != 0){
                return response()->json(['status' => false]);
            }
            $addSize->tensize = $request->tensize;
            $addSize->mabanh = $request->mabanh;
            $addSize->gia = $request->gia;
            $trangthai = $addSize->save();     
            return response()->json(['status' => $trangthai]);
        }
    }
    return redirect('',404);
    }

    public function GetDeleteSize($id,Request $request)
    {
        if ($request->ajax()) {
        $Size = Sizebanh::find($id);
        if (!empty($Size)) {
            try {
                $status = $Size->delete();
                return response()->json(['status' => $status]);
            } catch (\Throwable $th) {
                return response()->json(['status' => false]);
            }
        }
        return response()->json(['status' => false],500);
    }
    return redirect('',404);

    }
}
