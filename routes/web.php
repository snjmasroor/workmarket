<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\IndusrtyController;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

/*------------------------------------------
--------------------------------------------
All Normal Users Routes List
--------------------------------------------
--------------------------------------------*/
Route::post('/add-user', [UserController::class, 'store'])->name('add.user');
Route::get('/user-registration', [UserController::class, 'register'])->name('user.register.form');
Route::get('/get-state/{country}', [UserController::class, 'getState'])->name('user.get.states');

Route::middleware(['auth', 'user-access:user'])
    ->prefix('user')
    ->group(function () {

    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/profile', [UserController::class, 'viewProfile'])->name('user.viewProfile');
    Route::get('/view-jobs', [UserController::class, 'view_jobs'])->name('user.viewJobs');
});
  
/*------------------------------------------
--------------------------------------------
All Admin Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:superadmin'])->group(function () {
  
    Route::get('/superadmin/home', [HomeController::class, 'adminHome'])->name('superadmin.home');
});
  
/*------------------------------------------
--------------------------------------------
All Admin Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:admin'])->group(function () {
  
    Route::get('/admin/home', [HomeController::class, 'managerHome'])->name('admin.home');
    // Route::get('/admin/industries', [IndusrtyController::class, 'index'])->name('show.industry');
    
});
Route::get('/get-skills', [App\Http\Controllers\IndustrySkillController::class, 'getSkillsByIndustry'])->name('get.skills.by.industry');

