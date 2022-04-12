<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anhct extends Model
{
    use HasFactory;

    protected $table ='anhct';
    protected $primaryKey = 'maanhct';
    public $timestamps = false;
}
