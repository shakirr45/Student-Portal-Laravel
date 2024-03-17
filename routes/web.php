<?php
  
use Illuminate\Support\Facades\Route;
  
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ClassAssignController;
// use App\Http\Controllers\SubjectAssignController;
use App\Http\Controllers\ManageStudentController;
use App\Http\Controllers\ManageTeacherController;
// use App\Http\Controllers\ClassWiseSubjectAssignController;

  
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

    Route::get('pagination-search', [HomeController::class, 'pagination'])->name('pagination-search');

});


