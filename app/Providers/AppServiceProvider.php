<?php

namespace App\Providers;

use App\Models\licence;
use App\Models\mainMenus;
use Illuminate\Support\Facades\Auth;
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
            $menus = collect(); // Inicializamos una colección vacía por defecto

            if (Auth::check()) {
                $user = Auth::user();

                if ($user->id == 1 && $user->employee_id == 1) {
                    $menus = mainMenus::where('state', 1)
                        ->with(['items' => function ($query) {
                            $query->where('state', 1);
                        }])
                        ->get();
                } else {
                    // Obtener la licencia del usuario actual
                    $licence = licence::where('id_user', $user->id)->where('state', 1)->first();

                    if ($licence) {
                        $menuIds = array_filter(explode(',', $licence->id_menus));
                        $itemIds = array_filter(explode(',', $licence->id_items));

                        $menus = mainMenus::whereIn('id', $menuIds)
                            ->where('state', 1)
                            ->with(['items' => function ($query) use ($itemIds) {
                                $query->whereIn('id', $itemIds)
                                    ->where('state', 1);
                            }])
                            ->get();
                    }
                }
            }

            $view->with('menus', $menus);
        });
    }
}
