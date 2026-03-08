<?php

namespace App\Providers;

use App\Services\TodoDeadlineService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Todo期限判定サービスをコンテナへ登録
        $this->app->bind(TodoDeadlineService::class, TodoDeadlineService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
