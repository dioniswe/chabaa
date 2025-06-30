<?php

namespace App\Providers;

use App\Model\Config;
use Illuminate\Support\Arr;
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
        if(\Schema::hasTable('config')) {
            $arr = \App\Model\Config::all(['config', 'value'])->toArray();
            $arr = Arr::pluck($arr, 'value', 'config');
        } else {
          $arr = [];
        }
        view()->share('config', $arr);
    }
}
