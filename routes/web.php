<?php

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


Auth::routes();



Route::get('/probar', function () {
    return view('pedido.checkout');
});

//--------Pedido---------
Route::get('/pedido/create', [App\Http\Controllers\PedidoController::class, 'create'])->name('pedido.create');
Route::get('/pedido/store', [App\Http\Controllers\PedidoController::class, 'store'])->name('pedido.store');



//----Carrito------C:\Users\user\Desktop\Laravel\code\ecommerce\app\Http\Controllers\CarritoController.php
Route::get('/carrito/store/{id}', [App\Http\Controllers\CarritoController::class, 'store'])->name('carrito.store');
Route::get('/carrito/update/{id}', [App\Http\Controllers\CarritoController::class, 'update'])->name('carrito.update');
Route::get('/carrito/destroy', [App\Http\Controllers\CarritoController::class, 'destroy'])->name('carrito.destroy');
Route::get('/carrito/removeAll/{id}', [App\Http\Controllers\CarritoController::class, 'removeAll'])->name('carrito.removeAll');
Route::get('/carrito/restore', [App\Http\Controllers\CarritoController::class, 'restore'])->name('carrito.restore');
Route::get('/carrito/show', [App\Http\Controllers\CarritoController::class, 'show'])->name('carrito.show');
Route::get('/carrito/clear', [App\Http\Controllers\CarritoController::class, 'clear'])->name('carrito.clear');

//----Producto------
Route::get('/producto', [App\Http\Controllers\ProductoController::class, 'index'])->name('producto.index');
Route::get('/producto/create', [App\Http\Controllers\ProductoController::class, 'create'])->name('producto.create');
Route::post('/producto/store', [App\Http\Controllers\ProductoController::class, 'store'])->name('producto.store');
Route::get('/producto/edit/{id}', [App\Http\Controllers\ProductoController::class, 'edit'])->name('producto.edit');
Route::post('/producto/update/{id}', [App\Http\Controllers\ProductoController::class, 'update'])->name('producto.update');
Route::get('/producto/show/{id}', [App\Http\Controllers\ProductoController::class, 'show'])->name('producto.show');
Route::get('/producto/destroy/{id}', [App\Http\Controllers\ProductoController::class, 'destroy'])->name('producto.destroy');
Route::get('/producto/filtrar', [App\Http\Controllers\ProductoController::class, 'filtrar'])->name('producto.filtro');


//-------Proveedor-----
Route::post('/proveedor/store', [App\Http\Controllers\ProveedorController::class, 'store'])->name('proveedor.store');


//------Marca-------
Route::post('/marca/store', [App\Http\Controllers\MarcaController::class, 'store'])->name('marca.store');

//------Categoria-------
Route::post('/categoria/store', [App\Http\Controllers\CategoriaController::class, 'store'])->name('categoria.store');
