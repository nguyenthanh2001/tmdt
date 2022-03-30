<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\Home;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//trang chu
Route::get('/',[Home::class,'index'])->name('index');
Route::prefix('home')->controller(Home::class)->name('home.')->group(function (){
    Route::get('/','index');
    Route::get('index','index')->name('trangchu');

    Route::get('chi-tiet-san-pham/{id?}','chitietsp')->name('chitietsp');

    Route::get('dang-nhap','dangnhap')->middleware('checklogin')->name('dangnhap');

    Route::post('dang-nhap','handle_dangnhap')->middleware('checklogin');

    Route::get('dang-ky','dangky')->middleware('checklogin')->name('dangky');

    Route::post('dang-ky','handle_dangky')->middleware('checklogin');
    Route::get('dang-xuat','dangxuat')->middleware('check_home')->name('dangxuat');
});

Route::get('index',[Home::class,'index']);
// Route::get('home',function(){
//     return view('home');
// });
Route::get('new',function(){
    return view('new');
});
Route::get('test',[Home::class,'sayhi']);
Route::post('new',[Home::class,'form']);