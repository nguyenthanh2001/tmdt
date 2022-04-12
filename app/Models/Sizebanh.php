<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sizebanh extends Model
{
    use HasFactory;
    protected $table ='sizebanh';
    protected $primaryKey = 'masize';
    public $timestamps = false;
}
