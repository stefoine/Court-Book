<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AnnouncementManagementController;
use App\Http\Controllers\Admin\BookingManagementController;
use App\Http\Controllers\Admin\CourtManagementController;
use App\Http\Controllers\Admin\UserManagementController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CourtController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Public landing
Route::get('/', fn () => view('welcome'))->name('home');

// Public courts catalog & announcements
Route::get('/courts', [CourtController::class, 'index'])->name('courts.index');
Route::get('/courts/{court}', [CourtController::class, 'show'])->name('courts.show');
Route::get('/announcements', [AnnouncementController::class, 'index'])->name('announcements.index');

/* -------------------- GUEST AUTH ROUTES -------------------- */
Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');
    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
    Route::post('reset-password', [NewPasswordController::class, 'store'])->name('password.store');
});

Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')->name('logout');

/* -------------------- AUTHENTICATED USER -------------------- */
Route::middleware(['auth', 'not.banned'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'password'])->name('profile.password');

    // Bookings (resource + custom cancel)
    Route::resource('bookings', BookingController::class);
    Route::post('bookings/{booking}/cancel', [BookingController::class, 'cancel'])->name('bookings.cancel');
});

/* -------------------- ADMIN -------------------- */
Route::middleware(['auth', 'not.banned', 'admin'])
    ->prefix('admin')->name('admin.')
    ->group(function () {
        Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('/reports', [AdminController::class, 'reports'])->name('reports');

        Route::resource('courts', CourtManagementController::class)->except(['show']);

        Route::get('bookings', [BookingManagementController::class, 'index'])->name('bookings.index');
        Route::get('bookings/{booking}', [BookingManagementController::class, 'show'])->name('bookings.show');
        Route::post('bookings/{booking}/approve',  [BookingManagementController::class, 'approve'])->name('bookings.approve');
        Route::post('bookings/{booking}/reject',   [BookingManagementController::class, 'reject'])->name('bookings.reject');
        Route::post('bookings/{booking}/complete', [BookingManagementController::class, 'complete'])->name('bookings.complete');
        Route::delete('bookings/{booking}',        [BookingManagementController::class, 'destroy'])->name('bookings.destroy');

        Route::get('users', [UserManagementController::class, 'index'])->name('users.index');
        Route::post('users/{user}/toggle-ban', [UserManagementController::class, 'toggleBan'])->name('users.toggleBan');
        Route::post('users/{user}/role',       [UserManagementController::class, 'changeRole'])->name('users.changeRole');

        Route::resource('announcements', AnnouncementManagementController::class)->except(['show']);
    });
