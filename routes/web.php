<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\Home;
use App\Http\Controllers\Admin\QLloaibanh;
use App\Http\Controllers\Banh;

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

//admin 
Route::prefix('admin')->controller(QLloaibanh::class)->name('admin.')->group(function (){
    //loại bánh
    Route::get('index','index')->name('trangchu_admin');
    Route::get('loai-banh','getloaibanh')->name('getloaibanh');
    Route::post('postloaibanh','postloaibanh');
    Route::get('edit-loaibanh/{id}','get_edit_loaibanh')->name('get-edit-loaibanh');
    Route::post('edit-loaibanh/{id}','post_edit_loaibanh');
    Route::get('delete-loaibanh/{id}','get_delete_loaibanh');
});
Route::prefix('admin')->controller(Banh::class)->name('admin.')->group(function (){
   // Route::get('trangchu','index');
});


Route::get('new',function(){
    return view('new');
});
Route::get('test',[Home::class,'sayhi']);
Route::post('new',[Home::class,'form']);
