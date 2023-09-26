<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\TemaPDController;
use App\Http\Controllers\AttendanceController;

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

Route::group(['namespace' => 'App\Http\Controllers'], function () {
    /**
     * Home Routes
     */
    Route::get('/', 'HomeController@index')->name('index');
    Route::get('/success', 'HomeController@success')->name('success');

    /**
     * Login Routes
     */
    Route::get('/login', 'LoginController@show')->name('login.show');
    Route::post('/login', 'LoginController@login')->name('login.perform');

    /**
     * Register Routes
     */
    Route::get('/register', 'RegisterController@show')->name('register.show');
    Route::post('/register', 'RegisterController@register')->name('register.perform');
    Route::get('/attendance', 'AttendanceController@show')->name('attendance.show');
    Route::post('/attendance', 'AttendanceController@register')->name('attendance.perform');

    Route::group(['middleware' => ['auth']], function () {
        /**
         * Logout Routes
         */
        Route::get('/logout', 'LogoutController@perform')->name('logout.perform');

        Route::get('/users/selfedit', [UsersController::class, 'selfedit'])->name('users.selfedit');
        Route::post('/users/update/{id}', [UsersController::class, 'update'])->name('users.update');
    });

    Route::group(['middleware' => ['isAdmin']], function () {
        /**
         * Users Routes
         */
        Route::get('/users', [UsersController::class, 'index'])->name('users.show');
        Route::get('/users/edit/{id}', [UsersController::class, 'edit'])->name('users.edit');
        Route::post('/users/export', [UsersController::class, 'export'])->name('users.export');
        Route::get('/users/changepassword', [UsersController::class, 'changepassword'])->name('users.changepassword');
        Route::post('/users/updatepassword', [UsersController::class, 'updatepassword'])->name('users.updatepassword');
        Route::post('/users', [UsersController::class, 'index'])
            ->name('users.search')
            ->middleware(['NullToBlank']);

        /**
         * Attendance Routes
         */
        Route::get('/attendance/index', [AttendanceController::class, 'index'])->name('attendance.index');
        Route::post('/attendance/export', [AttendanceController::class, 'export'])->name('attendance.export');
        Route::post('/attendance/index', [AttendanceController::class, 'index'])
            ->name('attendance.index')
            ->middleware(['NullToBlank']);

        /**
         * Events Routes
         */
        Route::get('/events', [EventsController::class, 'index'])->name('events.show');
        Route::get('/events/add', [EventsController::class, 'add'])->name('events.add');
        Route::post('/events/create', [EventsController::class, 'create'])->name('events.create');
        Route::get('/events/edit/{id}', [EventsController::class, 'edit'])->name('events.edit');
        Route::post('/events/update/{id}', [EventsController::class, 'update'])->name('events.update');
        Route::post('/events/search', [EventsController::class, 'search'])
            ->name('events.search')
            ->middleware(['NullToBlank']);

        /**
         * Tema PD Routes
         */
        Route::get('/temapd', [TemaPDController::class, 'index'])->name('temapd.show');
        Route::get('/temapd/add', [TemaPDController::class, 'add'])->name('temapd.add');
        Route::post('/temapd/create', [TemaPDController::class, 'create'])->name('temapd.perform');
        Route::get('/temapd/edit/{id}', [TemaPDController::class, 'edit'])->name('temapd.edit');
        Route::post('/temapd/update/{id}', [TemaPDController::class, 'update'])->name('temapd.update');
        Route::post('/temapd/search', [TemaPDController::class, 'search'])
            ->name('temapd.search')
            ->middleware(['NullToBlank']);
    });

    /**
     * 404 Routes
     */
    Route::any('{query}', function () {
        return redirect('/');
    })->where('query', '.*');
});
