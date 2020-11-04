<?php

namespace App\Providers;

use App\rental\Interfaces\BackendRepositoryInterface;
use App\rental\Interfaces\FrontendRepositoryInterface;
use App\rental\Repositories\BackendRepository;
use App\rental\Repositories\FrontendRepository;
use Illuminate\Support\Facades\View;
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
        $this->app->bind(FrontendRepositoryInterface::class, function (){
            return new FrontendRepository();
        });

        $this->app->bind(BackendRepositoryInterface::class, function (){
            return new BackendRepository();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //zeby zmienna $imgTemp byla widoczna w all widokach frontendu
        View::composer('frontend.*', function ($view){

            //with(nazwa zmiennej ktora chce w widoku zdefiniowac, to co chceej zmiennej przypisac - sciezka bezwzgl)
            $view->with('imgTmp', asset('images/imgTmp.jpg'));

        });
    }
}
