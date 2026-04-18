<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use App\Models\Setting;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Paginator::defaultView('pagination.custom');
        Paginator::defaultSimpleView('pagination.simple');

        try {
            $settings = Setting::pluck('value', 'key')->toArray();
        } catch (\Exception $e) {
            $settings = [];
        }
        View::share('settings', $settings);

        View::composer('layouts.app', function ($view) {
            try {
                $count = (int) Setting::get('visitor_count', 0);
                if (!request()->is('admin/*') && !session()->has('visited')) {
                    $count++;
                    Setting::set('visitor_count', $count);
                    session()->put('visited', true);
                }
                $view->with('visitor_count', $count);
            } catch (\Exception $e) {
                $view->with('visitor_count', 0);
            }
        });
    }
}
