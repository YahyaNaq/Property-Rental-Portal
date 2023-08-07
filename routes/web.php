<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\AdminSessionsController;
use App\Http\Controllers\Agent\AgentDashboardController;
use App\Http\Controllers\Agent\AgentProfileController;
use App\Http\Controllers\Agent\AgentRegisterController;
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

Route::middleware(['guest', 'guest:admins', 'guest:agents'])->group(function() {
    Route::get('/login', [SessionsController::class, 'create']);
    Route::post('/login', [SessionsController::class, 'store'])->name('login');

    Route::get('agent/login', [AgentSessionsController::class, 'create'])->name('agent.login');
    Route::post('agent/login', [AgentSessionsController::class, 'store'])->name('agent.store');
    
    Route::get('/admin/login', [AdminSessionsController::class, 'create'])->name('admin.login');
    Route::post('/admin/login', [AdminSessionsController::class, 'store'])->name('admin.store');
    
    Route::get('/register', [RegisterController::class, 'create']);
    Route::post('/register', [RegisterController::class, 'store']);
});

Route::post('/logout', [SessionsController::class, 'destroy'])->middleware('auth');
Route::post('/agent/logout', [AgentSessionsController::class, 'destroy'])->name('agent.logout')->middleware('auth:agents');
Route::post('/admin/logout', [AdminSessionsController::class, 'destroy'])->name('admin.logout')->middleware('auth:admins');

Route::controller(DashboardController::class)->middleware('auth')->group(function(){
    Route::get('/dashboard', 'index');
    Route::get('/dashboard/offers-made', 'offers_list');
    Route::get('/dashboard/offers-accepted', 'offers_accepted_list');
    Route::get('/dashboard/offers-accepted', 'offers_accepted_list');
    Route::post('/dashboard/offers-accepted/select/{id}', 'select_offer')->name('offers.select');
});

Route::middleware('auth:admins')->group(function(){
    Route::get('/agent/register', [AgentRegisterController::class, 'create']);
    Route::post('/agent/register', [AgentRegisterController::class, 'store'])->name('agent.register');

    Route::get('admin/dashboard', [AdminDashboardController::class, 'index']);
    Route::get('admin/dashboard/verify-property', [AdminDashboardController::class, 'verify_properties']);
    Route::post('admin/dashboard/verify-property/verify', [AdminDashboardController::class, 'verify_property'])->name('verify-property');
    Route::post('admin/dashboard/verify-property/reject', [AdminDashboardController::class, 'reject_property'])->name('reject-property');
    Route::post('admin/dashboard/accept-offer/accept', [AdminDashboardController::class, 'accept_offer'])->name('accept-offer');
    Route::post('admin/dashboard/accept-offer/reject', [AdminDashboardController::class, 'reject_offer'])->name('reject-offer');
    Route::get('admin/dashboard/agents', [AdminDashboardController::class, 'agents_list']);
    Route::get('admin/dashboard/rent-offers', [AdminDashboardController::class, 'offers_list']);
    Route::post('admin/dashboard/confirm-password-edit', [AdminDashboardController::class, 'confirm_password_edit'])->name('confirm-password-edit');
});

Route::controller(AgentDashboardController::class)->middleware('auth:agents')->group(function(){
    Route::get('agent/dashboard', 'index');
    Route::get('/agent/dashboard/rent-offers', 'offers_list');
    Route::get('/agent/dashboard/ad-views', 'views_list');
});

Route::middleware('auth.adminagent')->group(function(){
    Route::get('/{username}/properties', [PropertyController::class, 'index']);

    Route::get('/{username}/properties/edit/{id}', [PropertyController::class, 'edit'])->name('properties.edit');
    Route::patch('/{username}/properties/edit/{id}', [PropertyController::class, 'update'])->name('update');
    
    Route::get('/{username}/properties/delete/{id}', [PropertyController::class, 'delete']);
    Route::delete('/{username}/properties/confirm-delete/{id}', [PropertyController::class, 'destroy'])->name('destroy');
});

Route::get('/{username}/properties/{id}', [PropertyController::class, 'show'])->name('properties.show')->where('id', '[0-9]+');

Route::middleware('auth:agents')->group(function(){
    Route::get('/{username}/properties/new', [PropertyController::class, 'create']);
    Route::post('/{username}/properties/new', [PropertyController::class, 'store'])->name('store');
});

Route::middleware('auth')->group(function(){
    Route::get('/{username}/properties/{id}/make-offer', [PropertyController::class, 'createOffer'])->where('id', '[0-9]+');
    Route::post('/{username}/properties/{id}/make-offer', [PropertyController::class, 'storeOffer'])->where('id', '[0-9]+')->name('store-offer');
    
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