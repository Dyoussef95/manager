<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\UserMoodleController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\DependenciaDepartamentoController;
use App\Http\Controllers\EnteOrganismoController;
use App\Http\Controllers\UbicacionController;

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
    return redirect()->route('moodleusers.index');
})->middleware(['auth'])->name('dashboard');

/*Route::get('/', [AuthenticatedSessionController::class, 'create'])
->name('login');
*/

/*Route::get('/', function () {
    return view('welcome');
});*/


Route::get('/moodleusers', [UserMoodleController::class, 'index'])
->middleware(['auth'])->name('moodleusers.index');
Route::get('/moodleusers/create', [UserMoodleController::class, 'create'])
->middleware(['auth'])->name('moodleusers.create');
Route::get('/moodleusers/{moodleuser}/edit', [UserMoodleController::class, 'edit'])
->middleware(['auth'])->name('moodleusers.edit');
Route::get('/moodleusers/{moodleuser}/delete', [UserMoodleController::class, 'destroy'])
->middleware(['auth'])->name('moodleusers.destroy');
Route::post('/moodleusers', [UserMoodleController::class, 'store'])
->middleware(['auth'])->name('moodleusers.store');
Route::patch('/moodleusers/{moodleuser}', [UserMoodleController::class, 'update'])
->middleware(['auth'])->name('moodleusers.update');
Route::post('/moodleusers/multidelete', [UserMoodleController::class, 'multiDestroy'])
->middleware(['auth'])->name('moodleusers.multiDestroy');

Route::get('users', [RegisteredUserController::class, 'index'])
->middleware(['auth'])->name('users');
Route::get('register', [RegisteredUserController::class, 'create'])
->middleware(['auth'])->name('register');
Route::post('register', [RegisteredUserController::class, 'store'])
->middleware(['auth'])->name('users.store');
Route::get('users/{user}/edit', [RegisteredUserController::class, 'edit'])
->middleware(['auth'])->name('users.edit');
Route::delete('users/{user}', [RegisteredUserController::class, 'destroy'])
->middleware(['auth'])->name('users.destroy');
Route::patch('users/{user}', [RegisteredUserController::class, 'update'])
->middleware(['auth'])->name('users.update');

Route::resource('areas', AreaController::class);
Route::resource('dependencias', DependenciaDepartamentoController::class);
Route::resource('entes', EnteOrganismoController::class);
Route::resource('ubicaciones', UbicacionController::class);


Route::get('/dashboard', function () {
    return redirect()->route('moodleusers.index');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
