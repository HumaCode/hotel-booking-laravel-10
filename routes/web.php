<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\TeamController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [UserController::class, 'index']);

Route::get('/dashboard', function () {
    return view('frontend.dashboard.user_dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // profile user
    Route::get('/profile', [UserController::class, 'userProfile'])->name('user.profile');
    Route::post('/profile/store', [UserController::class, 'userProfileStore'])->name('user.profile.store');
    Route::get('/user/change/password', [UserController::class, 'userChangePassword'])->name('user.change.password');
    Route::post('/password/change/store', [UserController::class, 'passwordChangeStore'])->name('password.change.store');
    Route::get('/logout', [UserController::class, 'userLogout'])->name('user.logout');
});

require __DIR__ . '/auth.php';

Route::get('/admin/login', [AdminController::class, 'adminLogin'])->name('admin.login');
Route::get('/admin/forgot-password', [AdminController::class, 'adminForgotPass'])->name('admin.forgot_pass');


// middleware
Route::middleware(['auth', 'roles:admin'])->group(function () {
    // dashboard admin
    Route::get('/admin/dashboard', [AdminController::class, 'adminDashboard'])->name('admin.dashboard');

    // logout admin
    Route::get('/admin/logout', [AdminController::class, 'adminLogout'])->name('admin.logout');

    // profile
    Route::get('/admin/profile', [AdminController::class, 'adminProfile'])->name('admin.profile');
    Route::post('/admin/profile/store', [AdminController::class, 'adminProfileStore'])->name('admin.profile.store');
    Route::get('/admin/change-password', [AdminController::class, 'adminChangePassword'])->name('admin.change.password');
    Route::post('/admin/password/update', [AdminController::class, 'adminPasswordUpdate'])->name('admin.password.update');
});

Route::middleware(['auth', 'roles:admin'])->group(function () {

    // team
    Route::controller(TeamController::class)->group(function () {
        Route::get('/all/team', 'allTeam')->name('all.team');
        Route::get('/add/team', 'addTeam')->name('add.team');
        Route::post('/team/store', 'teamStore')->name('team.store');
    });
});
