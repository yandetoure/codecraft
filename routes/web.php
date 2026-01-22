<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ServiceController as AdminServiceController;
use App\Http\Controllers\Admin\PackController as AdminPackController;
use App\Http\Controllers\Admin\FeatureController as AdminFeatureController;
use App\Http\Controllers\Admin\ProjectController as AdminProjectController;
use App\Http\Controllers\Admin\AppointmentController as AdminAppointmentController;
use App\Http\Controllers\Admin\SupportController as AdminSupportController;
use App\Http\Controllers\Client\DashboardController as ClientDashboardController;
use App\Http\Controllers\Client\ProjectController as ClientProjectController;
use App\Http\Controllers\Client\SupportController as ClientSupportController;
use App\Http\Controllers\Client\AppointmentController as ClientAppointmentController;

use App\Http\Controllers\Client\PackSelectionController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\WelcomeController;

// Public Routes
Route::get('/', [WelcomeController::class, 'index'])->name('welcome');
Route::get('/features', [WelcomeController::class, 'features'])->name('features.index');

// Auth Routes are defined below


// Admin Routes
Route::middleware(['auth', 'role:super_admin|admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    Route::resource('services', AdminServiceController::class);
    Route::resource('packs', AdminPackController::class);
    Route::resource('features', AdminFeatureController::class);
    Route::resource('appointments', AdminAppointmentController::class);
    Route::post('/appointments/{appointment}/status', [AdminAppointmentController::class, 'updateStatus'])->name('appointments.update-status');

    Route::resource('support', AdminSupportController::class)->only(['index', 'show']);
    Route::post('/support/{ticket}/reply', [AdminSupportController::class, 'reply'])->name('support.reply');
    Route::post('/support/{ticket}/status', [AdminSupportController::class, 'updateStatus'])->name('support.update-status');

    Route::get('/projects', [AdminProjectController::class, 'index'])->name('projects.index');
    Route::get('/projects/{project}', [AdminProjectController::class, 'show'])->name('projects.show');
    Route::post('/projects/{project}/status', [AdminProjectController::class, 'updateStatus'])->name('projects.update-status');
    Route::post('/projects/{project}/generate-quote', [AdminProjectController::class, 'generateQuote'])->name('projects.generate-quote');
    Route::post('/projects/{project}/generate-invoice', [AdminProjectController::class, 'generateInvoice'])->name('projects.generate-invoice');
});

// Client Routes
Route::middleware(['auth', 'role:client'])->prefix('dashboard')->name('client.')->group(function () {
    Route::get('/', [ClientDashboardController::class, 'index'])->name('dashboard');

    Route::get('/projects', [ClientProjectController::class, 'index'])->name('projects.index');
    Route::get('/projects/{project}', [ClientProjectController::class, 'show'])->name('projects.show');
    Route::post('/projects/{project}/configuration', [ClientProjectController::class, 'updateConfiguration'])->name('projects.update-configuration');

    Route::post('/quotes/{quote}/accept', [ClientProjectController::class, 'acceptQuote'])->name('quotes.accept');
    Route::post('/quotes/{quote}/reject', [ClientProjectController::class, 'rejectQuote'])->name('quotes.reject');

    Route::resource('support', ClientSupportController::class);
    Route::post('/support/{ticket}/reply', [ClientSupportController::class, 'reply'])->name('support.reply');

    Route::resource('appointments', ClientAppointmentController::class)->only(['index', 'create', 'store', 'show']);
});

// Pack Selection Flow
Route::get('/packs', [PackSelectionController::class, 'index'])->name('packs.index');
Route::get('/packs/{pack}', [PackSelectionController::class, 'show'])->name('packs.show');
Route::post('/packs/{pack}/order', [PackSelectionController::class, 'order'])->middleware('auth')->name('packs.order');

Auth::routes();


