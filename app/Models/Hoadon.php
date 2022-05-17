<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Hoadon extends Model
{
    use HasFactory;
    protected $table ='hoadon';
    protected $primaryKey = 'mahd';
    public $timestamps = false;
    public function cthoadon()
    {
        return $this->hasMany(CThoadon::class,'hoadon_id','mahd');
    }
    public function user()
    {
        return $this->belongsTo(User::class,'users_id','id');
    }
}
