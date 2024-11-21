<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\OtpController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QueueController;
use App\Http\Controllers\SeatController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Auth\SessionGuard;

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

Route::get('/', function () {
    return view('welcome');
});
/*
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';*/


//-------------------------DEPARTMENT------------------------//


Route::get('/department',[DepartmentController::class,'index'])->middleware(['auth:admin'])->name('department');
Route::controller(DepartmentController::class)->middleware(['auth:admin'])->group(function(){
    Route::get('department/create','create')->name('department.create');
    Route::post('department/store','store')->name('department.store');
    Route::get('department/edit/{id}','edit')->name('department.edit');
    Route::post('department/update/{id}','update')->name('department.update');
    Route::get('department/show/{id}','show')->name('department.show');
    Route::get('department/destroy/{id}','destroy')->name('department.destroy');
});


//-------------------------JOB------------------------//


Route::get('/job',[JobController::class,'index'])->name('job')->middleware(['auth:admin']);
Route::controller(JobController::class)->middleware(['auth:admin'])->group(function(){
    Route::get('job/create','create')->name('job.create');
    Route::post('job/store','store')->name('job.store');
    Route::get('job/edit/{id}','edit')->name('job.edit');
    Route::post('job/update/{id}','update')->name('job.update');
    Route::get('job/show/{id}','show')->name('job.show');
    Route::get('job/destroy/{id}','destroy')->name('job.destroy');
});


//-------------------------EMPLOPYEE------------------------//


Route::get('/employee',[EmployeeController::class,'index'])->name('employee')->middleware(['auth:admin']);
Route::controller(EmployeeController::class)->middleware(['auth:admin'])->group(function(){
    Route::get('employee/create','create')->name('employee.create');
    Route::post('employee/store','store')->name('employee.store');
    Route::get('employee/edit/{id}','edit')->name('employee.edit');
    Route::post('employee/update/{id}','update')->name('employee.update');
    Route::get('employee/show/{id}','show')->name('employee.show');
    Route::get('employee/destroy/{id}','destroy')->name('employee.destroy');
});


//-------------------------SERVICE------------------------//


Route::get('/service',[ServiceController::class,'index'])->name('service')->middleware(['auth:admin']);
Route::controller(ServiceController::class)->middleware(['auth:admin'])->group(function(){
    Route::get('service/create','create')->name('service.create');
    Route::post('service/store','store')->name('service.store');
    Route::get('service/edit/{id}','edit')->name('service.edit');
    Route::post('service/update/{id}','update')->name('service.update');
    Route::get('service/show/{id}','show')->name('service.show');
    Route::get('service/destroy/{id}','destroy')->name('service.destroy');
});



//-------------------------USER------------------------//


Route::middleware(['auth:admin'])->group(function () {
    Route::get('/user', [UserController::class, 'index'])->name('user');
    Route::get('/user/show/{id}', [UserController::class, 'show'])->name('user.show');
    Route::get('/user/ban/{id}', [UserController::class, 'banUser'])->name('user.ban');
    Route::get('/user/unban/{id}', [UserController::class, 'unbanUser'])->name('user.unban');
});


//-------------------------QUEUE------------------------//


Route::middleware(['auth:admin'])->group(function () {
    Route::get('/queue', [QueueController::class, 'index'])->name('queue');
    Route::get('/archive', [QueueController::class, 'archive'])->name('archive');
    Route::get('/queue/{id}', [QueueController::class, 'show'])->name('queue.show');
    Route::patch('/queue/update/{id}', [QueueController::class, 'update'])->name('queue.update');
});


//-------------------------ADMIN------------------------//

Route::get('/home', [HomeController::class, 'home'])->name('home')->middleware(['auth:admin']);
Route::get('/index', [HomeController::class, 'index'])->name('index')->middleware(['auth:admin']);
Route::get('/register', [HomeController::class, 'register'])->name('register')->middleware(['auth:admin']);
Route::get('/login', [HomeController::class, 'login'])->name('login');
Route::post('/store', [HomeController::class, 'store'])->name('store');
Route::post('/save', [HomeController::class, 'save'])->name('save');
Route::post('/logout', [HomeController::class, 'logout'])->name('logout')->middleware(['auth:admin']);
Route::post('/notify3/{id}',[QueueController::class,'notify3'])->name('notify')->middleware(['auth:admin']);




//-------------------------Seat------------------------//


Route::get('/seat',[SeatController::class,'index'])->name('seat')->middleware(['auth:admin']);
Route::controller(SeatController::class)->middleware(['auth:admin'])->group(function(){
    Route::get('seat/create','create')->name('seat.create');
    Route::post('seat/store','store')->name('seat.store');
    Route::get('seat/edit/{number}','edit')->name('seat.edit');
    Route::post('seat/update/{number}','update')->name('seat.update');
    Route::get('seat/show/{number}','show')->name('seat.show');
    Route::get('seat/destroy/{number}','destroy')->name('seat.destroy');
});