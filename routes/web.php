<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\MovimientosInventarioController;

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
Route::middleware('auth')->group(function () {
    Route::get('/productos', [ProductoController::class, 'index'])
        ->middleware('rol:administrador,inventario,consulta')
        ->name('productos.index');

    Route::get('/productos/create', [ProductoController::class, 'create'])
        ->middleware('rol:administrador,inventario')
        ->name('productos.create');
    
    Route::post('/productos', [ProductoController::class, 'store'])
        ->middleware('rol:administrador,inventario')
        ->name('productos.store');

    Route::get('/productos/{producto}/edit', [ProductoController::class, 'edit'])
        ->middleware('rol:administrador,inventario')
        ->name('productos.edit');

    Route::put('/productos/{producto}', [ProductoController::class, 'update'])
        ->middleware('rol:administrador,inventario')
        ->name('productos.update');

    Route::delete('/productos/{producto}', [ProductoController::class, 'destroy'])
        ->middleware('rol:administrador,inventario')
        ->name('productos.destroy');
});

//Indicadores
Route::get('/indicadores', [DashboardController::class, 'index'])
    ->middleware('auth')
    ->name('indicadores.index');

//Movimientos
Route::middleware('auth')->group(function () {
    Route::resource('movimientos', MovimientosInventarioController::class)
        ->only(['index', 'create', 'store']);
});

//Ventas
Route::middleware('auth')->group(function () {
    Route::resource('clientes', ClienteController::class)
        ->except(['show']);

    Route::resource('ventas', VentaController::class)
        ->only(['index', 'create', 'store']);
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');