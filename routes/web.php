<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use App\Models\Property;
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
    Route::get('/{id}', 'show')->where('id', '[0-9]+');
    Route::get('/{id}/Photos', 'show')->where('id', '[0-9]+');
    Route::get('/{id}/Contact', 'show')->where('id', '[0-9]+');
});

Route::controller(DashboardController::class)->middleware('auth')->group(function(){
    Route::get('/dashboard', 'index');
    
    Route::get('dashboard/analytics', 'indexAnalytics');

    Route::get('/dashboard/add-a-new-property', 'create');
    Route::post('/dashboard/add-a-new-property','store')->name('store');

    Route::get('/dashboard/edit-a-property/{id}', 'edit');
    Route::patch('/dashboard/edit-a-property/{id}', 'update')->name('update');
    
    Route::get('/dashboard/delete-a-property/{id}', 'delete');
    Route::delete('/dashboard/confirm-delete-property/{id}', 'destroy')->name('destroy');
    
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