<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;

// トップページ: ログイン状態に応じて遷移先を分岐
Route::get('/', function () {
    return auth()->check()
        ? redirect()->route('todos.index')
        : redirect()->route('login');
});

// 未ログインユーザー向けのログイン画面/ログイン処理
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'create'])->name('login');
    Route::post('/login', [LoginController::class, 'store'])->name('login.store');
});

// ログイン済みユーザーのログアウト処理
Route::post('/logout', [LoginController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

// Todo機能はログイン必須
Route::middleware('auth')->group(function () {
    Route::resource('todos', TodoController::class)
        ->except(['edit', 'update', 'destroy']);

    // 編集・更新・削除は所有者のみ許可
    Route::middleware('todo.owner')->group(function () {
        Route::get('/todos/{todo}/edit', [TodoController::class, 'edit'])->name('todos.edit');
        Route::put('/todos/{todo}', [TodoController::class, 'update'])->name('todos.update');
        Route::delete('/todos/{todo}', [TodoController::class, 'destroy'])->name('todos.destroy');
    });
});
