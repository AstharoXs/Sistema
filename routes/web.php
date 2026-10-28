<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/',function(){
    return view('auth.login');
});

Auth::Routes();


//Route::get('/empleados', function () {
    //return view('empleados.index');
//});

//Route::get('empleados/create',[EmpleadoController::class,'create']);

//Empleados
Route::resource('empleados', EmpleadoController::class);
Auth::routes(['register'=>false, 'reset'=>false]);

Route::get('/home', [EmpleadoController::class, 'index'])->name('home');
Route::group(['middleware'=>'auth'], function(){
    Route::get('/',[EmpleadoController::class, 'index'])->name('home');
});

//Categorias
Route::resource('categorias', CategoriaController::class);
Auth::routes(['register'=>false, 'reset'=>false]);

Route::get('/home', [CategoriaController::class, 'index'])->name('home');
Route::group(['middleware'=>'auth'], function(){
    Route::get('/',[CategoriaController::class, 'index'])->name('home');
});

//Productos
Route::resource('productos', ProductoController::class);
Auth::routes(['register'=>false, 'reset'=>false]);

Route::get('/home', [ProductoController::class, 'index'])->name('home');
Route::group(['middleware'=>'auth'], function(){
    Route::get('/',[ProductoController::class, 'index'])->name('home');
});

//Indicadores
Route::get('/indicadores', [DashboardController::class, 'index'])
    ->middleware('auth')
    ->name('indicadores.index');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');