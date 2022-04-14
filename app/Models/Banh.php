<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banh extends Model
{
    use HasFactory;
    protected $table ='banh';
    protected $primaryKey = 'mabanh';
    public $timestamps = false;
    public function loaibanh()
    {
        return $this->belongsTo(Loaibanh::class,'maloai_id','maloai');
    }
    public function khuyenmai()
    {
        return $this->belongsTo(Khuyenmai::class,'makm','makm');
    }
    public function anhct()
    {
        return $this->hasMany(Anhct::class,'mabanh','mabanh');
    }
    public function sizebanh()
    {
        return $this->hasMany(Sizebanh::class,'mabanh','mabanh');
    }

}
