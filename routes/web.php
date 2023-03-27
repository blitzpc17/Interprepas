<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Frontend\HomePageController;
use App\Http\Controllers\Frontend\NoticiasController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', [HomePageController::class, 'index'])->name('f.home');

Route::get('noticia', [NoticiasController::class, 'noticia'])->name('f.noticia');