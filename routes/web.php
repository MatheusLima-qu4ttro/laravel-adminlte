<?php

use App\Http\Controllers\Admin\Ajax\AjaxController;
use App\Http\Controllers\Admin\Home\HomeController;
use App\Http\Controllers\Admin\User\UserIndexController;
use App\Http\Controllers\Admin\User\UserListController;
use App\Http\Controllers\Admin\Profile\ProfileIndexController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    Redirect::to('/home')->send();
});

Auth::routes();

// Home
Route::get('/home', [HomeController::class, 'index'])->name('home');

//Users Management
Route::get('user/list', [UserListController::class, 'list'])->name('user.list');
Route::get('user/delete/{id}', [UserListController::class, 'delete'])->name('user.delete');
Route::get('user/index', [UserIndexController::class, 'index'])->name('user.index');
Route::post('user/update', [UserIndexController::class, 'update'])->name('user.update');
Route::post('user/change-image', [UserIndexController::class, 'changeImage'])->name('user.change-image');
Route::post('user/change-password', [UserIndexController::class, 'changePassword'])->name('user.change-password');

// My Account Settings
Route::get('/profile', [ProfileIndexController::class, 'index'])->name('profile');
Route::post('/profile-create', [ProfileIndexController::class, 'create'])->name('profile.create');
Route::post('/change-password', [ProfileIndexController::class, 'changePassword'])->name('profile.change-password');
Route::post('/change-image', [ProfileIndexController::class, 'changeImage'])->name('profile.change-image');



//AJAX
// Rota para buscar estados por país
Route::get('/get-ufs/{id}',  [AjaxController::class, 'getUfsByCountry']);
// Rota para buscar cidades por estado
Route::get('/get-cities/{id}', [AjaxController::class, 'getCitiesByState']);
