<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\GlobalDataController;

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
        // Используем view composer для передачи данных всем представлениям
        View::composer('*', function ($view) {
            $view->with('services', GlobalDataController::getGlobalData());
        });
    }
}
