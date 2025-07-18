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
use App\Http\Controllers\TestsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CertificationController;
use App\Http\Controllers\ToolController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\PayPalController;


  Route::middleware(['auth', 'user-access:admin,superadmin'])->prefix('admin')->group(function () {
        Route::get('/home', [HomeController::class, 'adminHome'])->name('admin.dashboard');
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
        Route::get('/jobs/{job}/edit', [JobController::class, 'edit'])->name('admin.jobs.edit');
        Route::put('/jobs/{job}/update', [JobController::class, 'update'])->name('admin.jobs.update');
        Route::get('/view-jobs/{id}', [JobController::class, 'show'])->name('jobs.only.detail');

        //  Job Payment
        Route::get('/jobs/{id}', [JobController::class, 'job_per_pay'])->name('admin.jobs.pay');
        
        Route::post('/api/paypal/order/create', [PaypalController::class, 'orderCreate'])->name('paypal.order.create');
        Route::post('/paypal/order/{orderId}/capture', [PaypalController::class, 'orderCapture'])->name('paypal.order.capture');
        
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
        
        

        //Tests
        Route::get('/tests/show', [TestsController::class, 'index'])->name('admin.tests.show');
        Route::get('/tests/data', [TestsController::class, 'data'])->name('admin.tests.data');
        Route::get('/tests/create', [TestsController::class, 'create'])->name('admin.tests.create');
        Route::post('/tests/create/store', [TestsController::class, 'store'])->name('admin.tests.store');
        Route::get('tests/{test}/edit', [TestsController::class, 'edit'])->name('admin.tests.edit');
        Route::put('tests/{test}', [TestsController::class, 'update'])->name('admin.tests.update');
        Route::delete('tests/{test}', [TestsController::class, 'destroy'])->name('admin.tests.destroy');

        //Questions
        Route::get('tests/{test}/questions/create', [QuestionController::class, 'create'])->name('admin.tests.add_question');
        Route::post('tests/{test}/questions', [QuestionController::class, 'store'])->name('admin.tests.store_question');
        //Route::get('questions/create', [QuestionController::class, 'create_question'])->name('admin.tests.select.test.question');
        Route::get('/admin/question/data', [QuestionController::class, 'data'])->name('admin.question.data');
        Route::get('/questions/{question}/edit', [QuestionController::class, 'edit'])->name('admin.questions.edit');
        Route::get('/questions/{question}', [QuestionController::class, 'show'])->name('admin.questions.show');
        Route::put('/questions/{question}', [QuestionController::class, 'update'])->name('admin.questions.update');
        Route::get('/questions/show/all', [QuestionController::class, 'allShow'])->name('admin.questions.all');
        Route::get('/questions/datatable', [QuestionController::class, 'datatable'])->name('admin.questions.datatable');
        // Certificates
        Route::get('/certifications/show', [CertificationController::class, 'index'])->name('admin.certificates.index');
        Route::get('/certifications/data', [CertificationController::class, 'data'])->name('admin.certificates.data');
        Route::get('/certifications/create', [CertificationController::class, 'create'])->name('admin.certificates.create');
        Route::post('/certifications/store', [CertificationController::class, 'store'])->name('admin.certificates.store');
        Route::get('/certificates/{certificate}/edit', [CertificationController::class, 'edit'])->name('admin.certificates.edit');
        Route::put('/certificates/{certificate}', [CertificationController::class, 'update'])->name('admin.certificates.update');
        Route::delete('/certificates/{certificate}', [CertificationController::class, 'destroy'])->name('admin.certificates.destroy');

        // Tools
        Route::get('/tools/show', [ToolController::class, 'index'])->name('admin.tools.index');
        Route::get('/tools/data', [ToolController::class, 'data'])->name('admin.tools.data');
        Route::get('/tools/create', [ToolController::class, 'create'])->name('admin.tools.create');
        Route::post('/tools/store', [ToolController::class, 'store'])->name('admin.tools.store');
        Route::get('/tools/{tool}/edit', [ToolController::class, 'edit'])->name('admin.tools.edit');
        Route::put('/tools/{tool}', [ToolController::class, 'update'])->name('admin.tools.update');
        Route::delete('/tools/{tool}', [ToolController::class, 'destroy'])->name('admin.tools.destroy');

        // company
        Route::get('/company/create', [CompanyController::class, 'create'])->name('admin.company.create');
        Route::post('/company/store', [CompanyController::class, 'store'])->name('admin.company.store');
        Route::get('/company/show', [CompanyController::class, 'show'])->name('admin.company.show');
        Route::get('/company/data', [CompanyController::class, 'data'])->name('admin.company.data');
        Route::get('/company/edit/{id}', [CompanyController::class, 'edit'])->name('admin.company.edit');
       Route::put('/company/update/{id}', [CompanyController::class, 'update'])->name('admin.company.update');


    });

?>