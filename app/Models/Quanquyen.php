<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quanquyen extends Model
{
    use HasFactory;
    protected $table ='devvn_quanhuyen';
    protected $primaryKey = 'maqh';
    protected $keyType = 'string';
    public $timestamps = false;
    public function xaphuong()
    {
        return $this->hasMany(Diachi::class,'maqh','maqh');
    }
    public function thanhpho()
    {
        return $this->belongsTo(Thanhpho::class,'matp','matp');
    }
}
