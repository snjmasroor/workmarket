<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndusrtyController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\IndustrySkillController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\JobSpacification;
use App\Http\Controllers\UserController;
use App\Http\Controllers\JobApplicationController;
use App\Http\Controllers\ContractController;


  Route::middleware(['auth', 'user-access:admin,superadmin'])->prefix('admin')->group(function () {
        Route::get('/industries', [IndusrtyController::class, 'index'])->name('admin.industries.show');
        Route::get('/industries/data', [IndusrtyController::class, 'data'])->name('admin.industries.data');
        Route::get('/industries/create', [IndusrtyController::class, 'create'])->name('admin.industries.create');
        Route::post('/industries/store', [IndusrtyController::class, 'store'])->name('admin.industry.store'); 
        Route::get('/industries/{id}/edit', [IndusrtyController::class, 'edit'])->name('admin.industries.edit');
        Route::put('/industry/update/{id}', [IndusrtyController::class, 'update'])->name('admin.industry.update');
        Route::delete('/industries/{id}', [IndusrtyController::class, 'destroy'])->name('admin.industries.destroy');

        //users
        Route::get('/user/users', [UserController::class, 'index'])->name('admin.user.index');
        Route::get('/user/users/data', [UserController::class, 'data'])->name('admin.user.index.data');
        Route::get('/users/create', [UserController::class, 'create'])->name('admin.user.create');
        Route::post('/users/store', [UserController::class, 'store'])->name('admin.user.store');
        Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('admin.user.edit');
        Route::put('/users/update/{id}', [UserController::class, 'update'])->name('admin.user.update');
        Route::get('/users/{id}/detail', [UserController::class, 'detail'])->name('admin.user.detail');


        Route::get('/skills', [SkillController::class, 'index'])->name('admin.skills.show');
        Route::get('/skills/data', [SkillController::class, 'data'])->name('admin.skills.data');
        Route::get('/skills/create', [SkillController::class, 'create'])->name('admin.skill.create');
        Route::post('/skills/store', [SkillController::class, 'store'])->name('admin.skill.store');
        Route::get('/skills/{id}/edit', [SkillController::class, 'edit'])->name('admin.skill.edit');
        Route::put('/skills/update/{id}', [SkillController::class, 'update'])->name('admin.skill.update');
        

        // adding industry skills
        Route::get('/industry-skills', [IndustrySkillController::class, 'index'])->name('industry-skills.show');
        Route::get('/industry-skills/data', [IndustrySkillController::class, 'data'])->name('admin.industry.skills.data');
        Route::get('/industry-skill/create', [IndustrySkillController::class, 'create'])->name('industry-skill.create');
        Route::post('/industry-skill/store', [IndustrySkillController::class, 'store'])->name('industry-skill.store');
        Route::get('/industry-skill/{id}/edit', [IndustrySkillController::class, 'edit'])->name('industry-skill.edit');
        Route::put('/industry-skill/update/{id}', [IndustrySkillController::class, 'update'])->name('industry-skill.update');
        Route::get('/api/skills', [IndustrySkillController::class, 'getSkills'])->name('industry-skill.api');
        // Adding jobs
        Route::get('/jobs/create', [JobController::class, 'create'])->name('admin.jobs.create');
        Route::get('/jobs', [JobController::class, 'index'])->name('admin.jobs.show');
        Route::get('/jobs/data', [JobController::class, 'data'])->name('admin.jobs.data');
        Route::post('/jobs/store', [JobController::class, 'store'])->name('job.store');
        
        //edit jobs
        Route::get('/jobs/{job}/edit', [JobController::class, 'edit'])->name('jobs.edit');
        Route::put('/jobs/{job}/update', [JobController::class, 'update'])->name('jobs.update');
        Route::get('/view-jobs/{id}', [JobController::class, 'show'])->name('jobs.only.detail');
        
        // Job applications routes
        Route::get('/jobs/application/process', [JobApplicationController::class, 'process'])->name('admin.jobs.application.process');
        Route::get('/jobs/application/process/data', [JobApplicationController::class, 'getApplicationsForAdmin'])->name('admin.jobs.application.process.data');
        Route::post('/admin/applications/hire/{id}', [JobApplicationController::class, 'hireApplicant'])->name('admin.applications.hire');
        
        Route::get('/admin/contracts/create/{id}', [ContractController::class, 'create'])->name('admin.contracts.create');
        Route::post('/admin/contracts/store', [ContractController::class, 'store'])->name('admin.contracts.store');
        Route::get('/contracts/view/{id}', [ContractController::class, 'show'])->name('admin.contracts.show');

        Route::get('/admin/contracts', [ContractController::class, 'contracts'])->name('admin.jobs.contract');
        Route::get('/contracts/data', [ContractController::class, 'data'])->name('admin.jobs.contract.data');
        Route::get('/contracts/{id}/edit', [ContractController::class, 'edit'])->name('admin.jobs.contract.edit');
        Route::put('/contracts/update/{id}', [ContractController::class, 'update'])->name('admin.jobs.contract.update');
        // Job Specifications
        Route::get('/jobs/specifications', [JobSpacification::class, 'index'])->name('show.jobs.specifications');
        
        


    });

?>