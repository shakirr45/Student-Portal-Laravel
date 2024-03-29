<?php
  
use Illuminate\Support\Facades\Route;
  
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ClassAssignController;
use App\Http\Controllers\ManageStudentController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\ManageTeacherController;


use App\Http\Controllers\Students\ClassOneWiseStudentController;
use App\Http\Controllers\Students\ClassTowWiseStudentController;

  
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
  
Auth::routes();

Route::get('/admin-login', function () {
    return view('auth/login');
});

    // For student login =====>
    Route::get('student-login', [AuthController::class, 'index'])->name('student-login');
    Route::post('student-post-login', [AuthController::class, 'postLogin'])->name('login.post.student'); 
    Route::get('student-registration', [AuthController::class, 'registration'])->name('student-register');
    Route::post('post-registration', [AuthController::class, 'postRegistration'])->name('register.post.student'); 
    Route::get('dashboard', [AuthController::class, 'dashboard']); 
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
  
Route::get('/home', [HomeController::class, 'index'])->name('home');
  
Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('products', ProductController::class);

    
    Route::resource('class-assign', ClassAssignController::class);
    // Route::resource('class-wise-subject-assign', SubjectAssignController::class);

    Route::resource('manage-students', ManageStudentController::class);
    Route::resource('manage-teachers', ManageTeacherController::class);
    
    
    Route::resource('manage-sessions', SessionController::class);
    Route::delete('manage-sessions-destroy', [SessionController::class, 'destroy'])->name('manage-sessions-destroy');


    

    // Class Wise students Show =====>
    Route::resource('class-one-wise-students', ClassOneWiseStudentController::class);
    Route::post('class-one-single-student-wise-promote-class/{id}', [ClassOneWiseStudentController::class, 'singleStudentpromoteClass'])->name('class-one-single-student-wise-promote-class');
    Route::post('class-one-wise-students-demote-status/{id}', [ClassOneWiseStudentController::class, 'studentWiseDemoteStatus'])->name('class-one-wise-students-demote-status');
    Route::post('class-one-wise-students-promote-status/{id}', [ClassOneWiseStudentController::class, 'studentWisePromoteStatus'])->name('class-one-wise-students-promote-status');
    Route::post('class-one-wise-all-students-promote', [ClassOneWiseStudentController::class, 'promoteAllStudents'])->name('class-one-wise-all-students-promote');
    Route::get('selected-class-one-students-promote', [ClassOneWiseStudentController::class, 'selectedWisePromoteStudents'])->name('selected-class-one-students-promote');

    Route::resource('class-tow-wise-students', ClassTowWiseStudentController::class);
    Route::post('class-tow-single-student-wise-promote-class/{id}', [ClassTowWiseStudentController::class, 'singleStudentpromoteClass'])->name('class-tow-single-student-wise-promote-class');
    Route::post('class-tow-wise-students-demote-status/{id}', [ClassTowWiseStudentController::class, 'studentWiseDemoteStatus'])->name('class-tow-wise-students-demote-status');
    Route::post('class-tow-wise-students-promote-status/{id}', [ClassTowWiseStudentController::class, 'studentWisePromoteStatus'])->name('class-tow-wise-students-promote-status');
    Route::post('class-tow-wise-all-students-promote', [ClassTowWiseStudentController::class, 'promoteAllStudents'])->name('class-tow-wise-all-students-promote');
    Route::get('selected-class-tow-students-promote', [ClassTowWiseStudentController::class, 'selectedWisePromoteStudents'])->name('selected-class-tow-students-promote');

    
});


