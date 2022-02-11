<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

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

        // dd(getNotifications(1));


        // if(session()->has('LoggedUser')){
        //     session()->pull('LoggedUser');
        //     dd('ses available');
        // }else{
        //     dd('not available');

        // }


    // dd(session('LoggedUser')->id);
    // die();
        // dd(session('LoggedUser')->id);
        // getNotifications();
    }
}
