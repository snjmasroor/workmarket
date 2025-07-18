
@extends('layouts.backend.master') 
@push('styles')
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/bs-stepper/bs-stepper.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/bootstrap-select/bootstrap-select.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/@form-validation/form-validation.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/tagify/tagify.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/page-auth.css') }}" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<style>
   .nav-tabs.custom-tabs .nav-link {
    display: flex;
    align-items: center;
    background-color: transparent;
    border: none;
    padding: 0.75rem 1.2rem;
    color: #6c757d;
    font-weight: 500;
    border-bottom: 3px solid transparent;
    transition: all 0.3s ease;
    border-radius: 0.5rem 0.5rem 0 0;
  }

  .nav-tabs.custom-tabs .nav-link:hover {
    background-color: rgba(13, 110, 253, 0.05);
    color: #0d6efd;
  }

  .nav-tabs.custom-tabs .nav-link.active {
    background-color: #fff;
    color: #0d6efd;
    border-bottom: 3px solid #0d6efd;
    font-weight: 600;
  }

  .nav-tabs.custom-tabs .bs-stepper-circle {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 36px;
    height: 36px;
    border-radius: 50%;
    background-color: #e9ecef;
    color: #6c757d;
    margin-right: 8px;
    transition: background-color 0.3s, color 0.3s;
    font-size: 1rem;
  }

  .nav-tabs.custom-tabs .nav-link.active .bs-stepper-circle {
    background-color: #0d6efd;
    color: #fff;
  }

  .bs-stepper-title {
    font-size: 0.95rem;
  }
  #tab1 {
  background-color: #fff;
  padding: 2rem;
  border-radius: 0.75rem;
  border: 1px solid #e4e9f0;
  box-shadow: 0 2px 12px rgba(0, 0, 0, 0.05);
}

#tab1 .content-header h5 {
  font-size: 1.4rem;
  font-weight: 600;
  margin-bottom: 0.25rem;
}

#tab1 .content-header p {
  color: #6c757d;
  font-size: 0.95rem;
  margin-bottom: 1.5rem;
}

#tab1 label.form-label {
  font-weight: 500;
  color: #495057;
  margin-bottom: 0.4rem;
}

#tab1 .form-control,
#tab1 .form-select {
  border-radius: 0.5rem;
  padding: 0.6rem 0.75rem;
}

#tab1 .form-control:focus,
#tab1 .form-select:focus {
  border-color: #0d6efd;
  box-shadow: none;
}

#tab1 .select2-container--default .select2-selection--multiple {
  border-radius: 0.5rem;
  border: 1px solid #ced4da;
  padding: 0.4rem;
  min-height: 40px;
}

#tab1 .btn {
  padding: 0.6rem 1.5rem;
  font-weight: 500;
}

#tab1 .col-sm-6,
#tab1 .col-md-12 {
  margin-bottom: 1.25rem;
}

