<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thanhpho extends Model
{
    use HasFactory;
    protected $table ='devvn_tinhthanhpho';
    protected $primaryKey = 'matp';
    protected $keyType = 'string';
    public $timestamps = false;
    public function quanhuyen()
    {
        return $this->hasMany(Quanquyen::class,'matp','matp');
    }
}
