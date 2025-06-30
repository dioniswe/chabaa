<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

use \Illuminate\Support\Facades\View;
use KgBot\LaravelLocalization\Facades\ExportLocalizations as ExportLocalization;

class LocaleViewServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(
            'layouts.neutral-including-app-js', function ($view) {
            return $view->with(
                [
                    'tidings' => ExportLocalization::export()->toFlat(),
                ]
            );
        }
        );
        View::composer(
            'layouts.neutral', function ($view) {
            return $view->with(
                [
                    'tidings' => ExportLocalization::export()->toFlat(),
                ]
            );
        }
        );
    }
}
