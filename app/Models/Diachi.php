<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diachi extends Model
{
    use HasFactory;
    protected $table ='devvn_xaphuongthitran';
    protected $primaryKey = 'xaid';
    public $timestamps = false;
    public function huyen()
    {
        return $this->belongsTo(Quanquyen::class,'maqh','maqh');
    }
}
