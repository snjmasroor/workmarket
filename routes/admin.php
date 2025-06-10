<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndusrtyController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\IndustrySkillController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\JobSpacification;
use App\Http\Controllers\UserController;


  Route::middleware(['auth', 'user-access:admin,superadmin'])->prefix('admin')->group(function () {
        Route::get('/industries', [IndusrtyController::class, 'index'])->name('show.industry');
        Route::get('/industries/data', [IndusrtyController::class, 'data'])->name('admin.industries.data');
        Route::get('/industries/create', [IndusrtyController::class, 'create'])->name('admin.industry.create');
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


        Route::get('/skills', [SkillController::class, 'index'])->name('show.skills');
        Route::get('/skills/data', [SkillController::class, 'data'])->name('admin.skills.data');
        Route::get('/skills/create', [SkillController::class, 'create'])->name('admin.skill.create');
        Route::post('/skills/store', [SkillController::class, 'store'])->name('admin.skill.store');
        Route::get('/skills/{id}/edit', [SkillController::class, 'edit'])->name('admin.skill.edit');
        Route::put('/skills/update/{id}', [SkillController::class, 'update'])->name('admin.skill.update');
        

        // adding industry skills
        Route::get('/industry-skills', [IndustrySkillController::class, 'index'])->name('show.industry-skills');
        Route::get('/industry-skills/data', [IndustrySkillController::class, 'data'])->name('admin.industry.skills.data');
        Route::get('/industry-skill/create', [IndustrySkillController::class, 'create'])->name('industry-skill.create');
        Route::post('/industry-skill/store', [IndustrySkillController::class, 'store'])->name('industry-skill.store');
        Route::get('/industry-skill/{id}/edit', [IndustrySkillController::class, 'edit'])->name('industry-skill.edit');
        Route::put('/industry-skill/update/{id}', [IndustrySkillController::class, 'update'])->name('industry-skill.update');
        Route::get('/api/skills', [IndustrySkillController::class, 'getSkills'])->name('industry-skill.api');
        // Adding jobs
        Route::get('/jobs/create', [JobController::class, 'create'])->name('jobs.create');
        Route::get('/jobs', [JobController::class, 'index'])->name('show.jobs');
        Route::post('/jobs/store', [JobController::class, 'store'])->name('job.store');
        //edit jobs
        Route::get('/jobs/{job}/edit', [JobController::class, 'edit'])->name('jobs.edit');
        Route::put('/jobs/{job}/update', [JobController::class, 'update'])->name('jobs.update');
        
        
        // Job Specifications
        Route::get('/jobs/specifications', [JobSpacification::class, 'index'])->name('show.jobs.specifications');
        
        


    });

?>