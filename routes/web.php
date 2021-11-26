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
// Clear Website Cache
Route::get('/clear', function(){
    Artisan::call('config:cache');
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    return "Cache is cleared";
});


Route::get('/', function () {
    return view('auth/login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

//User routes
Route::get('/logout', [Web\Auth\LoginController::class, 'logout'])->name('logout');
Route::get('/home', [Web\HomeController::class, 'index'])->name('home');
Route::get('/add-user', [Web\HomeController::class, 'add_user'])->name('add.user');
Route::post('/create-user', [Web\HomeController::class, 'create_user'])->name('create.user');
Route::get('/all-users', [Web\HomeController::class, 'all_users'])->name('all.users');
Route::post('/update-users', [Web\HomeController::class, 'update_user'])->name('update.user');
Route::post('/delete-user/{id}', [Web\HomeController::class, 'delete_user'])->name('delete.user');


Route::get('/manage-student', [Web\HomeController::class, 'manage_student'])->name('manage.student');
Route::post('/assign-manger', [Web\HomeController::class, 'assign_manger'])->name('assign.manger');

//Student Routes
Route::get('/profile', [Web\StudentController::class, 'profile'])->name('profile');
Route::post('/update-profile', [Web\StudentController::class, 'update_profile'])->name('update.profile');
Route::get('/change-password', [Web\StudentController::class, 'change_password'])->name('change.password');
Route::post('/change-password', [Web\StudentController::class, 'update_password'])->name('update.password');
Route::get('/room-detail', [Web\StudentController::class, 'room_detail'])->name('room.detail');

//Rooms Rotes
Route::get('/ad-room', [Web\RoomController::class, 'index'])->name('ad.room');
Route::post('/create-room', [Web\RoomController::class, 'create_room'])->name('create.room');
Route::get('/all-rooms', [Web\RoomController::class, 'all_rooms'])->name('all.rooms');
Route::post('/update-room', [Web\RoomController::class, 'update_room'])->name('update.room');
Route::get('/delete-room/{id}', [Web\RoomController::class, 'delete_room'])->name('delete.room');
Route::post('get-rooms', [Web\RoomController::class, 'get_rooms'])->name('get.rooms');


//manager routes
Route::get('my-rooms', [Web\RoomController::class, 'my_rooms'])->name('my.rooms');
Route::get('my-student', [Web\RoomController::class, 'my_student'])->name('my.student');
Route::get('pay-fees', [Web\RoomController::class, 'pay_fees'])->name('pay.fees');
Route::post('fees-submit', [Web\RoomController::class, 'fees_submit'])->name('fees.submit');
Route::get('fees-status', [Web\RoomController::class, 'fees_status'])->name('fees.status');
Route::post('update-fees-status', [Web\RoomController::class, 'update_fees_status'])->name('update.fees_status');

//Courses Routes
Route::get('/add-course', [Web\CourseController::class, 'index'])->name('add.course');
Route::post('/create-course', [Web\CourseController::class, 'create_course'])->name('create.course');
Route::get('/all-courses', [Web\CourseController::class, 'all_courses'])->name('all.courses');
Route::post('/update-course', [Web\CourseController::class, 'update_course'])->name('update.course');
Route::post('/delete-course/{id}', [Web\CourseController::class, 'delete_course'])->name('delete.course');


// Hostel Booking Route
Route::get('/hostel-booking', [Web\HostelController::class, 'index'])->name('hostel.booking');
Route::post('/create-booking', [Web\HostelController::class, 'create_booking'])->name('create.booking');
Route::get('/add-hostel', [Web\HostelController::class, 'add_hostel'])->name('add.hostel');
Route::post('/create-hostel', [Web\HostelController::class, 'create_hostel'])->name('create.hostel');
Route::get('/show-hostel', [Web\HostelController::class, 'show_hostel'])->name('show.hostel');
Route::post('/update-hostel', [Web\HostelController::class, 'update_hostel'])->name('update.hostel');
Route::get('/delete_hostel/{id}', [Web\HostelController::class, 'delete_hostel'])->name('delete.hostel');



