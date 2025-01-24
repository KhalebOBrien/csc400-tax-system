<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GrantController;
use App\Http\Controllers\SupportMessageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PersonalFilingController;

Route::get('/', function () {
    return view('welcome');
    // return redirect()->route('login');
});

// Route::get('/foo', function () {
//     Artisan::call('storage:link');
// });

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'is_suspended'
])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/new-grant', [GrantController::class, 'create'])->name('new-grant');
    Route::post('/new-grant', [GrantController::class, 'store'])->name('grant.store');
    Route::get('/grants/{uuid}', [GrantController::class, 'show'])->name('grant.show');
    Route::post('/grants/vproof/{uuid}', [GrantController::class, 'updateVProof'])->name('grant.store-vproof');

    Route::get('/filing/personal', [PersonalFilingController::class, 'index'])->name('filing.personal.index');
    Route::get('/filing/personal/new-record', [PersonalFilingController::class, 'create'])->name('filing.personal.create');

    Route::get('/create-message', [SupportMessageController::class, 'create'])->name('create-message');
    Route::post('/create-message', [SupportMessageController::class, 'store'])->name('message.store');


    Route::middleware(['is_admin'])->group(function () {
        Route::get('/all-messages', [SupportMessageController::class, 'index'])->name('all-messages');

        Route::get('/grants', [GrantController::class, 'index'])->name('grants');
        Route::get('/grants/status/{status}', [GrantController::class, 'index'])->name('grants.byStatus');
        Route::post('/grants/{uuid}', [GrantController::class, 'updateVlink'])->name('grant.store-vlink');
        Route::get('/grants/{uuid}/update-status/{status}', [GrantController::class, 'updateStatus'])->name('grant.update-status');

        Route::get('/users', [UserController::class, 'index'])->name('users');
        Route::get('/users/{uuid}', [UserController::class, 'show'])->name('users.show');
        Route::get('/users/{uuid}/update-status/{status}', [UserController::class, 'updateStatus'])->name('user.update-status');

        Route::get('/admins', [AdminController::class, 'index'])->name('admins');
    });
});
