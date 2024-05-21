<?php

use App\Http\Controllers\Admin\Ajax\AjaxController;
use App\Http\Controllers\Admin\Dashboard\DashboardIndexController;
use App\Http\Controllers\Admin\User\UserIndexController;
use App\Http\Controllers\Admin\User\UserListController;
use App\Http\Controllers\Admin\Profile\ProfileIndexController;
use App\Http\Controllers\CreateCompany\CreateCompanyIndexController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;

//cria uma rota sem autenticação
Route::get('/create-company', [CreateCompanyIndexController::class, 'index'])->name('create-company.index');


Route::get('/', function () {
    Redirect::to('/dashboard')->send();
});

Auth::routes();

// Home
Route::get('admin/dashboard', [DashboardIndexController::class, 'index'])->name('dashboard');

//Users Management
Route::get('admin/user/list', [UserListController::class, 'list'])->name('user.list');
Route::get('admin/user/delete/{id}', [UserListController::class, 'delete'])->name('user.delete');
Route::get('admin/user/index', [UserIndexController::class, 'index'])->name('user.index');
Route::post('admin/user/create', [UserIndexController::class, 'create'])->name('user.create');
Route::post('admin/user/update', [UserIndexController::class, 'update'])->name('user.update');
Route::post('admin/user/change-image', [UserIndexController::class, 'changeImage'])->name('user.change-image');
Route::post('admin/user/change-password', [UserIndexController::class, 'changePassword'])->name('user.change-password');

// My Account Settings
Route::get('admin/profile', [ProfileIndexController::class, 'index'])->name('profile');
Route::post('admin/profile-create', [ProfileIndexController::class, 'create'])->name('profile.create');
Route::post('admin/change-password', [ProfileIndexController::class, 'changePassword'])->name('profile.change-password');
Route::post('admin/change-image', [ProfileIndexController::class, 'changeImage'])->name('profile.change-image');



//AJAX
// Rota para buscar estados por país
Route::get('/get-ufs/{id}',  [AjaxController::class, 'getUfsByCountry']);
// Rota para buscar cidades por estado
Route::get('/get-cities/{id}', [AjaxController::class, 'getCitiesByState']);
