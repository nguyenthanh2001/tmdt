<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Loaibanh extends Model
{
    use HasFactory;

    protected $table ='loaibanh';
    protected $primaryKey = 'maloai';
    public $timestamps = false;
    public function banh()
    {
        return $this->hasMany(Banh::class,'maloai_id','maloai');
    }
    
}
