<?php

namespace App\Providers;

use App\Models\mainMenus;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\URL;
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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        
        if (Request::server('HTTP_X_FORWARDED_PROTO') === 'https') {
            URL::forceScheme('https');
        }


        View::composer('*', function ($view) {
            $menus = mainMenus::with(['items' => function ($query) {
                $query->where('state', 1);
            }])->where('state', 1)->get();
    
            $view->with('menus', $menus);
        });
    }
}
