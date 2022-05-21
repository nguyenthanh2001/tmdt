<?php
namespace App\Http\Services\admin;
use App\Models\Loaibanh;
class Thongke
{
     public function LoaiCake()
    {
     $loaiCake = Loaibanh::with('banh')->get();
     return $loaiCake;
    }
}
?>