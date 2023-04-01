<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Frontend\HomePageController;
use App\Http\Controllers\Frontend\NoticiasController;
use App\Http\Controllers\Admin\AdminPAgeController;
use App\Http\Controllers\Admin\CategoriasController;
use App\Http\Controllers\Admin\RamasController;
use App\Http\Controllers\Admin\TiposController;
use App\Http\Controllers\Admin\PreparatoriasController;
use App\Http\Controllers\Admin\ParticipantesController;
use App\Http\Controllers\Admin\SedesController;
use App\Http\Controllers\Admin\EventosController;
use App\Http\Controllers\Admin\NoticiasController as AdminNoticiasController;

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
Route::get('op/home/listar', [HomePageController::class, 'listarDataHome'])->name('f.listar');

 /* categorias resultados */
 Route::get('categorias/resultados', [NoticiasController::class, 'ApartadoCategoria'])->name('cat.resultados');

//Route::get('noticia', [NoticiasController::class, 'noticia'])->name('f.noticia');


Route::prefix('panzers')->group(function () {
    Route::get('home', [AdminPAgeController::class, 'index'])->name('p.index');
    
    

    /*ramas*/
    Route::get('ramas', [RamasController::class, 'index'])->name('ram.index');
    Route::get('ramas/listar', [RamasController::class, 'listar'])->name('ram.listar');
    Route::post('ramas/save', [RamasController::class, 'save'])->name('ram.save');


     /*tipos*/
     Route::get('tipos', [TiposController::class, 'index'])->name('tip.index');
     Route::get('tipos/listar', [TiposController::class, 'listar'])->name('tip.listar');
     Route::post('tipos/save', [TiposController::class, 'save'])->name('tip.save');


    /*categorias*/
    Route::get('categorias', [CategoriasController::class, 'index'])->name('cat.index');
    Route::get('categorias/listar', [CategoriasController::class, 'listar'])->name('cat.listar');
    Route::post('categorias/save', [CategoriasController::class, 'save'])->name('cat.save');

    /*preparatorias*/
    Route::get('preparatorias', [PreparatoriasController::class, 'index'])->name('prepa.index');
    Route::get('preparatorias/listar', [PreparatoriasController::class, 'listar'])->name('prepa.listar');
    Route::post('preparatorias/save', [PreparatoriasController::class, 'save'])->name('prepa.save');


    /*participantes*/
    Route::get('participantes', [ParticipantesController::class, 'index'])->name('part.index');
    Route::get('participantes/listar', [ParticipantesController::class, 'listar'])->name('part.listar');
    Route::post('participantes/save', [ParticipantesController::class, 'save'])->name('part.save');


    /*sedes */
    Route::get('sedes', [SedesController::class, 'index'])->name('sed.index');
    Route::get('sedes/listar', [SedesController::class, 'listar'])->name('sed.listar');
    Route::post('sedes/save', [SedesController::class, 'save'])->name('sed.save');


    /*eventos */
    Route::get('eventos', [EventosController::class, 'index'])->name('ev.index');
    Route::get('eventos/listar', [EventosController::class, 'listar'])->name('ev.listar');
    Route::post('eventos/save', [EventosController::class, 'save'])->name('ev.save');


    /*noticias */
    Route::get('noticias', [AdminNoticiasController::class, 'index'])->name('not.index');
    Route::get('noticias/listar', [AdmninNoticiasController::class, 'listar'])->name('not.listar');
    Route::post('noticias/save', [AdminNoticiasController::class, 'save'])->name('not.save');


   


});