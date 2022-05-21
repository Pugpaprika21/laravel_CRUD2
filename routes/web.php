<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Auth\UsersControllor;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

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
    return view('index');
});

Route::post('/login', [LoginController::class, 'login'])->name('login.page');

Route::get('/register', [LoginController::class, 'register'])->name('register.page');

Route::post('/register', [LoginController::class, 'store_register'])->name('store.register');

Route::get('/admin-page', [AdminController::class, 'admin_page']);

Route::get('/displayUser', [AdminController::class, 'displayUsers']);

Route::get('/edit-users/{id}', [AdminController::class, 'edit_user']);

Route::post('/add-users', [AdminController::class, 'addUser']);

Route::post('/update-users', [AdminController::class, 'update_users']);

Route::get('/dalete-users/{id}', [AdminController::class, 'dalete_users']); 

Route::get('/admin-logout/{id}', [AdminController::class, 'logout']);

Route::get('/user-page', [UsersControllor::class, 'users_page']);

Route::get('/profile-page', [UsersControllor::class, 'getUsers_profile']);

Route::post('/update-profile', [UsersControllor::class, 'update_profile']);

Route::get('/user-logout/{id}', [UsersControllor::class, 'user_logout']);