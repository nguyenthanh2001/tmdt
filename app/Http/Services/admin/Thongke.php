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
    public function threeMonthStatistics()
    {
 
        $Statistics = DB::table('hoadon')
        ->join('chitiethd', 'hoadon.mahd', '=', 'chitiethd.hoadon_id')
        ->join('users', 'hoadon.users_id', '=', 'users.id')
        ->select('hoadon.*','users.name',DB::raw('SUM(chitiethd.tonggia) AS tonghoadon'))
        ->whereBetween('hoadon.created_at',[DB::raw('last_day(CURDATE()) + interval 1 day - interval 5 month'),DB::raw('last_day(CURDATE()- interval 1 month)')])
        ->where('hoadon.trangthai',2)
        ->groupBy('hoadon.mahd')
        ->orderBy('hoadon.created_at', 'asc')
        ->get();
        ;
       
        return $Statistics;
    }
    public function Top5UsersBuy()
    {
        $Statistics = DB::table('hoadon')
        ->join('users', 'hoadon.users_id', '=', 'users.id')
        ->select('hoadon.users_id','users.name',DB::raw('count(users_id) as khachquaylai'))
        ->whereBetween('hoadon.created_at',[DB::raw('last_day(CURDATE()) + interval 1 day - interval 5 month'),DB::raw('last_day(CURDATE()- interval 1 month)')])
        ->where('hoadon.trangthai',2)
        ->groupBy('hoadon.users_id')
        ->orderByDesc('khachquaylai')
        ->take(5)
        ->get();
        return $Statistics;

    }
}
?>