<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CThoadon extends Model
{
    use HasFactory;
    protected $table ='chitiethd';
    protected $primaryKey = 'macthd';
    public $timestamps = false;
    public function banh()
    {
        return $this->belongsTo(Banh::class,'banh_id','mabanh');
    }
    public function size()
    {
        return $this->belongsTo(Sizebanh::class,'masize','masize');
    }
}
