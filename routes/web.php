<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\IndusrtyController;
use App\Http\Controllers\CertificationController;
use App\Http\Controllers\ToolController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\RecuitmentController;
use App\Http\Controllers\PayPalController;


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
Route::get('/get-certifications', [CertificationController::class, 'getCertification'])->name('user.get.certifications');
Route::get('/get-tools', [ToolController::class, 'getTool'])->name('user.get.tools');
Route::get('/webhook-paypal', [PayPalController::class, 'webHook'])->name('paypal.webhook');

Route::middleware(['auth', 'user-access:user'])
    ->prefix('user')
    ->group(function () {

    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/profile', [UserController::class, 'viewProfile'])->name('user.viewProfile');
    Route::get('/view-jobs', [UserController::class, 'view_jobs'])->name('user.viewJobs');
    Route::get('/view-jobs-data', [JobController::class, 'data_api'])->name('user.data.all.jobs');
    Route::get('/view-jobs/{id}', [JobController::class, 'show'])->name('user.job.only');
    Route::post('/job/apply/{id}', [JobController::class, 'apply'])->name('user.job.apply');


    Route::get('/view-recuitment', [RecuitmentController::class, 'view_recuitment'])->name('user.recuitments.view');
    Route::get('/view-contracts/{id}', [RecuitmentController::class, 'view_contract'])->name('user.contracts.view');
    Route::put('/contracts/{id}/respond', [RecuitmentController::class, 'respond'])->name('user.contracts.respond');

    Route::post('/paypal/order/create', [PayPalController::class, 'createOrder'])->name('paypal.order.create');
    Route::post('/paypal/order/capture', [PayPalController::class, 'captureOrder'])->name('paypal.order.capture');

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

