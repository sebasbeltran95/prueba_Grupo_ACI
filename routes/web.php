<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DueñosController;
use App\Http\Controllers\ProduccionController;
use App\Http\Controllers\PropiedadesController;
use App\Http\Controllers\RastreoController;

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
    return view('inicio');
});

// dueños 
Route::controller(DueñosController::class)->group(function(){
    Route::get('/usuarios','index')->name('usuarios.ver');
    Route::post('/usuariosinsertar', 'store')->name('usuarios.insertar');
    Route::post('/usuariosactualizar', 'update')->name('usuactualizar');
    Route::delete('/usuariosdestroy/{id_usu}', 'destroy')->name('usuarios.destroy');
    Route::post('/usuariosfiltro','filtro_name')->name('usufiltroname');
});

// propiedades
Route::controller(ProduccionController::class)->group(function(){
    Route::get('/produccion','index')->name('produccion.ver');
    Route::post('/produccioninsertar', 'store')->name('produccion.insertar');
    Route::post('/produccionactualizar', 'update')->name('produccionactualizar');
    Route::delete('/producciondestroy/{idProperty}', 'destroy')->name('produccion.destroy');
    Route::post('/produccionfiltro','filtro_name')->name('produccionfiltroname');
});