#tab1 .summernote {
  min-height: 200px;
}
.content-header {
    background-color: #f9fafb;
    padding: 1.5rem;
    border-left: 4px solid #0d6efd;
    border-radius: 0.5rem;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.03);
    transition: all 0.3s ease;
  }

  .content-header h5 {
    font-size: 1.25rem;
    font-weight: 600;
    margin-bottom: 0.25rem;
    color: #1a1a1a;
  }

  .content-header p {
    font-size: 0.95rem;
    color: #6c757d;
    margin: 0;
  }
  #tab2 {
    background-color: #ffffff;
    border: 1px solid #e4e4e4;
    border-radius: 0.75rem;
    padding: 2rem;
    box-shadow: 0 2px 16px rgba(0, 0, 0, 0.04);
  }

  #tab2 .content-header h5 {
    font-weight: 600;
    font-size: 1.25rem;
  }

  #tab2 .content-header p {
    color: #6c757d;
    margin-bottom: 1.5rem;
  }

  #tab2 label.form-label {
    font-weight: 500;
    color: #343a40;
  }

  #tab2 .form-control {
    border-radius: 0.5rem;
    transition: border-color 0.2s ease;
  }

  #tab2 .form-control:focus {
    border-color: #0d6efd;
    box-shadow: none;
  }

  #tab2 .btn {
    padding: 0.6rem 1.5rem;
    font-weight: 500;
  }

  #tab2 .col-sm-6 {
    margin-bottom: 1rem;
  }
   #tab3 {
    background-color: #fff;
    border: 1px solid #e4e4e4;
    border-radius: 0.75rem;
    padding: 2rem;
    box-shadow: 0 2px 16px rgba(0, 0, 0, 0.04);
  }

  #tab3 .content-header h5 {
    font-weight: 600;
    font-size: 1.25rem;
  }

  #tab3 .content-header p {
    color: #6c757d;
    margin-bottom: 1.5rem;
  }

  #tab3 label.form-label {
    font-weight: 500;
    color: #343a40;
  }

  #tab3 .form-control,
  #tab3 .form-select {
    border-radius: 0.5rem;
    transition: border-color 0.2s ease;
  }

  #tab3 .form-control:focus,
  #tab3 .form-select:focus {
    border-color: #0d6efd;
    box-shadow: none;
  }

  #tab3 .switch {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    font-weight: 500;
    margin-top: 1rem;
    margin-bottom: 1rem;
  }

  #tab3 .switch .switch-label {
    margin-left: 0.5rem;
    color: #444;
  }

  #tab3 .card-title {
    font-size: 1.1rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
  }

  #tab3 .test-row {
    border: 1px dashed #ccc;
    background-color: #f8f9fa;
  }

  #tab3 .btn {
    padding: 0.6rem 1.5rem;
    font-weight: 500;
  }

  #tab3 .col-sm-6,
  #tab3 .col-sm-12,
  #tab3 .col-md-6,
  #tab3 .col-md-4,
  #tab3 .col-md-2 {
    margin-bottom: 1rem;
  }
   #tab4 {
    background-color: #fff;
    border-radius: 0.75rem;
    padding: 2rem;
    border: 1px solid #e6e6e6;
    box-shadow: 0 3px 14px rgba(0, 0, 0, 0.05);
  }

  #tab4 .content-header h4 {
    font-size: 1.35rem;
    font-weight: 600;
  }

  #tab4 .content-header p {
    color: #6c757d;
    margin-bottom: 1.5rem;
  }

  #tab4 label.form-label {
    font-weight: 500;
    color: #333;
  }

  #tab4 .form-control,
  #tab4 .form-select {
    border-radius: 0.5rem;
    padding: 0.6rem 0.75rem;
  }

  #tab4 .form-control:focus,
  #tab4 .form-select:focus {
    border-color: #0d6efd;
    box-shadow: none;
  }

  #tab4 .switch {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    margin-top: 1rem;
    margin-bottom: 1rem;
  }

  #tab4 .switch-label {
    font-weight: 500;
    color: #495057;
  }

  #tab4 textarea.form-control {
    resize: vertical;
  }

  #tab4 #map {
    border: 1px solid #ccc;
    border-radius: 0.5rem;
  }

  #tab4 .btn {
    padding: 0.6rem 1.5rem;
    font-weight: 500;
  }

  #tab4 .col-sm-6,
  #tab4 .col-sm-12 {
    margin-bottom: 1rem;
  }
