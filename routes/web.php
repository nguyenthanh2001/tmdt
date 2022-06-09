<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Home;
use App\Http\Controllers\Admin\QLloaibanh;
use App\Http\Controllers\Admin\QLkhuyenmai;
use App\Http\Controllers\Admin\QLbanh;
use App\Http\Controllers\Admin\Qlsize;
use App\Http\Controllers\Admin\Qltaikhoan;
use App\Http\Controllers\Admin\Qldonhang;
use App\Http\Controllers\Admin\Thongke;
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

    Route::get('details/{id}','details')->where('id', '[0-9]+')->name('details');

    Route::get('dang-nhap','dangnhap')->middleware('checklogin')->name('dangnhap');

    Route::post('dang-nhap','handle_dangnhap')->middleware('checklogin');

    Route::get('dang-ky','dangky')->middleware('checklogin')->name('dangky');

    Route::post('dang-ky','handle_dangky')->middleware('checklogin');
    Route::get('dang-xuat','dangxuat')->middleware('check_home')->name('dangxuat');
    Route::get('shop','shop')->name('shop');
    Route::post('infoUser','infoUser')->middleware('check_home')->where('id', '[0-9]+')->name('infoUser');
    Route::post('test','CheckDiaChi')->name('check');
    Route::get('shop/category/{id}','Category')->where('id', '[0-9]+')->name('category');

    //check loggin
    Route::post('addCart','AddCart')->middleware('check_home')->name('addCart');
    Route::get('showcart','ShowCart')->middleware('check_home')->name('ShowCart');
    Route::post('UpdateCartQuantity','UpdateCartQuantity')->middleware('check_home')->name('UpdateCartQuantity');
    Route::post('DeleteItem','Delete')->middleware('check_home')->name('DeleteItem');
    Route::get('loaddata','ShowCartAjax')->middleware('check_home')->name('loaddata');
    Route::get('checkout','Checkout')->middleware('check_home')->name('chechout');
    Route::post('handleCheckout','HandleCheckout')->middleware('check_home')->name('HandleCheckout');
    Route::get('Waiting','Waiting')->middleware('check_home')->name('Waiting');
    Route::post('see','See')->middleware('check_home')->name('see');
    Route::post('detelebilldetail','Deletebill')->middleware('check_home')->name('detelebill');
    Route::get('confirmedBill','confirmedBill')->middleware('check_home')->name('confirmedBill');
    Route::get('success','Success')->middleware('check_home')->name('Success');
});

//admin-loại bánh
Route::prefix('admin')->controller(QLloaibanh::class)->middleware('checkAdmin')->name('admin.')->group(function (){ 
    // Route::get('index','index')->name('trangchu_admin');
    Route::get('loai-banh','getloaibanh')->name('getloaibanh');
    Route::post('postloaibanh','postloaibanh');
    Route::get('edit-loaibanh/{id}','get_edit_loaibanh');
    Route::post('edit-loaibanh/{id}','post_edit_loaibanh');
    Route::get('delete-loaibanh/{id}','get_delete_loaibanh');
    
});
//admin-khuyến mãi
Route::prefix('admin')->controller(QLkhuyenmai::class)->middleware('checkAdmin')->name('admin.')->group(function (){
   Route::get('khuyen-mai','Showkhuyenmai')->name('getkhuyenmai');
   Route::post('khuyen-mai','Post_add_khuyenmai');
   Route::get('edit-khuyen-mai/{id}','get_edit_khuyen_mai');
   Route::post('edit-khuyen-mai/{id}','post_edit_khuyen_mai');
   Route::get('delete-khuyen-mai/{id}','get_delete_khuyen_mai');
});
//admin-bánh
Route::prefix('admin')->controller(QLbanh::class)->name('admin.')->middleware('checkAdmin')->group(function (){
    Route::get('banh','Showbanh')->name('getbanh');
    Route::post('addCake','PostAddCake')->name('postAddCake');
    Route::get('editCake/{id}','getEditCake');
    Route::get('deleteImgCakes/{id}','getDeleteImgCakes');
    Route::post('editCake/{id}','EditPostCake')->name('postEditCake');
    Route::get('deleteCake/{id}','DeleteCake');

 });
//admin size
 Route::prefix('admin')->controller(Qlsize::class)->name('admin.')->middleware('checkAdmin')->group(function (){
    Route::get('size','Showsize')->name('getSize');
    Route::post('getName','GetNamevsId');
    Route::post('addSize','AddSizeCake');
    Route::get('getIdSize/{id}','getIdEditSize');
    Route::post('editSize/{id}','postEditSize');
    Route::get('deleteSize/{id}','GetDeleteSize');
    
});
//admin dơn hàng
Route::prefix('admin')->controller(Qldonhang::class)->name('admin.')->middleware('checkAdmin')->group(function (){
    Route::get('qldonhang','Qlbill')->name('Qlbill');  
    Route::get('qldonhangby1','Qlbillby1')->name('Qlbill1'); 
    Route::get('qldonhangby2','Qlbillby2')->name('Qlbill2'); 
    Route::post('updateBillAdmin','OrderReview')->name('updateBillAdmin');
    Route::post('deleteBillAdmin','Deletebill')->name('adminDeteleBill');
    Route::get('showBill/{id}','showBill')->name('showBill'); 


});
//admin thông kê
Route::prefix('admin')->controller(Thongke::class)->name('admin.')->middleware('checkAdmin')->group(function (){
    Route::get('thongke','Thongke')->name('Thongke'); 
    Route::get('TKloai','TKLoai')->name('TKLoai');
    Route::get('TopCake','TopCake')->name('TopCake');
    Route::get('email/{id}','email')->name('email');
    Route::get('Showemail','Showemail')->name('Showemail');
});
Route::prefix('admin')->controller(Qltaikhoan::class)->middleware('checkAdmin')->name('admin.')->group(function (){
    Route::get('taikhoan','ShowTk')->name('getTk');
    Route::post('addTK','addTK')->name('addTK');
    Route::get('deleteTk/{id}','deleteTk')->name('deleteTk');
});

Route::get('test', function () {
   return view('test');
});



