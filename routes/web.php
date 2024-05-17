<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ProfileController;
use DragonCode\Contracts\Cashier\Auth\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Article;
use Illuminate\Support\Facades\Auth as FacadesAuth;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::controller(ArticleController::class)->group(function(){
    // 글쓰기 화면
    Route::get('/articles/create', 'create')->name('articles.create');
    //글 쓰기 
    Route::post('/articles', 'store')->name('articles.store');
    //글 목록 조회
    Route::get('articles', 'index')->name('articles.index');
    //글 상세 조회
    Route::get('articles/{article}', 'show')->name('articles.show');
    //글 수정페이지 조회
    Route::get('articles/{article}/edit', 'edit')->name('articles.edit');
    //글 수정 
    Route::put('articles/{article}', 'update')->name('articles.update');
    //글 삭제
    Route::delete('articles/{article}', 'delete')->name('aritcles.delete');
});
require __DIR__.'/auth.php';
