<?php
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\CampusController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\SniController;
use App\Http\Controllers\CarreraController;
use App\Http\Controllers\CicloController;
use App\Http\Controllers\MateriaController;
use App\Http\Controllers\GradoController;
use App\Http\Controllers\ProfesorController;
use App\Http\Controllers\CuerpoAcademicoController;


use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return to_route('dashboard');
});


Route::middleware('auth','isActive')->group(function () {
    Route::get('/dashboard', fn () => Inertia::render('Dashboard'))->name('dashboard');
    Route::get('/about', fn () => Inertia::render('About'))->name('about');

    Route::get('users', [UserController::class, 'index'])->name('users.index');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::resource('profesor', ProfesorController::class);
    Route::resource('cuerpo_academico', CuerpoAcademicoController::class);
    Route::resource('campus', CampusController::class);
    Route::resource('carreras', CarreraController::class);
    Route::resource('materias', MateriaController::class);
    Route::resource('categorias', CategoriaController::class);
    Route::resource('grados', GradoController::class);
    Route::resource('sni', SniController::class);
    Route::resource('ciclos', CicloController::class);
    
    Route::resource('reporte', ReporteController::class);
    Route::get('generar-reporte', [ReporteController::class, 'reporte'])->name('generar-reporte');
    
});

require __DIR__.'/auth.php';
