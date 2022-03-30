<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class TaikhoanModel extends Model
{
    use HasFactory;

    public function addtaikhoan($data){
        return DB::table('taikhoan')->insert($data);
    }
    
    public function dangnhap($data){
        $kq = DB::table('taikhoan')
                ->where('taikhoan',$data['taikhoan'])
                ->get();              
        return $kq;
    }
}
