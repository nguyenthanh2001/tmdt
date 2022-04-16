<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\View\Composers\ProfileComposer;
use Illuminate\Support\Facades\View;
use App\Models\Loaibanh;

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
        
        // View::composer('dangnhap', function ($view) {
        //     $data = 'hello word';
        //         //pass the data to the view
        //         $view->with('data', $data);
        // });
    }
}
