<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\PlantillaController;
use App\Http\Controllers\PlantillaDetalleController;

use Illuminate\Support\Facades\Artisan;
use Livewire\Livewire;

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

// Agrupar rutas protegidas con middleware 'auth'
Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return view('home');
    });

    Route::get('/home', function () {
        return view('home');
    });

    Route::get('/presentacion/{slug?}', function ($slug = null) {
        return view('presentacion', ['slug' => $slug]);
    })->name('presentacion');

    Route::get('/presentacion/{categoriaSlug}/{plantillaSlug}', [PlantillaDetalleController::class, 'show'])->name('plantilla.detalle');


    Route::get('/guardar', function () {
        return redirect()->route('categorias.index'); // Redirigir al CRUD de categorías
    });

    Livewire::setScriptRoute(function($handle) {
        return Route::get('/presentacion_plantillas/public/livewire/livewire.js', $handle);
    });
    
    Livewire::setUpdateRoute(function($handle) {
        return Route::get('/presentacion_plantillas/public/livewire/update', $handle);
    });

    // Rutas de Categorías usando el controlador de recursos
    Route::resource('categorias', CategoriaController::class);
    Route::resource('plantillas', PlantillaController::class);

});

// Rutas de autenticación
Auth::routes(['register' => false]);

//CREAR LINK STORAGE
Route::get('/linkStorage', function () {
    Artisan::call('storage:link');
});