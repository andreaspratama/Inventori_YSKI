<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\TypeController;
use App\Http\Controllers\Admin\AsetsController;

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
    return view('welcome');
});

Route::prefix('admin')->group(function () {
    Route::get('/', [DashboardController::class, 'index']);

    // Route Type
    Route::get('deleteType/{id}', [TypeController::class, 'delete'])->name('delete');
    Route::resource('type', TypeController::class);

    // Route Asets
    // Route::get('deleteType/{id}', [AsetsController::class, 'delete'])->name('delete');
    Route::resource('asets', AsetsController::class);
});