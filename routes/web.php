<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ContactController as AdminContactController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SecurityController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\VisitController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Middleware\TrackDailyVisit;
use App\Http\Controllers\Public\BlogController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'show'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.attempt');
});

Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth')->name('logout');

Route::middleware(TrackDailyVisit::class)->group(function () {
    Route::get('/', [BlogController::class, 'home'])->name('home');
    Route::get('/posts/{slug}', [BlogController::class, 'showPost'])->name('posts.show');
    Route::get('/categories/{slug}', [BlogController::class, 'showCategory'])->name('categories.show');
    Route::get('/about', [BlogController::class, 'about'])->name('about');
    Route::get('/work', [BlogController::class, 'work'])->name('work');
    Route::get('/contact', [BlogController::class, 'contact'])->name('contact');
    Route::post('/contact', [BlogController::class, 'storeContact'])->name('contact.store');
});

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('categories', CategoryController::class)->except('show');
    Route::resource('posts', PostController::class)->except('show');

    Route::get('/contacts', [AdminContactController::class, 'index'])->name('contacts.index');
    Route::patch('/contacts/{contact}/read', [AdminContactController::class, 'markAsRead'])->name('contacts.read');
    Route::delete('/contacts/{contact}', [AdminContactController::class, 'destroy'])->name('contacts.destroy');

    Route::get('/settings', [SettingController::class, 'edit'])->name('settings.edit');
    Route::put('/settings', [SettingController::class, 'update'])->name('settings.update');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/visits', [VisitController::class, 'index'])->name('visits.index');

    Route::get('/security/password', [SecurityController::class, 'editPassword'])->name('security.password.edit');
    Route::put('/security/password', [SecurityController::class, 'updatePassword'])->name('security.password.update');
});
