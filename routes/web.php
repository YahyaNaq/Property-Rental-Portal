<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminSessionsController;
use App\Http\Controllers\Agent\AgentDashboardController;
use App\Http\Controllers\Agent\AgentSessionsController;
use App\Http\Controllers\Agent\PropertyController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
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


Route::controller(HomeController::class)->group(function(){
    Route::get('/', 'index')->name('home');
});

Route::controller(DashboardController::class)->middleware('auth')->group(function(){
    Route::get('/dashboard', 'index');
});

Route::controller(AdminDashboardController::class)->middleware('auth:admins')->group(function(){
    Route::get('admin/dashboard', 'index');
});

Route::controller(AgentDashboardController::class)->middleware('auth:agents')->group(function(){
    Route::get('agent/dashboard', 'index');
});

Route::controller(PropertyController::class)->middleware('auth:agents')->group(function(){
    Route::get('/{username}/properties', 'index');
    
    Route::get('/{username}/properties/{id}', 'show')->name('properties.show')->where('id', '[0-9]+');

    Route::get('/{username}/properties/new', 'create');
    Route::post('/{username}/properties/new','store')->name('store');

    Route::get('/{username}/properties/edit/{id}', 'edit');
    Route::patch('/{username}/properties/edit/{id}', 'update')->name('update');
    
    Route::get('/{username}/properties/delete/{id}', 'delete');
    Route::get('/{username}/properties/confirm-delete-property/{id}', 'show');
    Route::delete('/{username}/properties/confirm-delete/{id}', 'destroy')->name('destroy');
});

Route::controller(ProfileController::class)->group(function (){
    Route::get('/{username}', 'index')->where('username', '[A-Za-z0-9_\-.]+');
    
    // Route::get('/user/{username}/edit-profile', 'edit');
    // Route::patch('/user/{username}/edit-profile','update')->name('update');

    // Route::get('/user/{username}/edit-profile', 'delete');
    // Route::delete('/user/{username}/edit-profile', 'destroy')->name('destroy');
});

Route::controller(RegisterController::class)->middleware('guest')->group(function (){
    Route::get('/register', 'create');
    Route::post('/register', 'store');
});

Route::get('/login', [SessionsController::class, 'create'])->middleware(['guest', 'guest:admins', 'guest:agents'])->name('login');
Route::post('/login', [SessionsController::class, 'store'])->middleware(['guest', 'guest:admins', 'guest:agents']);
Route::post('/logout', [SessionsController::class, 'destroy'])->middleware('auth');

Route::get('agent/login', [AgentSessionsController::class, 'create'])->name('agent.login')->middleware(['guest', 'guest:admins']);
Route::post('agent/login', [AgentSessionsController::class, 'store'])->name('agent.store')->middleware(['guest', 'guest:admins']);
Route::post('agent/logout', [AgentSessionsController::class, 'destroy'])->name('agent.logout')->middleware('auth');

// Do I need to specify the middleware here[->middleware('guest:admins')] if I have  
// mentioned it in this controller class?
Route::controller(AdminSessionsController::class)->group(function (){
    Route::get('/admin/login', 'create')->name('admin.login');
    Route::post('/admin/login', 'store')->name('admin.store');
    Route::get('/admin/logout', 'destroy')->name('admin.logout');
});