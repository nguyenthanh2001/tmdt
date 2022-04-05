<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class phanquyen extends Model
{
    use HasFactory;
    protected $table ='phanquyen';
    public function us()
    {
        return $this->hasMany(User::class,'phanquyen_id','id');
    }
}