</style>
@endpush 
@section('page-content') 
<div class="d-flex col-lg-12 align-items-center justify-content-center authentication-bg px-9">
  <div class="w-px-800">
    <div id="multiStepsValidation" class="bs-stepper border-none shadow-none mt-5">
      <form onSubmit="return false" id="multiForm" action="{{ route('admin.jobs.update', $job->id) }}" method="POST" enctype="multipart/form-data">
        <ul class="nav nav-tabs custom-tabs mb-4" id="tabList" role="tablist">
           @method('PUT')
          <li class="nav-item" role="presentation">
            <a class="nav-link active" data-tab="tab1" href="#" role="tab">
              <span class="bs-stepper-circle"><i class="ti ti-file-analytics ti-sm"></i></span>
              <span class="bs-stepper-label">
                <span class="bs-stepper-title">Basic Job Detail</span>
              </span>
            </a>
          </li>
          <li class="nav-item" role="presentation">
            <a class="nav-link" data-tab="tab2" href="#" role="tab">
              <span class="bs-stepper-circle"><i class="ti ti-user ti-sm"></i></span>
              <span class="bs-stepper-label">
                <span class="bs-stepper-title">Education Detail</span>
              </span>
            </a>
          </li>
          <li class="nav-item" role="presentation">
            <a class="nav-link" data-tab="tab3" href="#" role="tab">
              <span class="bs-stepper-circle"><i class="ti ti-credit-card ti-sm"></i></span>
              <span class="bs-stepper-label">
                <span class="bs-stepper-title">Certifications, Tools & Tests</span>
              </span>
            </a>
          </li>
          <li class="nav-item" role="presentation">
            <a class="nav-link" data-tab="tab4" href="#" role="tab">
              <span class="bs-stepper-circle"><i class="ti ti-shield-check ti-sm"></i></span>
              <span class="bs-stepper-label">
                <span class="bs-stepper-title">Location & Requirement</span>
              </span>
            </a>
          </li>
        </ul>
          <div id="tab1" class="tab-content-section">
            <div class="content-header mb-6">
              <h5 class="mb-0">Job Basic Information</h5>
              <p>The official name or designation of the job role, This should be clear and descriptive.</p>
            </div>
            <div class="row g-6">
                {{-- Job Title --}}
                <div class="col-sm-6">
                  <label class="form-label">Job Title</label>
                  <input type="text" name="title" class="form-control" value="{{ old('title', $job->title) }}">
                </div>
              {{-- Industry --}}
                <div class="col-sm-6">
                    <label for="industry_id" class="form-label">Industry <span class="text-danger">*</span></label>
                    <select name="industry_id" id="industry_id" class="select2 form-select form-select-lg">
                    <option value="">Select Industry</option>
                    @foreach($industries as $industry)
                        <option value="{{ $industry->id }}" {{ $job->industry_id == $industry->id ? 'selected' : '' }}>
                        {{ $industry->name }}
                        </option>
                    @endforeach
                    </select>
                    @error('industry_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
              {{-- Skills --}}
                <div class="col-sm-6">
                    <label class="form-label" for="skill">Select Skills</label>
                    <select id="selectpickerSelection" class="select2 form-select form-select-lg" name="skill_ids[]" multiple>
                    @foreach($skills as $skill)
                        <option value="{{ $skill->id }}" {{ in_array($skill->id, $job->skills->pluck('id')->toArray()) ? 'selected' : '' }}>
                        {{ $skill->name }}
                        </option>
                    @endforeach
                    </select>
                    @error('skill_ids')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                        {{-- Job Type --}}
                <div class="col-sm-6">
                    <label for="jobType" class="form-label">Job Type <span class="text-danger">*</span></label>
                    <select class="select2 form-select form-select-lg @error('jobType') is-invalid @enderror" name="jobType" id="jobType">
                    <option value="">Please select the Job Type</option>
                    <option value="fixed" {{ $job->fixed ? 'selected' : '' }}>Fixed – One-time payment</option>
                    <option value="hourly" {{ $job->hourly ? 'selected' : '' }}>Hourly – Pay based on time worked</option>
                    </select>
                </div>
              {{-- Budget --}}
                <div class="col-sm-6">
                    <label class="form-label" for="budget">Budget</label>
                    <input id="budget" type="number" step="0.01" name="budget" class="form-control" value="{{ old('budget', $job->budget) }}" placeholder="e.g: 1000 or 1500.50"/>
                </div>
             {{-- Fixed Rate --}}
                <div class="col-sm-6" id="fixed-rate-fields" style="{{ $job->fixed ? '' : 'display: none;' }}">
                    <label class="form-label" for="fixed_rate">Fixed Amount</label>
                    <input type="number" step="0.01" id="fixed_rate" name="fixed_rate" class="form-control" value="{{ old('fixed_rate', $job->fixed_rate) }}" placeholder="e.g 1000" />
                </div>
             {{-- Hourly Rate --}}
                <div class="col-sm-6" id="hourly-rate-fields" style="{{ $job->hourly ? '' : 'display: none;' }}">
                    <label class="form-label" for="hourly_rate">Hourly Rate</label>
                    <input type="number" step="0.01" id="hourly_rate" name="hourly_rate" class="form-control" value="{{ old('rate_per_hour', $job->rate_per_hour) }}" placeholder="e.g 100" />
                </div>
              {{-- Estimated Hours --}}
                <div class="col-sm-6">
                    <label class="form-label" for="estimated_hours">Estimated Hours</label>
                    <input type="text" id="estimated_hours" name="estimated_hours" class="form-control" value="{{ old('estimated_hours', $job->estimated_hours) }}" placeholder="Estimated Hours" maxlength="2" />
                </div>
             {{-- Start Date --}}
                <div class="col-sm-6">
                    <label class="form-label" for="start_date">Application Start Date</label>
                    <input type="text" id="start_date" name="start_date" class="form-control" value="{{ old('start_date', $job->start_date) }}" placeholder="Start Date" />
                </div>
              {{-- Deadline --}}
                <div class="col-sm-6">
                    <label class="form-label" for="deadline">Application Deadline</label>
                    <input type="text" id="deadline" name="deadline" class="form-control" value="{{ old('deadline', $job->deadline) }}" placeholder="Deadline Date" />
                </div>
              {{-- Description --}}
                <div class="col-md-12">
                    <label class="form-label" for="description">Description</label>
                    <textarea name="description" id="description" rows="4" class="form-control summernote editor">{{ old('description', strip_tags(htmlspecialchars_decode($job->description))) }}</textarea>
                </div>
              <div class="col-12 d-flex justify-content-between">
                <button class="btn btn-label-secondary btn-prev" disabled> <i class="ti ti-arrow-left ti-xs me-sm-2 me-0"></i>
                  <span class="align-middle d-sm-inline-block d-none">Previous</span>
                </button>
                <button class="btn btn-primary next-btn" data-next="tab2"><span class="align-middle d-sm-inline-block d-none me-sm-1 me-0">Next</span>
                  <i class="ti ti-arrow-right ti-xs"></i>
                </button>
              </div>
            </div>
          </div>
          <div id="tab2" class="tab-content-section d-none">
            <div class="content-header mb-6">
              <h5 class="mb-0">Job Education Requirement</h5>
              <p>This information helps employers assess a candidate's qualifications</p>
            </div>
            @php
                $qualification = $job->qualifications->first(); // assuming only one qualification entry per job
            @endphp
              <div class="row g-6">
                <div class="col-sm-6">
                  <label class="form-label" for="education_level">Minimum Qualification</label>
                  <input type="text"
                         name="education_level"
                         id="education_level"
                         class="form-control"
                         placeholder="e.g. Bachelor's Degree, Diploma"
                         value="{{ old('education_level', $qualification->education_level ?? '') }}" />
                </div>
                
                <div class="col-sm-6">
                    <label class="form-label" for="min_years_experience">Minimum Experience</label>
                    <input type="number"
                           step="0.01"
                           name="min_years_experience"
                           id="min_years_experience"
                           class="form-control"
                           placeholder="e.g. 2, 3.5, 5"
                           value="{{ old('min_years_experience', $qualification->min_years_experience ?? '') }}" />
                  </div>
                
                  <div class="col-sm-6">
                    <label class="form-label" for="field_of_study">Field of Study</label>
                    <input type="text"
                           name="field_of_study"
                           id="field_of_study"
                           class="form-control"
                           placeholder="e.g. Computer Science, Business, Engineering"
                           value="{{ old('field_of_study', $qualification->field ?? '') }}" />
                  </div>
                
                  <div class="col-sm-6">
                    <label class="form-label" for="language">Language</label>
                    <input type="text"
                           name="language"
                           id="language"
                           class="form-control"
                           placeholder="e.g. English, French, Chinese"
                           value="{{ old('language', $qualification->language ?? '') }}" />
                  </div>
               
                <div class="col-12 d-flex justify-content-between">
                  <button class="btn btn-secondary prev-btn" data-prev="tab1"><i class="ti ti-arrow-left ti-xs me-sm-2 me-0"></i>
                    <span class="align-middle d-sm-inline-block d-none">Previous</span>
                  </button>
                  <button class="btn btn-primary next-btn" data-next="tab3"> <span class="align-middle d-sm-inline-block d-none me-sm-1 me-0">Next</span>
                      <i class="ti ti-arrow-right ti-xs"></i>
                  </button>
                </div>
              </div>
          </div>
          <div id="tab3" class="tab-content-section d-none">
            <div class="content-header mb-6">
              <h5 class="mb-0">Certification, Test and Tools</h5>
              <p>This section includes your Certifications, Required Tests, and Tools proficiency—all in one place for easy review.</p>
            </div>
            @php
                $certificationIds = $job->certifications->pluck('id')->toArray();
                $toolsIds = $job->tools->pluck('id')->toArray();
            @endphp
            <div class="row g-6">
              {{-- Certification Switch --}}
                <div class="col-sm-6">
                    <label class="switch switch-info">
                    <input type="checkbox" class="switch-input" name="certificate_swtich"
                            id="certificate_required_checkbox"
                            {{ count($certificationIds) ? 'checked' : '' }} />
                    <span class="switch-toggle-slider">
                        <span class="switch-on"><i class="ti ti-check"></i></span>
                        <span class="switch-off"><i class="ti ti-x"></i></span>
                    </span>
                    <span class="switch-label">Requirement for Certification?</span>
                    </label>
                </div>
              {{-- Certification Selection --}}
                <div class="row g-6" id="certificate_fields" style="{{ count($certificationIds) ? '' : 'display: none;' }}">
                    <div class="col-sm-12">
                    <label for="certificationSelect" class="form-label">Select Certifications</label>
                    <select multiple id="select_certificate" name="certifications[]" class="form-select">
                        @foreach($certifications as $cert)
                        <option value="{{ $cert->id }}" {{ in_array($cert->id, $certificationIds) ? 'selected' : '' }}>
                            {{ $cert->name }}
                        </option>
                        @endforeach
                    </select>
                    </div>
                </div>
                 {{-- Test Switch --}}
                <div class="col-sm-6">
                    <label class="switch switch-info">
                    <input type="checkbox" class="switch-input" name="test_swtich" id="test_required_checkbox"
                            {{ count($job->tests) ? 'checked' : '' }} />
                    <span class="switch-toggle-slider">
                        <span class="switch-on"><i class="ti ti-check"></i></span>
                        <span class="switch-off"><i class="ti ti-x"></i></span>
                    </span>
                    <span class="switch-label">Requirement for Test?</span>
                    </label>
                </div>
                {{-- Test Section --}}
                <div class="row" id="test_fields" style="{{ count($job->tests) ? '' : 'display: none;' }}">
                    <div class="col-12">
                    <div class="card shadow-sm rounded-3 p-4">
                        <h5 class="card-title mb-3">Required Tests</h5>

                        <div id="test-wrapper">
                        @foreach($job->tests as $index => $jobTest)
                        <div class="row g-3 test-row mb-3 border p-3 rounded bg-light">
                            <div class="col-md-6">
                            <label class="form-label">Test Title</label>
                            <select name="test[{{ $index }}][test_id]" class="select2 form-select form-select-lg selectionTest">
                                <option value="0">-- Please Select Test --</option>
                                @foreach($tests as $test)
                                <option value="{{ $test->id }}" {{ $test->id == $jobTest->test_id ? 'selected' : '' }}>
                                    {{ $test->title }}
                                </option>
                                @endforeach
                            </select>
                            </div>
                            <div class="col-md-4">
                            <label class="form-label">Scoring Criteria</label>
                            <input type="text"
                                    name="test[{{ $index }}][scoring_criteria]"
                                    class="form-control"
                                    placeholder="e.g., Minimum 80%"
                                    value="{{ $jobTest->scoring_criteria }}">
                            </div>
                            <div class="col-md-2 d-flex align-items-end">
                            <button type="button" class="btn btn-outline-danger w-100 remove-test">
                                <i class="ti ti-trash"></i> Remove
                            </button>
                            </div>
                        </div>
                        @endforeach
                        </div>

                        <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-primary mt-2" id="add-test">
                            <i class="ti ti-plus"></i> Add Another Test
                        </button>
                        </div>
                    </div>
                    </div>
                </div>
                {{-- Tool Switch --}}
                <div class="col-sm-6">
                    <label class="switch switch-info">
                    <input type="checkbox" class="switch-input" name="tools_swtich" id="tools_required_checkbox"
                            {{ count($toolsIds) ? 'checked' : '' }} />
                    <span class="switch-toggle-slider">
                        <span class="switch-on"><i class="ti ti-check"></i></span>
                        <span class="switch-off"><i class="ti ti-x"></i></span>
                    </span>
                    <span class="switch-label">Requirement for Tools?</span>
                    </label>
                </div>

                {{-- Tool Selection --}}
                <div class="row g-6" id="tool_fields" style="{{ count($toolsIds) ? '' : 'display: none;' }}">
                    <div class="col-sm-12">
                    <label for="toolsSelect" class="form-label">Select Tools</label>
                    <select multiple id="selectTools" name="tools[]" class="form-select">
                        @foreach($tools as $tool)
                        <option value="{{ $tool->id }}" {{ in_array($tool->id, $toolsIds) ? 'selected' : '' }}>
                            {{ $tool->name }}
                        </option>
                        @endforeach
                    </select>
                    </div>
                </div>
                <div class="col-12 d-flex justify-content-between">
                    <button class="btn btn-secondary prev-btn" data-prev="tab2"><i class="ti ti-arrow-left ti-xs me-sm-2 me-0"></i>
                            <span class="align-middle d-sm-inline-block d-none">Previous</span></button>
                    <button class="btn btn-primary next-btn" data-next="tab4"><span class="align-middle d-sm-inline-block d-none me-sm-1 me-0">Next</span>
                        <i class="ti ti-arrow-right ti-xs"></i></button>
                </div>
            </div>
          </div>
          <div id="tab4" class="tab-content-section d-none">
            <div class="content-header mb-6">
              <h4 class="mb-0">Location and requirements </h4>
              <p> Here need to put the location of jobs and requirements</p>
            </div>
            <div class="row g-6">
                <div class="col-sm-6">
                    <label for="jobLocation" class="form-label">Job Location Type <span class="text-danger">*</span></label>
                    <select class="select2 form-select form-select-lg" name="jobLocation" id="jobLocation">
                        <option value='remote' {{ $job->remote ? 'selected' : '' }}>Remote – Work from anywhere</option>
                        <option value="onsite" {{ $job->onsite ? 'selected' : '' }}>On Site – Specific physical location</option>
                    </select>
                </div>
                <div class="col-sm-6">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" name="address" id="autocomplete_address" class="form-control" value="{{ $job->address }}" placeholder="Full street address for job site">
                </div>
                <div class="col-sm-6">
                    <label for="country" class="form-label">Country</label>
                    <input type="text" id="country" name="country" class="form-control" value="{{ $job->country }}" placeholder="e.g. USA, ">
                </div>

                
                <div class="col-sm-6">
                    <label for="state" class="form-label">State</label>
                    <input type="text" id="state" name="state" class="form-control" value="{{ $job->state }}" placeholder="e.g. State">
                </div>
                <div class="col-sm-6">
                    <label for="city" class="form-label">City</label>
                    <input type="text" id="city" name="city" class="form-control" value="{{ $job->city }}" placeholder="e.g. City">
                </div>
                
                <div class="col-sm-6">
                    <label for="zip" class="form-label">Zip Code</label>
                    <input type="text" name="zip" id="zipcode" class="form-control" value="{{ $job->zip }}" placeholder="e.g. 90001">
                </div>

                <div class="col-sm-12 ">
                    <input type="hidden" id="latitude" name="latitude" value="{{ $job->latitude }}">
                    <input type="hidden" id="longitude" name="longitude" value="{{ $job->longitude }}">
                    <div id="map" style="height: 300px;"></div>
                </div>

                <div class="col-sm-6">
                    <label for="radius" class="form-label">Work Radius</label>
                    <input type="text" name="radius" id="radius" class="form-control" value="{{ $job->radius }}" placeholder="Max distance contractor can be from job">
                </div>
                <div class="col-sm-6">
                    <label for="payment_terms" class="form-label">Payment Terms</label>
                    <input type="text" name="payment_terms" id="payment_terms" class="form-control" value="{{ $job->payment_terms }}" placeholder="Payment Terms">
                </div>
              <div class="col-sm-12">
                <label class="switch switch-info">
                    <input type="hidden" name="nda_agreement_switch" value="0">
                    <input type="checkbox" class="switch-input" name="nda_agreement_switch" id="nda_agreement_required_checkbox" value="1" {{ $job->nda_agrement ? 'checked' : '' }}>
                    <span class="switch-toggle-slider">
                        <span class="switch-on"><i class="ti ti-check"></i></span>
                        <span class="switch-off"><i class="ti ti-x"></i></span>
                    </span>
                    <span class="switch-label">NDA Agreement</span>
                </label>
                @if(auth()->user() && auth()->user()->type === 'superadmin')
                   <label class="switch switch-success">
                    <input type="radio" class="switch-input" name="superadmin_switch" value="open" {{ $job->open ? 'checked' : '' }}>
                    <span class="switch-toggle-slider">
                      <span class="switch-on"><i class="ti ti-check"></i></span>
                      <span class="switch-off"><i class="ti ti-x"></i></span>
                    </span>
                    <span class="switch-label">Open</span>
                  </label>
                  <label class="switch switch-warning">
                    <input type="radio" class="switch-input" name="superadmin_switch" value="progress" {{ $job->in_progress ? 'checked' : '' }}>
                    <span class="switch-toggle-slider">
                      <span class="switch-on"><i class="ti ti-check"></i></span>
                      <span class="switch-off"><i class="ti ti-x"></i></span>
                    </span>
                    <span class="switch-label">In Progress</span>
                  </label>
                  <label class="switch switch-success">
                    <input type="radio" class="switch-input" name="superadmin_switch" value="completed" {{ $job->completed ? 'checked' : '' }}>
                    <span class="switch-toggle-slider">
                      <span class="switch-on"><i class="ti ti-check"></i></span>
                      <span class="switch-off"><i class="ti ti-x"></i></span>
                    </span>
                    <span class="switch-label">Completed</span>
                  </label>
                  <label class="switch switch-danger">
                    <input type="radio" class="switch-input" name="superadmin_switch" value="cancelled" {{ $job->cancelled ? 'checked' : '' }}>
                    <span class="switch-toggle-slider">
                      <span class="switch-on"><i class="ti ti-check"></i></span>
                      <span class="switch-off"><i class="ti ti-x"></i></span>
                    </span>
                    <span class="switch-label">Cancelled</span>
                  </label>
                @endif
              </div>
              <div class="col-sm-12">
                <label for="conditions" class="form-label">Terms and Condition</label>
                <textarea name="conditions" id="conditions" rows="4" class="form-control summernote editor">{{ old('conditions', strip_tags(htmlspecialchars_decode($job->conditions))) }}</textarea>
              </div>
              <div class="col-sm-12">
                <label for="terms_acceptance" class="form-label">Terms Acceptance Notice</label>
                <textarea name="terms_acceptance" id="terms_acceptance" rows="4" class="form-control summernote editor">{{ old('terms_acceptance', strip_tags(htmlspecialchars_decode($job->terms_acceptance))) }}</textarea>
              </div>
              <div class="col-12 d-flex justify-content-between">
                  <button class="btn btn-secondary prev-btn" data-prev="tab3"><i class="ti ti-arrow-left ti-xs me-sm-2 me-0"></i>
                    <span class="align-middle d-sm-inline-block d-none">Previous</span></button>
                    <button class="btn btn-success" type="submit" id="finalSubmit"><span class="align-middle d-sm-inline-block d-none me-sm-1 me-0" >Submit</span>
                      <i class="ti ti-arrow-right ti-xs"></i>
                    </button>
                </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection
@push('scripts')

<script src="{{ asset('assets/vendor/libs/cleavejs/cleave.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/cleavejs/cleave-phone.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/bs-stepper/bs-stepper.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/@form-validation/popular.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/@form-validation/bootstrap5.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/@form-validation/auto-focus.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/bloodhound/bloodhound.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/tagify/tagify.js') }}"></script>


<script src="{{ asset('assets/js/forms-typeahead.js') }}"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    let map, marker, autocomplete;
  
    function initGoogleAddressMap() {
      const input = document.getElementById("autocomplete_address");
      autocomplete = new google.maps.places.Autocomplete(input);
      autocomplete.setFields(["address_component", "geometry"]);
  
      const lat = parseFloat(document.getElementById("latitude").value) || 35.328149;
      const lng = parseFloat(document.getElementById("longitude").value) || -80.8128636;
      const center = { lat, lng };
  
      map = new google.maps.Map(document.getElementById("map"), {
        center: center,
        zoom: 13,
      });
  
      marker = new google.maps.Marker({
        position: center,
        map: map,
        draggable: true,
      });
  
      autocomplete.addListener("place_changed", function () {
        const place = autocomplete.getPlace();
        if (!place.geometry) return;
  
        const location = place.geometry.location;
        map.setCenter(location);
        marker.setPosition(location);
  
        document.getElementById("latitude").value = location.lat();
        document.getElementById("longitude").value = location.lng();
  
        fillAddressFields(place.address_components);
      });
  
      marker.addListener("dragend", function () {
        const pos = marker.getPosition();
        document.getElementById("latitude").value = pos.lat();
        document.getElementById("longitude").value = pos.lng();
      });
    }
  
    function fillAddressFields(components) {
      const getComponent = (type) =>
        components.find(c => c.types.includes(type))?.long_name || '';
  
      document.getElementById("country").value = getComponent("country");
      document.getElementById("state").value = getComponent("administrative_area_level_1");
      document.getElementById("city").value = getComponent("locality") || getComponent("administrative_area_level_2");
      document.getElementById("zipcode").value = getComponent("postal_code");
    }
  </script>
  
  <!-- Google Maps Script -->
  <script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDpAp8c4sU4fU8bxZyYVCuyEHBXT3Y3wjA&libraries=places&callback=initGoogleAddressMap"
    async defer>
  </script> 
<script>

$(document).ready(function () {
    $('#finalSubmit').on('click', function (e) {
    e.preventDefault(); // Prevent default button behavior

    const form = document.getElementById('multiForm');
    const formData = new FormData(form); // Automatically includes all form fields
    const actionUrl = $('#multiForm').attr('action'); // Must point to your update route like /jobs/{id}
    const csrfToken = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
        url: actionUrl,
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        headers: {
            'X-CSRF-TOKEN': csrfToken,
            'X-HTTP-Method-Override': 'PUT' // Spoof PUT request if using POST route with method override
        },
        success: function (response) {
            if (response.success === true) {
                Swal.fire({
                    title: 'Success!',
                    text: response.message || 'Job updated successfully.',
                    timer: 1500,
                    timerProgressBar: true,
                    toast: false,
                    icon: 'success'
                }).then(() => {
                    setTimeout(() => {
                        location.reload();
                    }, 1500);
                });
            } else {
                Swal.fire({
                    title: 'Error',
                    text: response.message || 'Something went wrong.',
                    icon: 'error'
                });
            }
        },
        error: function (xhr) {
            if (xhr.status === 422) {
                let errors = xhr.responseJSON.errors;
                let errorList = '';
                $.each(errors, function (key, messages) {
                    errorList += `<li>${messages[0]}</li>`;
                });

                Swal.fire({
                    title: 'Validation Failed',
                    html: `<ul style="text-align:left;">${errorList}</ul>`,
                    icon: 'error',
                    showConfirmButton: false
                });
            } else {
                Swal.fire({
                    title: 'Server Error',
                    text: 'An unexpected error occurred.',
                    icon: 'error'
                });
            }
        }
    });
});
   

    // Country → State (AJAX)
   

    // Job Location toggle
    toggleLocationFields();
    $('#jobLocation').on('change', toggleLocationFields);

    function toggleLocationFields() {
        let location = $('#jobLocation').val();
        if (location === 'remote') {
            $('#country, #state, #city, #address, #zip, #radius').closest('.col-sm-6').hide();
        } else {
            $('#country, #state, #city, #address, #zip, #radius').closest('.col-sm-6').show();
        }
    }

    // Preselect Superadmin radio
    let statusMap = {
        open: '{{ $job->open }}',
        progress: '{{ $job->in_progress }}',
        completed: '{{ $job->completed }}',
        cancelled: '{{ $job->cancelled }}'
    };

    $.each(statusMap, function (key, value) {
        if (value == '1') {
            $(`input[name="superadmin_switch"][value="${key}"]`).prop('checked', true);
        }
    });
});
$(document).ready(function () {
    ClassicEditor
        .create(document.querySelector('#description'))
        .catch(error => console.error(error));

    ClassicEditor
    .create(document.querySelector('#conditions'))
    .catch(error => {
        console.error(error);
    });
    ClassicEditor
    .create(document.querySelector('#terms_acceptance'))
    .catch(error => {
        console.error(error);
    });

        let endPicker;
    flatpickr("#start_date", {
        dateFormat: "Y-m-d",
        defaultDate: "{{ $job->start_date }}",
        onChange: function (selectedDates) {
            if (selectedDates.length > 0) {
                const minEndDate = new Date(selectedDates[0]);
                minEndDate.setDate(minEndDate.getDate() + 10);
                if (endPicker) {
                    endPicker.set("minDate", minEndDate);
                }
            }
        }
    });

    endPicker = flatpickr("#deadline", {
        dateFormat: "Y-m-d",
        defaultDate: "{{ $job->deadline }}"
    });


    // === Industry → Skills: Dependent AJAX Fetch ===
    $('#industry_id').on('change', function () {
        let industryId = $(this).val();
        let skillsDropdown = $('#selectpickerSelection');
        skillsDropdown.html('<option value="">Loading...</option>');

        if (industryId) {
            $.ajax({
                url: "{{ route('get.skills.by.industry') }}",
                type: 'GET',
                data: { industry_id: industryId },
                success: function (response) {
                    skillsDropdown.empty();
                    if (response.length > 0) {
                        $.each(response, function (i, skill) {
                            skillsDropdown.append(`<option value="${skill.id}">${skill.name}</option>`);
                        });

                        // Pre-select existing job skills
                        let selectedSkills = @json($job->skills->pluck('id'));
                        skillsDropdown.val(selectedSkills).trigger('change');
                    } else {
                        skillsDropdown.append('<option value="">No Skills Available</option>');
                    }
                },
                error: function () {
                    skillsDropdown.html('<option value="">Failed to load skills</option>');
                }
            });
        } else {
            skillsDropdown.html('<option value="">-- Select Skills --</option>');
        }
    });

    // Trigger change on page load to load initial skills
    $('#industry_id').trigger('change');
});

