<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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

Route::get('/', function () {
    return view('index');
});

Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');

Route::get('/test', [HomeController::class, 'index'])->name('index');

Route::get('/task_one', [HomeController::class, 'task_one'])->name('task_one');

Route::get('/task_two', [HomeController::class, 'task_two'])->name('task_two');
