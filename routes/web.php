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
Route::get('/',[Home::class,'Index']);
Route::prefix('home')->controller(Home::class)->name('home.')->group(function (){
    Route::get('/','Index');
    Route::get('index','Index')->name('trangchu');
    Route::get('chi-tiet-san-pham/{id?}','chitietsp')->name('chitietsp');
    Route::get('dang-nhap','dangnhap')->name('dangnhap');
    Route::post('dang-nhap','handle_dangnhap');
    Route::get('dang-ky','dangky')->name('dangky');
    Route::post('dang-ky','handle_dangky');
});


// Route::get('home',function(){
//     return view('home');
// });
Route::get('new',function(){
    return view('new');
});

Route::get('test',[Home::class,'sayhi']);

Route::post('new',[Home::class,'form']);