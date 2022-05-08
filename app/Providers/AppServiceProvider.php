<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;

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
        Paginator::useBootstrap();

        View::composer('*', function ($view) {
            $menu_kind_list = ['醤油', '塩', '豚骨', '味噌', '鶏白湯', '魚介', '煮干し','つけ麺', 'まぜそば・油そば', '家系', '二郎系', 'その他'];
            $view->with('menu_kind_list', $menu_kind_list);
        });
    }
}
