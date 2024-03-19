<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\FriendsController;

use Illuminate\Support\Facades\Route;

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


Route::get('/', [AdminController::class, 'home'])->name('home');
Route::get('/game', [AdminController::class, 'parties'])->name('parties');
Route::get('/compte', [AdminController::class, 'profile'])->name('compte');
Route::get('/ranking', [AdminController::class, 'classement'])->name('ranking');
Route::get('/administration', [AdminController::class, 'administration'])->name('administration');

Route::post('/modify-admin/{id}', [AdminController::class, 'changeAdmin'])->name('Modify_admin');
Route::post('/modify-bloque/{id}', [AdminController::class, 'changeBloque'])->name('Modify_bloque');
Route::get('/amis/{userId}', [FriendsController::class, 'showFriends'])->name('user.friends');
Route::post('/amis/ajouter/{userId}', [FriendsController::class, 'ajouterFriends'])->name('userajouter');

Route::get('/search/admin', [SearchController::class, 'search'])->name('search');
Route::get('/search/amis/{userId}', [SearchController::class, 'search_amis'])->name('search_amis');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
