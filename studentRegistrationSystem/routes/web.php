<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StudentController;

use App\Models\User;

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
    return view('welcome');
});

//Authorization 
Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('post-login', [AuthController::class, 'postLogin'])->name('login.post'); 
Route::get('registration', [AuthController::class, 'registration'])->name('register');
Route::post('post-registration', [AuthController::class, 'postRegistration'])->name('register.post'); 
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

//Dashboard routes
Route::get('dashboard', [DashboardController::class, 'viewDashboard'])->name('dashboard');


//Student Page
Route::get('student',[StudentController::class, 'viewStudentPage'])->name('student');


//add student registration
Route::post('registration/add',[StudentController::class, 'createStudentRegistration'])->name('register-add');

//edit the student registration by admin only
Route::post('registration/edit',[StudentController::class, 'editStudentRegistration'])->name('register-edit');

