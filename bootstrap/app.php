<?php

use App\Http\Middleware\EnsureTodoOwner;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Auth\Middleware\RedirectIfAuthenticated;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

// Laravelアプリ全体の起動設定
return Application::configure(basePath: dirname(__DIR__))
    // ルートファイルの読み込み先を設定
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    // ルートで使うミドルウェアのエイリアスを登録
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'auth' => Authenticate::class,
            'guest' => RedirectIfAuthenticated::class,
            'todo.owner' => EnsureTodoOwner::class,
        ]);
    })
    // 例外処理の拡張ポイント
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
