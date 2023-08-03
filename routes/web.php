<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\AdminSessionsController;
use App\Http\Controllers\Agent\AgentDashboardController;
use App\Http\Controllers\Agent\AgentProfileController;
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


Route::controller(RegisterController::class)->middleware('guest')->group(function (){
    Route::get('/register', 'create');
    Route::post('/register', 'store');
});


Route::controller(DashboardController::class)->middleware('auth')->group(function(){
    Route::get('/dashboard', 'index');
    Route::get('/dashboard/offers-made', 'offers_list');
    Route::get('/dashboard/offers-accepted', 'offers_accepted_list');
    Route::get('/dashboard/offers-accepted', 'offers_accepted_list');
    Route::post('/dashboard/offers-accepted/select/{id}', 'select_offer')->name('offers.select');
});

Route::controller(AdminDashboardController::class)->middleware('auth:admins')->group(function(){
    Route::get('admin/dashboard', 'index');
    Route::get('admin/dashboard/verify-property', 'verify_properties');
    Route::post('admin/dashboard/verify-property/verify', 'verify_property')->name('verify-property');
    Route::post('admin/dashboard/verify-property/reject', 'reject_property')->name('reject-property');
    Route::post('admin/dashboard/accept-offer/accept', 'accept_offer')->name('accept-offer');
    Route::post('admin/dashboard/accept-offer/reject', 'reject_offer')->name('reject-offer');
    Route::get('admin/dashboard/agents', 'agents_list');
    Route::get('admin/dashboard/rent-offers', 'offers_list');
});

Route::controller(AgentDashboardController::class)->middleware('auth:agents')->group(function(){
    Route::get('agent/dashboard', 'index');
    Route::get('/agent/dashboard/rent-offers', 'offers_list');
    Route::get('/agent/dashboard/ad-views', 'views_list');
});

Route::controller(PropertyController::class)->middleware('auth:agents')->group(function(){

    Route::get('/{username}/properties', 'index');
    
    Route::get('/{username}/properties/{id}', 'show')->withoutMiddleware('auth:agents')
                                                        ->name('properties.show')
                                                        ->where('id', '[0-9]+');

    Route::get('/{username}/properties/{id}/make-offer', 'createOffer')->withoutMiddleware('auth:agents')->middleware('auth')->where('id', '[0-9]+');
    Route::post('/{username}/properties/{id}/make-offer', 'storeOffer')->name('store-offer')->withoutMiddleware('auth:agents')->where('id', '[0-9]+');
    
    Route::get('/{username}/properties/new', 'create');
    Route::post('/{username}/properties/new','store')->name('store');
    
    Route::get('/{username}/properties/edit/{id}', 'edit')->withoutMiddleware('auth:agents')->middleware(['auth:admins', 'auth:agents']);
    Route::patch('/{username}/properties/edit/{id}', 'update')->name('update');
    
    Route::get('/{username}/properties/delete/{id}', 'delete');
    Route::get('/{username}/properties/confirm-delete-property/{id}', 'show');
    Route::delete('/{username}/properties/confirm-delete/{id}', 'destroy')->name('destroy');
});


Route::get('/login', [SessionsController::class, 'create'])->middleware(['guest', 'guest:admins', 'guest:agents']);
Route::post('/login', [SessionsController::class, 'store'])->middleware(['guest', 'guest:admins', 'guest:agents'])->name('login');
Route::post('/logout', [SessionsController::class, 'destroy'])->middleware('auth');

Route::get('agent/login', [AgentSessionsController::class, 'create'])->name('agent.login')->middleware(['guest', 'guest:admins']);
Route::post('agent/login', [AgentSessionsController::class, 'store'])->name('agent.store')->middleware(['guest', 'guest:admins']);
Route::post('agent/logout', [AgentSessionsController::class, 'destroy'])->name('agent.logout')->middleware('auth:agents');

Route::controller(AdminSessionsController::class)->group(function (){
    Route::get('/admin/login', 'create')->name('admin.login');
    Route::post('/admin/login', 'store')->name('admin.store');
    Route::post('/admin/logout', 'destroy')->name('admin.logout');
});

Route::controller(ProfileController::class)->group(function (){
    Route::get('/{username}', 'index')->where('username', '[A-Za-z0-9_\-.]+');
});

Route::controller(AdminProfileController::class)->group(function (){
    Route::get('admin/{username}', 'index')->where('username', '[A-Za-z0-9_\-.]+');

});

Route::controller(AgentProfileController::class)->group(function (){
    Route::get('agent/{username}', 'index')->where('username', '[A-Za-z0-9_\-.]+');

});