<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Qltaikhoan extends Controller
{
    public function ShowTk(Request $request)
    {
        $Account  =User::where('id','!=', Auth::user()->id)->orderBy('id', 'desc')->get();
        // if ($request->ajax()) {
        //     $custom  = array();
        //     foreach ($size as $key => $value) {
        //         $custom[$key]['stt'] = $key + 1;
        //         $custom[$key]['tensize'] = 'Size '.$value->tensize;
        //         $custom[$key]['tenbanh'] = $value->banh->tenbanh;              
        //         $custom[$key]['giabanh'] = number_format($value->gia);                   
        //         $custom[$key]['btn-sua'] = '
        //         <button onclick="EditSize(' . $value->masize . ')" class="btn btn-warning btn-circle btn-sm" data-toggle="modal" data-target="#suasize">
        //               <i class="fas fa-edit"></i>
        //         </button>';
        //         $custom[$key]['btn-xoa'] = '
        //         <button onclick="DeleteSize(' . $value->masize . ')" class="btn btn-danger btn-circle btn-sm">
        //                   <i class="fas fa-trash"></i>
        //         </button>
        //         ';
        //     }
        //     return response()->json(['data' => $custom]);
        // }
        return view('admin.taikhoan', compact('Account'));
    }
}