$(document).ready(function () {
  // === Pre-fill visibility if already selected ===
  if ($('#certificate_required_checkbox').is(':checked')) {
    $('#certificate_fields').show();
  }
  if ($('#test_required_checkbox').is(':checked')) {
    $('#test_fields').show();
  }
  if ($('#tools_required_checkbox').is(':checked')) {
    $('#tool_fields').show();
  }

  // === Toggle Certification Section ===
  $('#certificate_required_checkbox').on('change', function () {
    if ($(this).is(':checked')) {
      $('#certificate_fields').slideDown();
    } else {
      $('#certificate_fields').slideUp();
    }
  });

  // === Toggle Test Section ===
  $('#test_required_checkbox').on('change', function () {
    if ($(this).is(':checked')) {
      $('#test_fields').slideDown();
    } else {
      $('#test_fields').slideUp();
    }
  });

  // === Toggle Tool Section ===
  $('#tools_required_checkbox').on('change', function () {
    if ($(this).is(':checked')) {
      $('#tool_fields').slideDown();
    } else {
      $('#tool_fields').slideUp();
    }
  });

  // === Initialize Select2 ===
  $('#select_certificate').select2({
    placeholder: 'Select Certifications',
    allowClear: true,
    width: '100%'
  });

  $('#selectTools').select2({
    placeholder: 'Select Tools',
    allowClear: true,
    width: '100%'
  });

  $('.selectionTest').select2({
    placeholder: 'Select Tests',
    allowClear: false,
    width: '100%'
  });

  $('#jobLocation').select2({
    placeholder: 'Select Job Location',
    allowClear: false,
    width: '100%'
  });

  // === Dynamic Add/Remove Test Rows ===
  let testIndex = $('#test-wrapper .test-row').length;

  $('#add-test').on('click', function () {
    let testOptions = `@foreach($tests as $test)<option value="{{ $test->id }}">{{ $test->title }}</option>@endforeach`;

    let newRow = `
      <div class="row g-3 test-row mb-3 border p-3 rounded bg-light">
        <div class="col-md-6">
          <label class="form-label">Test Title</label>
          <select name="test[${testIndex}][test_id]" class="select2 form-select form-select-lg selectionTest">
            <option value="0">-- Please Select Test --</option>
            ${testOptions}
          </select>
        </div>
        <div class="col-md-4">
          <label class="form-label">Scoring Criteria</label>
          <input type="text" name="test[${testIndex}][scoring_criteria]" class="form-control" placeholder="e.g., Minimum 80%">
        </div>
        <div class="col-md-2 d-flex align-items-end">
          <button type="button" class="btn btn-outline-danger w-100 remove-test">
            <i class="ti ti-trash"></i> Remove
          </button>
        </div>
      </div>
    `;

    $('#test-wrapper').append(newRow);
    $('.selectionTest').select2({ placeholder: "Select Tests", width: '100%' });
    testIndex++;
  });

  // === Remove Test Row ===
  $(document).on('click', '.remove-test', function () {
    $(this).closest('.test-row').remove();
  });
});

