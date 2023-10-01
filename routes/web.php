<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\RoomController;
use App\Http\Controllers\Backend\RoomTypeController;
use App\Http\Controllers\Backend\TeamController;
use App\Http\Controllers\Frontend\BookingController;
use App\Http\Controllers\Frontend\FrontendController;
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
        Route::get('/edit/team/{id}', 'editTeam')->name('edit.team');
        Route::post('/team/update', 'teamUpdate')->name('team.update');
        Route::get('/team/delete/{id}', 'teamDelete')->name('delete.team');
    });

    // book area
    Route::controller(TeamController::class)->group(function () {
        Route::get('/book/area', 'bookArea')->name('book.area');
        Route::post('/book/area/update', 'bookAreaUpdate')->name('book.area.update');
    });

    // roomtype
    Route::controller(RoomTypeController::class)->group(function () {
        Route::get('/room/type/list', 'roomTypeList')->name('room.type.list');
        Route::get('/add/room/type', 'addRoomType')->name('add.room.type');
        Route::post('/room/type/store', 'roomTypeStore')->name('room.type.store');
    });

    // room
    Route::controller(RoomController::class)->group(function () {
        Route::get('/edit/room/{id}', 'editRoom')->name('edit.room');
        Route::post('/update/room/{id}', 'updateRoom')->name('update.room');
        Route::get('/multi/image/delete/{id}', 'multiImageDelete')->name('multi.image.delete');

        // room no
        Route::post('/store/room/no/{id}', 'storeRoomNo')->name('store.room.no');
        Route::get('/edit/room/no/{id}', 'editRoomNo')->name('edit.roomno');
        Route::post('/update/room/no/{id}', 'updateRoomNo')->name('update.roomno');
        Route::get('/delete/room/no/{id}', 'deleteRoomNo')->name('delete.roomno');
        Route::get('/delete/room/{id}', 'deleteRoom')->name('delete.room');
    });

    // admin booking route
    Route::controller(BookingController::class)->group(function () {
        Route::get('/booking/list', 'bookingList')->name('booking.list');
        Route::get('/booking/edit/{id}', 'editBooking')->name('edit.booking');
    });
});


// frontend controller
Route::controller(FrontendController::class)->group(function () {

    // rooms
    Route::get('/rooms', 'allFrontendRoomList')->name('froom.all');
    Route::get('/room/details/{id}', 'roomDetailPage');
    Route::get('/bookings', 'bookingSearch')->name('booking.search');
    Route::get('/search/room/details/{id}', 'searchRoomDetails')->name('search_room_details');
    Route::get('/check_room_availability', 'checkRoomAvailability')->name('check_room_availability');
});


// midleware user
Route::middleware(['auth'])->group(function () {

    // checkout
    Route::controller(BookingController::class)->group(function () {

        Route::get('/checkout', 'checkout')->name('checkout');
        Route::post('/booking/store/', 'bookingStore')->name('user_booking_store');
        Route::post('/checkout/store/', 'checkoutStore')->name('checkout.store');
        Route::match(['get', 'post'], '/stripe_pay', [BookingController::class, 'stripe_pay'])->name('stripe_pay');

        // booking update
        Route::post('/update/booking/status/{id}', 'updateBookingStatus')->name('update.booking.status');
        Route::post('/update/booking/{id}', 'updateBooking')->name('update.booking');

        // assign route
        Route::get('/assign/room/{id}', 'assignRoom')->name('assign_room');
        Route::get('/assign/room/store/{booking_id}/{room_number_id}', 'assignRoomStore')->name('assign_room_store');
    });
});
