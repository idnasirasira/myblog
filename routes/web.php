<?php

use App\Http\Controllers\FrontController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [FrontController::class, 'index'])->name('home');
Route::get('/post/detail/{post}', [FrontController::class, 'detail'])->name('post.detail');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/post/create', [FrontController::class, 'create'])->name('post.create');
    Route::post('/post/create', [FrontController::class, 'store'])->name('post.store');
    Route::get('/post/edit/{post}', [FrontController::class, 'edit'])->name('post.edit');
    Route::post('/post/update/{post}', [FrontController::class, 'update'])->name('post.update');
});