function toggleRateFields() {
        let selectedType = $('#jobType').val();
        if (selectedType === 'hourly') {
            $('#hourly-rate-fields').show();
            $('#fixed-rate-fields').hide();
        } else if (selectedType === 'fixed') {
            $('#fixed-rate-fields').show();
            $('#hourly-rate-fields').hide();
        } else {
            $('#hourly-rate-fields').hide();
            $('#fixed-rate-fields').hide();
        }
    }
    $('#jobType').on('change', toggleRateFields);
    toggleRateFields(); // run on page load

$(document).ready(function () {
    $('#selectpickerSelection').select2({
        placeholder: "Select Skills",
        width: '100%'
    });
    $('#industry_id').select2({
        placeholder: "Select Industry",
        width: '100%'
    });
    $('#jobType').select2({
        placeholder: "Select Job Type",
        width: '100%'
    });
    function switchTab(tabId) {
        $('.tab-content-section').addClass('d-none');
        $('#' + tabId).removeClass('d-none');
        $('#tabList .nav-link').removeClass('active');
        $('#tabList .nav-link[data-tab="' + tabId + '"]').addClass('active');
    }

    $('.next-btn').click(function () {
        let next = $(this).data('next');
        switchTab(next);
    });

    $('.prev-btn').click(function () {
        let prev = $(this).data('prev');
        switchTab(prev);
    });

    $('#tabList .nav-link').click(function (e) {
        e.preventDefault();
        const tab = $(this).data('tab');
        switchTab(tab);
    });

});


</script>

@endpush