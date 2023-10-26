<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PopupController;
use App\Http\Controllers\GeneratorController;

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

Route::get('/', [PopupController::class, 'index'])->name('home');

Route::resource('popup', PopupController::class);
Route::post('/request', [PopupController::class, 'storeShows'])->middleware('cors');
