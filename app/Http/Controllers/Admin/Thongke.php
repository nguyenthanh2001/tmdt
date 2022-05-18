<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Thongke extends Controller
{
    public function Thongke()
    {
       return view('admin.thongke');
    }
}
