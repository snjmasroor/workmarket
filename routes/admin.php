<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndusrtyController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\IndustrySkillController;
use App\Http\Controllers\JobController;

  Route::middleware(['auth', 'user-access:admin,superadmin'])->prefix('admin')->group(function () {
        Route::get('/industries', [IndusrtyController::class, 'index'])->name('show.industry');
        Route::get('/skills', [SkillController::class, 'index'])->name('show.skills');

        // adding industry skills
        Route::get('/industry-skills', [IndustrySkillController::class, 'index'])->name('show.industry-skills');
        Route::get('/industry-skill/create', [IndustrySkillController::class, 'create'])->name('industry-skill.create');
        Route::post('/industry-skill/store', [IndustrySkillController::class, 'store'])->name('industry-skill.store');
        
        // Adding jobs
        Route::get('/jobs/create', [JobController::class, 'create'])->name('jobs.create');
        Route::get('/jobs', [JobController::class, 'index'])->name('show.jobs');
        Route::post('/jobs/store', [JobController::class, 'store'])->name('job.store');
        //edit jobs
        Route::get('/jobs/{job}/edit', [JobController::class, 'edit'])->name('jobs.edit');
        Route::put('/jobs/{job}/update', [JobController::class, 'update'])->name('jobs.update');
        


    });

?>