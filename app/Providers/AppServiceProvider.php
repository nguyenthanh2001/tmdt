<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\View\Composers\ProfileComposer;
use Illuminate\Support\Facades\View;
use App\Models\Loaibanh;
use App\Http\Services\home\Cart;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $loaibanh = Loaibanh::orderBy('maloai', 'desc')->get();
        View::share('loaibanh', $loaibanh);    
        
        View::composer('block.header', function ($view) {
            if (session()->has('Cart') && Auth::check()) {
               $Data = new Cart();
               $a=session('Cart');
               $itemSeeson = $Data->HandlingSessionCart(session('Cart'));
               $itemCart = $Data->showItemCart($itemSeeson);
            }else{
                $itemCart=null;
            }
            
                $view->with(compact('itemCart'));
        });
    }
}
