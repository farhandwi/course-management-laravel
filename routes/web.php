<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\Admin\CourseController as CourseAdminController;
use App\Http\Controllers\Admin\DivisionController;
use App\Http\Controllers\Admin\CourseContentController;
use App\Http\Controllers\Admin\UserController as UserAdminController;

Route::get('/user/courses', [CourseController::class, 'index'])->name('user.courses.index');

Route::middleware('guest')->group(function () {
    Route::get('/login', [UserController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [UserController::class, 'login']);
    Route::get('/register', [UserController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [UserController::class, 'register']);
});

Route::post('/logout', [UserController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'user'])->group(function () {
    Route::get('/mycourse', [CourseController::class, 'myCourses'])->name('courses.my');
    Route::post('/courses/{course}/register', [CourseController::class, 'registerCourse'])->name('courses.register');
    Route::get('/my-courses/{course}', [CourseController::class, 'courseDetail'])->name('course-detail');
    Route::get('/my-courses/{course}/content/{content}', [CourseController::class, 'contentDetail'])->name('content-detail');
    Route::post('/my-courses/{course}/content/{content}/complete', [CourseController::class, 'completeContent'])->name('complete-content');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'showDashboard'])->name('admin.dashboard');
    Route::resource('courses', CourseAdminController::class);
    Route::resource('divisions', DivisionController::class);
    Route::resource('courses.contents', CourseContentController::class)->shallow();
    Route::resource('users', UserAdminController::class);
});

Route::get('/', function () {
    return redirect('/login');
});
