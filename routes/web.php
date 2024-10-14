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
})->name('index');

Route::get('login', [AuthenticatedSessionController::class, 'create'])
                ->name('login');

Route::post('login', [AuthenticatedSessionController::class, 'store']);

Route::get('logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');

/*Route::get('/', [AuthenticatedSessionController::class, 'create'])
->name('login');
*/

/*Route::get('/', function () {
    return view('welcome');
});*/


Route::get('/moodleusers', [UserMoodleController::class, 'index'])
->name('moodleusers.index');
Route::get('/moodleusers/create', [UserMoodleController::class, 'create'])
->name('moodleusers.create');
Route::get('/moodleusers/{moodleuser}/edit', [UserMoodleController::class, 'edit'])
->name('moodleusers.edit');
Route::get('/moodleusers/{moodleuser}/delete', [UserMoodleController::class, 'destroy'])
->name('moodleusers.destroy');
Route::post('/moodleusers', [UserMoodleController::class, 'store'])
->name('moodleusers.store');
Route::patch('/moodleusers/{moodleuser}', [UserMoodleController::class, 'update'])
->name('moodleusers.update');
Route::post('/moodleusers/multidelete', [UserMoodleController::class, 'multiDestroy'])
->name('moodleusers.multiDestroy');

Route::get('users', [RegisteredUserController::class, 'index'])
->name('users');
Route::get('register', [RegisteredUserController::class, 'create'])
->name('register');
Route::post('register', [RegisteredUserController::class, 'store'])
->name('users.store');
Route::get('users/{user}/edit', [RegisteredUserController::class, 'edit'])
->name('users.edit');
Route::delete('users/{user}', [RegisteredUserController::class, 'destroy'])
->name('users.destroy');
Route::patch('users/{user}', [RegisteredUserController::class, 'update'])
->name('users.update');

Route::resource('areas', AreaController::class);
Route::resource('dependencias', DependenciaDepartamentoController::class);
Route::resource('entes', EnteOrganismoController::class);
Route::resource('ubicaciones', UbicacionController::class);


Route::get('/dashboard', function () {
    return redirect()->route('moodleusers.index');
})->name('dashboard');

//require __DIR__.'/auth.php';
