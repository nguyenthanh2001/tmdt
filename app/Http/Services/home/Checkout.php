<?php

namespace App\Http\Services\home;

use App\Models\Sizebanh;
use App\Models\Banh;
use App\Models\Diachi;
use App\Models\Hoadon;
use App\Models\CThoadon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
class Checkout
{
    public function ShowNameAddress()
    {
        $name = Diachi::find(Auth::user()->xaid)->load('huyen', 'huyen.thanhpho');
        return $name;
    }
    public function addBill($request)
    {
        $bill = new Hoadon();
        $bill->users_id = Auth::user()->id;
        $bill->created_at=Carbon::now();
        $bill->xa_id=Auth::user()->xaid;
        $bill->diachi=Auth::user()->diachi;
        if (!empty($request->note)) {
            $bill->note =$request->note;
        }
        $bill->save();
        return $bill->mahd;
    }
    public function addBillDetail($Cart,$idhd)
    {
        foreach ($Cart as $key => $value) {
            $billDetail = new CThoadon();
            $billDetail->banh_id = $value['mabanh'];
            $billDetail->hoadon_id =$idhd;
            $billDetail->soluong =$value['soluongmua'];
            $billDetail->gia =$value['gia'];
            $billDetail->tonggia =$value['tonggia'];
            if (empty($value['sizebanh'])) {
                $billDetail->masize =null;
            }
            else{
                $billDetail->masize =$value['masize'];
            }
            $product = Banh::find($value['mabanh']);
            $product->soluong =  $product->soluong - $value['soluongmua'];
            $product->save();
            $billDetail->save();

        }
        return true;
    }
    public function checkNumberCar($Cart)
    {
        $check = true;
        foreach ($Cart as $key => $value) {
            $product =  Banh::find($value['mabanh']);
            if($value['soluongmua'] > $product->soluong){
                return false;
            }
        }
        return $check;
    }
}
