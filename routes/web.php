<?php
  
use Illuminate\Support\Facades\Route;
  
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ClassAssignController;
use App\Http\Controllers\Classes\ClassAssignForClassOneController;
use App\Http\Controllers\Classes\ClassAssignForClassTwoController;
use App\Http\Controllers\ManageStudentController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\ManageTeacherController;


use App\Http\Controllers\Students\ClassOneWiseStudentController;
use App\Http\Controllers\Students\ClassTwoWiseStudentController;
use App\Http\Controllers\Students\ClassThreeWiseStudentController;
use App\Http\Controllers\Students\ClassFourWiseStudentController;
use App\Http\Controllers\Students\ClassFiveWiseStudentController;


// -------------------------test ----------------------? start
use App\Http\Controllers\testController;
// -------------------------test ----------------------? end

  
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
    Route::resource('class-assign-for-class-one', ClassAssignForClassOneController::class);
    Route::resource('class-assign-for-class-two', ClassAssignForClassTwoController::class);

   
   
   
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

    Route::resource('class-two-wise-students', ClassTwoWiseStudentController::class);
    Route::post('class-two-single-student-wise-promote-class/{id}', [ClassTwoWiseStudentController::class, 'singleStudentpromoteClass'])->name('class-two-single-student-wise-promote-class');
    Route::post('class-two-wise-students-demote-status/{id}', [ClassTwoWiseStudentController::class, 'studentWiseDemoteStatus'])->name('class-two-wise-students-demote-status');
    Route::post('class-two-wise-students-promote-status/{id}', [ClassTwoWiseStudentController::class, 'studentWisePromoteStatus'])->name('class-two-wise-students-promote-status');
    Route::post('class-two-wise-all-students-promote', [ClassTwoWiseStudentController::class, 'promoteAllStudents'])->name('class-two-wise-all-students-promote');
    Route::get('selected-class-two-students-promote', [ClassTwoWiseStudentController::class, 'selectedWisePromoteStudents'])->name('selected-class-two-students-promote');

    Route::resource('class-three-wise-students', ClassThreeWiseStudentController::class);
    Route::post('class-three-single-student-wise-promote-class/{id}', [ClassThreeWiseStudentController::class, 'singleStudentpromoteClass'])->name('class-three-single-student-wise-promote-class');
    Route::post('class-three-wise-students-demote-status/{id}', [ClassThreeWiseStudentController::class, 'studentWiseDemoteStatus'])->name('class-three-wise-students-demote-status');
    Route::post('class-three-wise-students-promote-status/{id}', [ClassThreeWiseStudentController::class, 'studentWisePromoteStatus'])->name('class-three-wise-students-promote-status');
    Route::post('class-three-wise-all-students-promote', [ClassThreeWiseStudentController::class, 'promoteAllStudents'])->name('class-three-wise-all-students-promote');
    Route::get('selected-class-three-students-promote', [ClassThreeWiseStudentController::class, 'selectedWisePromoteStudents'])->name('selected-class-three-students-promote');


    Route::resource('class-four-wise-students', ClassFourWiseStudentController::class);
    Route::post('class-four-single-student-wise-promote-class/{id}', [ClassFourWiseStudentController::class, 'singleStudentpromoteClass'])->name('class-four-single-student-wise-promote-class');
    Route::post('class-four-wise-students-demote-status/{id}', [ClassFourWiseStudentController::class, 'studentWiseDemoteStatus'])->name('class-four-wise-students-demote-status');
    Route::post('class-four-wise-students-promote-status/{id}', [ClassFourWiseStudentController::class, 'studentWisePromoteStatus'])->name('class-four-wise-students-promote-status');
    Route::post('class-four-wise-all-students-promote', [ClassFourWiseStudentController::class, 'promoteAllStudents'])->name('class-four-wise-all-students-promote');
    Route::get('selected-class-four-students-promote', [ClassFourWiseStudentController::class, 'selectedWisePromoteStudents'])->name('selected-class-four-students-promote');

    Route::resource('class-five-wise-students', ClassFiveWiseStudentController::class);
    Route::post('class-five-single-student-wise-promote-class/{id}', [ClassFiveWiseStudentController::class, 'singleStudentpromoteClass'])->name('class-five-single-student-wise-promote-class');
    Route::post('class-five-wise-students-demote-status/{id}', [ClassFiveWiseStudentController::class, 'studentWiseDemoteStatus'])->name('class-five-wise-students-demote-status');
    Route::post('class-five-wise-students-promote-status/{id}', [ClassFiveWiseStudentController::class, 'studentWisePromoteStatus'])->name('class-five-wise-students-promote-status');
    Route::post('class-five-wise-all-students-promote', [ClassFiveWiseStudentController::class, 'promoteAllStudents'])->name('class-five-wise-all-students-promote');
    Route::get('selected-class-five-students-promote', [ClassFiveWiseStudentController::class, 'selectedWisePromoteStudents'])->name('selected-class-five-students-promote');
  
});





// ----------------------------- test ----------------------- ?? start 
Route::get('test', [testController::class, 'index'])->name('test.index');
Route::post('test-data.store', [testController::class, 'testDatSore'])->name('test-data.store');
Route::get('destroy/{$id}', [testController::class, 'destroy'])->name('test.destroy');

// ----------------------------- test ----------------------- ?? end 
