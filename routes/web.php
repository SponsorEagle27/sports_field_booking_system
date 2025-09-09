<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\FavoritesController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\FieldController;

// Public routes
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Authentication routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Booking routes
    Route::get('/booking/search', [BookingController::class, 'search'])->name('booking.search');
    Route::post('/booking/search-fields', [BookingController::class, 'searchFields'])->name('booking.search-fields');
    Route::get('/booking/field/{id}', [BookingController::class, 'showField'])->name('booking.field-details');
    Route::post('/booking/field/{id}/check-availability', [BookingController::class, 'checkAvailability'])->name('booking.check-availability');
    Route::post('/booking/field/{id}/book', [BookingController::class, 'book'])->name('booking.book');
    Route::post('/booking/{booking}/cancel', [BookingController::class, 'cancel'])->name('booking.cancel');
    Route::get('/my-bookings', [BookingController::class, 'myBookings'])->name('booking.my-bookings');
    
    // Favorites routes
    Route::get('/favorites', [FavoritesController::class, 'index'])->name('favorites.index');
    Route::post('/favorites/toggle', [FavoritesController::class, 'toggle'])->name('favorites.toggle');
    Route::post('/favorites/check-status', [FavoritesController::class, 'checkStatus'])->name('favorites.check-status');
    
    // Notifications routes
    Route::get('/notifications', [App\Http\Controllers\NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/{notification}/mark-read', [App\Http\Controllers\NotificationController::class, 'markRead'])->name('notifications.mark-read');
});

// Admin routes
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Admin\AdminController::class, 'dashboard'])->name('admin.dashboard');
    
    // Field management routes
    Route::get('/fields', [App\Http\Controllers\Admin\FieldController::class, 'index'])->name('admin.fields.index');
    Route::get('/fields/create', [App\Http\Controllers\Admin\FieldController::class, 'create'])->name('admin.fields.create');
    Route::post('/fields', [App\Http\Controllers\Admin\FieldController::class, 'store'])->name('admin.fields.store');
    Route::get('/fields/{field}', [App\Http\Controllers\Admin\FieldController::class, 'show'])->name('admin.fields.show');
    Route::get('/fields/{field}/edit', [App\Http\Controllers\Admin\FieldController::class, 'edit'])->name('admin.fields.edit');
    Route::put('/fields/{field}', [App\Http\Controllers\Admin\FieldController::class, 'update'])->name('admin.fields.update');
    Route::delete('/fields/{field}', [App\Http\Controllers\Admin\FieldController::class, 'destroy'])->name('admin.fields.destroy');
    Route::put('/fields/{field}/time-slots', [App\Http\Controllers\Admin\FieldController::class, 'updateTimeSlots'])->name('admin.fields.update-time-slots');

    // Bookings management
    Route::get('/bookings', [App\Http\Controllers\Admin\BookingController::class, 'index'])->name('admin.bookings.index');
    Route::delete('/bookings/{booking}', [App\Http\Controllers\Admin\BookingController::class, 'destroy'])->name('admin.bookings.destroy');

    // Pricing settings
    Route::get('/settings/pricing', [App\Http\Controllers\Admin\SettingsController::class, 'pricing'])->name('admin.settings.pricing');
    Route::post('/settings/pricing', [App\Http\Controllers\Admin\SettingsController::class, 'savePricing'])->name('admin.settings.pricing.save');

    // Users management
    Route::get('/users', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('admin.users.index');
    Route::delete('/users/{user}', [App\Http\Controllers\Admin\UserController::class, 'destroy'])->name('admin.users.destroy');

    // Reports
    Route::get('/reports', [App\Http\Controllers\Admin\ReportsController::class, 'index'])->name('admin.reports.index');
});
