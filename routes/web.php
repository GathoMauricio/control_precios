<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (\Auth::check()) {
        return redirect()->route('registros');
    } else {
        return view('auth.login');
    }
});
\Auth::routes(['register' => false, 'reset' => false, 'verify' => false]);
Route::get('/home', [App\Http\Controllers\RegistroController::class, 'index'])->name('home');
Route::get('/registros', [App\Http\Controllers\RegistroController::class, 'index'])->name('registros');
Route::get('/registros/show/{id}', [App\Http\Controllers\RegistroController::class, 'show'])->name('/registros/show');
Route::post('/registros/store', [App\Http\Controllers\RegistroController::class, 'store'])->name('/registros/store');
Route::get('/registros/edit/{id}', [App\Http\Controllers\RegistroController::class, 'edit'])->name('/registros/edit');
Route::delete('/registros/destroy/{id}', [App\Http\Controllers\RegistroController::class, 'destroy'])->name('/registros/destroy');
Route::put('/registros/cerrar/{id}', [App\Http\Controllers\RegistroController::class, 'cerrar'])->name('/registros/cerrar');

Route::get('productos', [App\Http\Controllers\ProductoController::class, 'index'])->name('productos.index');
Route::get('productos/create', [App\Http\Controllers\ProductoController::class, 'create'])->name('productos.create');
Route::get('productos/edit/{producto}', [App\Http\Controllers\ProductoController::class, 'edit'])->name('productos.edit');
Route::post('productos/store', [App\Http\Controllers\ProductoController::class, 'store'])->name('productos/store');
Route::delete('productos/{producto}', [App\Http\Controllers\ProductoController::class, 'destroy'])->name('productos.destroy');

Route::post('unidades/store', [App\Http\Controllers\UnidadController::class, 'store'])->name('unidades/store');

Route::get('proveedor', [App\Http\Controllers\ProveedorController::class, 'index'])->name('proveedor');
Route::post('proveedor/store', [App\Http\Controllers\ProveedorController::class, 'store'])->name('proveedor/store');

Route::post('/cotizacion/store', [App\Http\Controllers\CotizacionController::class, 'store'])->name('/cotizacion/store');
Route::delete('/cotizacion/destroy/{id}', [App\Http\Controllers\CotizacionController::class, 'destroy'])->name('/cotizacion/destroy');

Route::get('users', [App\Http\Controllers\UserController::class, 'index'])->name('users.index');
Route::get('users/create', [App\Http\Controllers\UserController::class, 'create'])->name('users.create');
Route::post('users', [App\Http\Controllers\UserController::class, 'store'])->name('users.store');
Route::get('users/{user}/edit', [App\Http\Controllers\UserController::class, 'edit'])->name('users.edit');
Route::put('users/{user}', [App\Http\Controllers\UserController::class, 'update'])->name('users.update');
Route::delete('users/{user}', [App\Http\Controllers\UserController::class, 'destroy'])->name('users.destroy');
Route::put('update_password/{user}', [App\Http\Controllers\UserController::class, 'updatePassword'])->name('users.update_password');
