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


        //Compartir el nombre de la vista, {{$view_name}}
        view()->composer('*', function($view){
            $view_name = $view->getName();
            view()->share('view_name', $view_name);
        });


    }
}
