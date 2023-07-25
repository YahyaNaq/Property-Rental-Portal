<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PropertyController;
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

Route::controller(PropertyController::class)->middleware('auth')->group(function(){
    Route::get('/{username}/properties', 'index');
    
    Route::get('/{username}/properties/{id}', 'show')->name('properties.show')->where('id', '[0-9]+');
    // Route::get('/{id}/Photos', 'show')->where('id', '[0-9]+');
    // Route::get('/{id}/Contact', 'show')->where('id', '[0-9]+');

    Route::get('/{username}/properties/new', 'create');
    Route::post('/{username}/properties/new','store')->name('store');

    Route::get('/{username}/properties/edit/{id}', 'edit');
    Route::patch('/{username}/properties/edit/{id}', 'update')->name('update');
    
    Route::get('/{username}/properties/delete/{id}', 'delete');
    // Route::get('/{username}/properties/confirm-delete-property/{id}', 'show');
    Route::delete('/{username}/properties/confirm-delete/{id}', 'destroy')->name('destroy');
});

Route::controller(UserController::class)->middleware('auth')->group(function (){
    Route::get('/user/{username}', 'index');
    
    // Route::get('/user/{username}/edit-profile', 'edit');
    // Route::patch('/user/{username}/edit-profile','update')->name('update');

    // Route::get('/user/{username}/edit-profile', 'delete');
    // Route::delete('/user/{username}/edit-profile', 'destroy')->name('destroy');
});

Route::controller(RegisterController::class)->middleware('guest')->group(function (){
    Route::get('/register', 'create');
    Route::post('/register', 'store');
});

Route::get('login', [SessionsController::class, 'create'])->name('login')->middleware('guest');
Route::post('login', [SessionsController::class, 'store'])->middleware('guest');
Route::post('logout', [SessionsController::class, 'destroy'])->middleware('auth');