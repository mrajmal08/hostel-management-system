<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers as Web;

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

Route::get('/', function () {
    return view('auth/login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

//User routes
Route::get('/logout', [Web\Auth\LoginController::class, 'logout'])->name('logout');
Route::get('/home', [Web\HomeController::class, 'index'])->name('home');
Route::get('/all-users', [Web\HomeController::class, 'all_users'])->name('all.users');
Route::post('/update-users', [Web\HomeController::class, 'update_user'])->name('update.user');
Route::post('/delete-user/{id}', [Web\HomeController::class, 'delete_user'])->name('delete.user');


Route::get('/profile', [Web\StudentController::class, 'profile'])->name('profile');
Route::post('/update-profile', [Web\StudentController::class, 'update_profile'])->name('update.profile');
Route::get('/change-password', [Web\StudentController::class, 'change_password'])->name('change.password');
Route::post('/change-password', [Web\StudentController::class, 'update_password'])->name('update.password');
Route::get('/book-hostel', [Web\StudentController::class, 'book_hostel'])->name('book.hostel');
Route::get('/room-detail', [Web\StudentController::class, 'room_detail'])->name('room.detail');

//Rooms Rotes
Route::get('/ad-room', [Web\RoomController::class, 'index'])->name('ad.room');
Route::post('/create-room', [Web\RoomController::class, 'create_room'])->name('create.room');
Route::get('/all-rooms', [Web\RoomController::class, 'all_rooms'])->name('all.rooms');
Route::post('/update-room', [Web\RoomController::class, 'update_room'])->name('update.room');
Route::get('/delete-room/{id}', [Web\RoomController::class, 'delete_room'])->name('delete.room');

Route::get('/add-course', [Web\CourseController::class, 'index'])->name('add.course');
Route::post('/create-course', [Web\CourseController::class, 'create_course'])->name('create.course');
Route::get('/all-courses', [Web\CourseController::class, 'all_courses'])->name('all.courses');
Route::post('/update-course', [Web\CourseController::class, 'update_course'])->name('update.course');
Route::post('/delete-course/{id}', [Web\CourseController::class, 'delete_course'])->name('delete.course');



