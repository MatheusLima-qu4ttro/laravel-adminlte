<?php

use App\Http\Controllers\AjaxController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    Redirect::to('/home')->send();
});

Auth::routes();

// My Account Settings
Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
Route::post('/profile-create', [ProfileController::class, 'create'])->name('profile.create');
Route::post('/change-password', [ProfileController::class, 'changePassword'])->name('profile.change-password');
Route::post('/change-image', [ProfileController::class, 'changeImage'])->name('profile.change-image');

// Home
Route::get('/home', [HomeController::class, 'index'])->name('home');

//AJAX
// Rota para buscar estados por país
Route::get('/get-ufs/{id}',  [AjaxController::class, 'getUfsByCountry']);
// Rota para buscar cidades por estado
Route::get('/get-cities/{id}', [AjaxController::class, 'getCitiesByState']);
