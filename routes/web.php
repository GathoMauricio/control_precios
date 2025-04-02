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

Route::post('productos/store', [App\Http\Controllers\ProductoController::class, 'store'])->name('productos/store');

Route::post('proveedor/store', [App\Http\Controllers\ProveedorController::class, 'store'])->name('proveedor/store');

Route::post('/cotizacion/store', [App\Http\Controllers\CotizacionController::class, 'store'])->name('/cotizacion/store');
