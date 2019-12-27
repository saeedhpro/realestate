<?php

namespace App\Providers;

use App\Advertise;
use App\Property;
use Illuminate\Support\Facades\Schema;
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

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
//        $proads = Advertise::orderBy('created_at', 'desc')->where('is_pro', '=', true)->take(4)->get();
//        view()->share('proads', $proads);
    }
}
