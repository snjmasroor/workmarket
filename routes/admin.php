<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndusrtyController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\IndustrySkillController;

  Route::middleware(['auth', 'user-access:admin'])->prefix('admin')->group(function () {
        Route::get('/industries', [IndusrtyController::class, 'index'])->name('show.industry');
        Route::get('/skills', [SkillController::class, 'index'])->name('show.skills');

        // adding industry skills
        Route::get('/industry-skills', [IndustrySkillController::class, 'index'])->name('show.industry-skills');
        Route::get('/industry-skill/create', [IndustrySkillController::class, 'create'])->name('industry-skill.create');
        Route::post('/industry-skill/store', [IndustrySkillController::class, 'store'])->name('industry-skill.store');

    });
?>