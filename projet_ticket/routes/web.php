<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\FriendsController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\Gamecontroller;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\JenCoursController;


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



Route::get('/game', [Gamecontroller::class, 'showParties'])->name('parties');
Route::get('/game/creerpartie', [Gamecontroller::class, 'creerPartiesvue'])->name('parties.create');
Route::post('/game/creerpartie', [Gamecontroller::class, 'creerParties'])->name('parties.create');
Route::get('/game/{id}/lauch', [Gamecontroller::class, 'lauch'])->name('parties.lauch');
Route::get('/game/{id}/lauchE', [Gamecontroller::class, 'lauchEvent'])->name('parties.lauch.event');

Route::get('/game/{id}', [Gamecontroller::class, 'attente'])->name('parties.attente');
Route::post('/game/{id}/drop', [Gamecontroller::class, 'destroy'])->name('parties.drop');
Route::post('/game/{id}/delete', [Gamecontroller::class, 'boum'])->name('parties.delete');
Route::post('/game/{id}/desti', [Gamecontroller::class, 'desti'])->name('parties.desti');
Route::post('/game/{id}/piochedesti', [Gamecontroller::class, 'piochedesti'])->name('parties.piochedesti');
Route::post('/game/{id}/piochevelo', [Gamecontroller::class, 'piochevelo'])->name('parties.piochevelo');
Route::post('/game/{id}/piochevelopot', [Gamecontroller::class, 'piochevelopot'])->name('parties.piochevelopot');
Route::post('/game/{id}/actualisation', [Gamecontroller::class, 'actualisation'])->name('parties.actualisation');

Route::post('/game/{id}/route', [Gamecontroller::class, 'route'])->name('parties.route');
Route::post('/game/{id}/joueursuivant', [Gamecontroller::class, 'miseAJourJenCours'])->name('parties.joueursuivant');
Route::get('/game/{gameId}/finish', [Gamecontroller::class, 'finish'])->name('parties.finish');
Route::get('/game/{id}/lagame', [Gamecontroller::class, 'lagame'])->name('parties.game');

Route::post('/game/private/{partieID}', [Gamecontroller::class, 'joinPrivateGame'])->name('joingame.private');
Route::get('/game/publique/{partieID}', [Gamecontroller::class, 'joinPubliqueGame'])->name('joingame.publique');

Route::get('/compte', [AdminController::class, 'profile'])->name('compte');
Route::get('/ranking', [AdminController::class, 'classement'])->name('ranking');
Route::get('/administration', [AdminController::class, 'administration'])->name('administration');

Route::get('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
Route::get('/login', [AuthenticatedSessionController::class, 'store'])->name('login');
Route::get('/register', [Connectioncontroller::class, 'register'])->name('register');




Route::post('/modify-admin/{id}', [AdminController::class, 'changeAdmin'])->name('Modify_admin');
Route::post('/modify-bloque/{id}', [AdminController::class, 'changeBloque'])->name('Modify_bloque');
Route::get('/amis/{userId}', [FriendsController::class, 'showFriends'])->name('user.friends');
Route::post('/amis/ajouter/{userId}', [FriendsController::class, 'ajouterFriends'])->name('userajouter');
Route::post('/amis/retirer/{Id}/{userId}', [FriendsController::class, 'retirerFriends'])->name('userretirer');
Route::get('/search/admin', [SearchController::class, 'search'])->name('search');
Route::get('/search/amis/{userId}', [SearchController::class, 'search_amis'])->name('search_amis');
Route::get('/compte/personne', [SearchController::class, 'search_profile'])->name('search_profile');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Auth::routes();

Route::get('/', [App\Http\Controllers\AdminController::class, 'home'])->name('home');
