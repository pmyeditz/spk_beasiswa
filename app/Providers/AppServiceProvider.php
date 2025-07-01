<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use App\Models\Admin;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            if (session()->has('admin_id')) {
                $admin = Admin::find(session('admin_id'));
                $view->with('admin', $admin);
            }
        });
    }
}
