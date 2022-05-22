<?php
namespace App\Http\Services\admin;

use App\Models\CThoadon;
use App\Models\Loaibanh;
use Illuminate\Support\Facades\DB; 
class Thongke
{
     public function LoaiCake()
    {
     $loaiCake = Loaibanh::with('banh')->get();
     return $loaiCake;
    }
    public function TopCake()
    {
    //  DB::enableQueryLog();
    //  dd(DB::getQueryLog());
     $Topcake = CThoadon::with('banh')
     ->select('banh_id',DB::raw("SUM(`soluong`) as Tongsoluong"))
     ->groupBy('banh_id') 
     ->orderByDesc('Tongsoluong')
     ->take(5)
     ->get();
     return $Topcake;
    }
}
?>