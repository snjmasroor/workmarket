
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
    background-color: #ffffff;
    border: 1px solid #e4e4e4;
    border-radius: 0.75rem;
    padding: 2rem;
    box-shadow: 0 2px 16px rgba(0, 0, 0, 0.04);
  }

  #tab1 .content-header h5 {
    font-weight: 600;
    font-size: 1.25rem;
  }

  #tab1 .content-header p {
    color: #6c757d;
    margin-bottom: 1.5rem;
  }

  #tab1 label.form-label {
    font-weight: 500;
    color: #343a40;
  }

  #tab1 .form-control,
  #tab1 .form-select {
    border-radius: 0.5rem;
    transition: border-color 0.2s ease;
  }

  #tab1 .form-control:focus,
  #tab1 .form-select:focus {
    border-color: #0d6efd;
    box-shadow: none;
  }

  #tab1 .btn {
    padding: 0.6rem 1.5rem;
    font-weight: 500;
  }

  .next-btn i,
  .btn-prev i {
    vertical-align: middle;
  }

  #tab1 .col-sm-6,
  #tab1 .col-md-12 {
    margin-bottom: 1rem;
  }

  #tab1 textarea.form-control {
    min-height: 130px;
    resize: vertical;
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
      <form onSubmit="return false" id="multiForm" action="{{ route('job.store') }}" method="POST" enctype="multipart/form-data">
        <ul class="nav nav-tabs custom-tabs mb-4" id="tabList" role="tablist">
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
          <div class="content-header mb-4">
            <h5 class="mb-1">Job Basic Information</h5>
            <p class="mb-0">The official name or designation of the job role. This should be clear and descriptive.</p>
          </div>

          <div class="row g-4">
            <div class="col-sm-6">
              <label class="form-label" for="jobTitle">Job Title</label>
              <input type="text" name="title" id="jobTitle" class="form-control" placeholder="e.g PHP Developer" />
            </div>

            <div class="col-sm-6">
              <label for="industry_id" class="form-label">Industry <span class="text-danger">*</span></label>
              <select name="industry_id" id="industry_id" class="select2 form-select form-select-lg">
                @foreach($industries as $industry)
                  <option value="{{ $industry->id }}">{{ $industry->name }}</option>
                @endforeach
              </select>
              @error('industry_id')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="col-sm-6">
              <label class="form-label" for="skill">Select Skills</label>
              <select id="selectpickerSelection" class="select2 form-select form-select-lg" name="skill_ids[]" multiple>
                <option value="">Select Skills</option>
              </select>
              @error('skill_ids')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="col-sm-6">
              <label for="jobType" class="form-label">Job Type <span class="text-danger">*</span></label>
              <select class="select2 form-select form-select-lg @error('jobType') is-invalid @enderror" name="jobType" id="jobType">
                <option value=''>Please select the Job Type</option>
                <option value='fixed'>Fixed – One-time payment</option>
                <option value="hourly">Hourly – Pay based on time worked</option>
              </select>
            </div>

            <div class="col-sm-6">
              <label class="form-label" for="budget">Budget</label>
              <input id="budget" type="number" step="0.01" name="budget" class="form-control" placeholder="e.g: 1 or 1.5" />
            </div>

            <div class="col-sm-6" id="fixed-rate-fields">
              <label class="form-label" for="fixed_rate">Fixed Amount</label>
              <input type="number" step="0.01" id="fixed_rate" name="fixed_rate" class="form-control" placeholder="e.g 100, 100.50" />
            </div>

            <div class="col-sm-6" id="hourly-rate-fields">
              <label class="form-label" for="hourly_rate">Hourly Rate</label>
              <input type="number" step="0.01" id="hourly_rate" name="hourly_rate" class="form-control" placeholder="e.g 100, 100.50" />
            </div>

            <div class="col-sm-6">
              <label class="form-label" for="estimated_hours">Estimated Hours</label>
              <input type="text" id="estimated_hours" name="estimated_hours" class="form-control" placeholder="Estimated Hours" maxlength="2" />
            </div>

            <div class="col-sm-6">
              <label class="form-label" for="start_date">Application Start Date</label>
              <input type="text" id="start_date" name="start_date" class="form-control" placeholder="Start Date" />
            </div>

            <div class="col-sm-6">
              <label class="form-label" for="deadline">Application Deadline</label>
              <input type="text" id="deadline" name="deadline" class="form-control" placeholder="Deadline Date" />
            </div>

            <div class="col-md-12">
              <label class="form-label" for="description">Description</label>
              <textarea name="description" id="description" rows="4" class="form-control summernote editor">{{ old('description') }}</textarea>
            </div>

            <div class="col-12 d-flex justify-content-between mt-2">
              <button class="btn btn-label-secondary btn-prev" disabled>
                <i class="ti ti-arrow-left ti-xs me-sm-2 me-0"></i>
                <span class="align-middle d-sm-inline-block d-none">Previous</span>
              </button>
              <button class="btn btn-primary next-btn" data-next="tab2">
                <span class="align-middle d-sm-inline-block d-none me-sm-1 me-0">Next</span>
                <i class="ti ti-arrow-right ti-xs"></i>
              </button>
            </div>
          </div>
        </div>
          <div id="tab2" class="tab-content-section d-none">
            <div class="content-header mb-4">
              <h5 class="mb-1">Job Education Requirement</h5>
              <p class="mb-0">This information helps employers assess a candidate's qualifications</p>
            </div>

            <div class="row g-4">
              <div class="col-sm-6">
                <label class="form-label" for="education_level">Minimum Qualification</label>
                <input type="text" name="education_level" id="education_level" class="form-control" placeholder="e.g. Bachelor's Degree, Diploma" />
              </div>

              <div class="col-sm-6">
                <label class="form-label" for="min_years_experience">Minimum Experience</label>
                <input type="number" step="0.01" name="min_years_experience" id="min_years_experience" class="form-control" placeholder="e.g. 2, 3.5, 5" />
              </div>

              <div class="col-sm-6">
                <label class="form-label" for="field_of_study">Field of Study</label>
                <input type="text" name="field_of_study" id="field_of_study" class="form-control" placeholder="e.g. Computer Science, Business, Engineering" />
              </div>

              <div class="col-sm-6">
                <label class="form-label" for="language">Language</label>
                <input type="text" name="language" id="language" class="form-control" placeholder="e.g. English, French, Chinese" />
              </div>

              <div class="col-12 d-flex justify-content-between mt-2">
                <button class="btn btn-label-secondary prev-btn" data-prev="tab1">
                  <i class="ti ti-arrow-left ti-xs me-sm-2 me-0"></i>
                  <span class="align-middle d-sm-inline-block d-none">Previous</span>
                </button>
                <button class="btn btn-primary next-btn" data-next="tab3">
                  <span class="align-middle d-sm-inline-block d-none me-sm-1 me-0">Next</span>
                  <i class="ti ti-arrow-right ti-xs"></i>
                </button>
              </div>
            </div>
          </div>
          <div id="tab3" class="tab-content-section d-none">
            <div class="content-header mb-4">
              <h5 class="mb-1">Certification, Test and Tools</h5>
              <p class="mb-0">This section includes your Certifications, Required Tests, and Tools proficiency—all in one place for easy review.</p>
            </div>

            <div class="row g-4">
              <!-- Certification Toggle -->
              <div class="col-sm-6">
                <label class="switch switch-info">
                  <input type="checkbox" class="switch-input" name="certificate_swtich" id="certificate_required_checkbox" />
                  <span class="switch-toggle-slider">
                    <span class="switch-on"><i class="ti ti-check"></i></span>
                    <span class="switch-off"><i class="ti ti-x"></i></span>
                  </span>
                  <span class="switch-label">Requirement for Certification?</span>
                </label>
              </div>

              <!-- Certificate Fields -->
              <div class="row g-4" id="certificate_fields" style="display: none;">
                <div class="col-sm-12">
                  <label for="select_certificate" class="form-label">Select Certifications</label>
                  <select multiple id="select_certificate" name="certifications[]" class="form-select">
                    <!-- Certification options populated dynamically -->
                  </select>
                </div>
              </div>

              <!-- Test Toggle -->
              <div class="col-sm-6">
                <label class="switch switch-info">
                  <input type="checkbox" class="switch-input" name="test_swtich" id="test_required_checkbox" />
                  <span class="switch-toggle-slider">
                    <span class="switch-on"><i class="ti ti-check"></i></span>
                    <span class="switch-off"><i class="ti ti-x"></i></span>
                  </span>
                  <span class="switch-label">Requirement for Test?</span>
                </label>
              </div>

              <!-- Test Fields -->
              <div class="row" id="test_fields" style="display: none;">
                <div class="col-12">
                  <div class="card shadow-sm rounded-3 p-4">
                    <h5 class="card-title mb-3">Required Tests</h5>

                    <div id="test-wrapper">
                      <div class="row g-3 test-row mb-3 rounded p-3 bg-light">
                        <div class="col-md-6">
                          <label class="form-label">Test Title</label>
                          <select name="test[0][test_id]" class="select2 form-select form-select-lg selectionTest">
                            <option value="0">-- Please Select Test --</option>
                            @foreach($tests as $test)
                              <option value="{{ $test->id }}">{{ $test->title }}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="col-md-4">
                          <label class="form-label">Scoring Criteria</label>
                          <input type="text" name="test[0][scoring_criteria]" class="form-control" placeholder="e.g., Minimum 80%">
                        </div>
                        <div class="col-md-2 d-flex align-items-end">
                          <button type="button" class="btn btn-outline-danger w-100 remove-test">
                            <i class="ti ti-trash"></i> Remove
                          </button>
                        </div>
                      </div>
                    </div>

                    <div class="d-flex justify-content-end">
                      <button type="button" class="btn btn-primary mt-2" id="add-test">
                        <i class="ti ti-plus"></i> Add Another Test
                      </button>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Tool Toggle -->
              <div class="col-sm-6">
                <label class="switch switch-info">
                  <input type="checkbox" class="switch-input" name="tools_swtich" id="tools_required_checkbox" />
                  <span class="switch-toggle-slider">
                    <span class="switch-on"><i class="ti ti-check"></i></span>
                    <span class="switch-off"><i class="ti ti-x"></i></span>
                  </span>
                  <span class="switch-label">Requirement for Tools?</span>
                </label>
              </div>

              <!-- Tool Fields -->
              <div class="row g-4" id="tool_fields" style="display: none;">
                <div class="col-sm-12">
                  <label for="selectTools" class="form-label">Select Tools</label>
                  <select multiple id="selectTools" name="tools[]" class="form-select">
                    <!-- Tool options will be injected here -->
                  </select>
                </div>
              </div>

              <!-- Navigation Buttons -->
              <div class="col-12 d-flex justify-content-between mt-2">
                <button class="btn btn-label-secondary prev-btn" data-prev="tab2">
                  <i class="ti ti-arrow-left ti-xs me-sm-2 me-0"></i>
                  <span class="align-middle d-sm-inline-block d-none">Previous</span>
                </button>
                <button class="btn btn-primary next-btn" data-next="tab4">
                  <span class="align-middle d-sm-inline-block d-none me-sm-1 me-0">Next</span>
                  <i class="ti ti-arrow-right ti-xs"></i>
                </button>
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
                <select class="select2 form-select form-select-lg @error('jobLocation') is-invalid @enderror" name="jobLocation" id="jobLocation"
                >
                  <option value='remote'>Remote – Work from anywhere</option>
                  <option value="onsite">On Site – Specific physical location</option>
                </select>
              </div>
              <div class="col-sm-6 ">
                <label for="address" class="form-label">Address</label>
                <input id="autocomplete_address" name="address" type="text" class="form-control" placeholder="Start typing address..." />
                @error('address')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <!-- Map -->
              </div>
              
              <div class="col-sm-6">
                <label for="country" class="form-label">Country</label>
                <input id="country" type="text" name="country" class="form-control"  />
              </div>
              
              <div class="col-sm-6">
                <label for="country" class="form-label">State </label>
                <input id="state" type="text" name="state" class="form-control"  />
               
              </div>
              <div class="col-sm-6">
                  <label for="state" class="form-label">City </label>
                  <input id="city" type="text" name="city" class="form-control"  />
                  
              </div>
              
              <div class="col-sm-6 ">
                  <label for="zip" class="form-label">Zip Code</label>
                  <input type="text" id="zipcode" name="zip" placeholder="Zip Code" class="form-control" />
                 
              </div>
              <div class="col-sm-12 ">
                <input id="latitude" type="hidden" name="latitude" />
                <input id="longitude" type="hidden" name="longitude" />
                <div id="map" style="height: 300px;"></div>
            </div>
              <div class="col-sm-6 ">
                <label for="radius" class="form-label">Work Radius</label>
                <input type="text" name="radius" id="radius" class="form-control @error('radius') is-invalid @enderror" placeholder="Max distance contractor can be from job" 
                >
              
              </div>
              <div class="col-sm-6 ">
                <label for="radius" class="form-label">Payment Terms</label>
                <input type="text" name="payment_terms" id="payment_terms" class="form-control @error('payment_terms') is-invalid @enderror" placeholder=" Payment Terms">
                @error('radius')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="col-sm-12">

                <label class="switch switch-info">
                  <!-- This always sends 0 when checkbox is off -->
                  <input type="hidden" name="nda_agreement_switch" value="0">
              
                  <!-- This overrides the value to 1 if checked -->
                  <input type="checkbox" class="switch-input" name="nda_agreement_switch" id="nda_agreement_required_checkbox" value="1" />
              
                  <span class="switch-toggle-slider">
                      <span class="switch-on">
                          <i class="ti ti-check"></i>
                      </span>
                      <span class="switch-off">
                          <i class="ti ti-x"></i>
                      </span>
                  </span>
                  <span class="switch-label">NDA Agreement</span>
              </label>
                @if(auth()->user() && auth()->user()->type === 'superadmin')
                <label class="switch switch-success">
                  <input type="radio" class="switch-input" name="superadmin_switch" id="open_required_checkbox" value="open"/>
                  <span class="switch-toggle-slider">
                    <span class="switch-on">
                      <i class="ti ti-check"></i>
                    </span>
                      <span class="switch-off">
                        <i class="ti ti-x"></i>
                      </span>
                    </span>
                    <span class="switch-label">Open</span>
                  </label>
                  <label class="switch switch-waring">
                    <input type="radio" class="switch-input" name="superadmin_switch" id="pregress_required_checkbox" value="progress"/>
                    <span class="switch-toggle-slider">
                      <span class="switch-on">
                        <i class="ti ti-check"></i>
                      </span>
                        <span class="switch-off">
                          <i class="ti ti-x"></i>
                        </span>
                      </span>
                      <span class="switch-label">In Progress</span>
                    </label>
                    <label class="switch switch-success">
                      <input type="radio" class="switch-input" name="superadmin_switch" id="pregress_required_checkbox" value="completed"/>
                      <span class="switch-toggle-slider">
                        <span class="switch-on">
                          <i class="ti ti-check"></i>
                        </span>
                          <span class="switch-off">
                            <i class="ti ti-x"></i>
                          </span>
                        </span>
                        <span class="switch-label">Completed</span>
                      </label>
                      <label class="switch switch-danger">
                        <input type="radio" class="switch-input" name="superadmin_switch" id="pregress_required_checkbox" value="cancelled"/>
                        <span class="switch-toggle-slider">
                          <span class="switch-on">
                            <i class="ti ti-check"></i>
                          </span>
                            <span class="switch-off">
                              <i class="ti ti-x"></i>
                            </span>
                          </span>
                          <span class="switch-label">Cancelled</span>
                        </label>
                @endif
              </div>
              <div class="col-sm-12 ">
                <label for="radius" class="form-label">Terms and Condition</label>
                <textarea name="conditions" id="conditions" rows="4" cols="5" class="form-control summernote editor @error('conditions') is-invalid @enderror" placeholder="Conditions such as tools required, work hours, etc.">{{ old('conditions', $job->conditions ?? '') }}</textarea>
                @error('conditions')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="col-sm-12 ">
                <label for="terms_acceptance" class="form-label">Terms Acceptance Notice</label>
                <textarea name="terms_acceptance" id="terms_acceptance" rows="4" cols="5" class="form-control summernote editor @error('terms_acceptance') is-invalid @enderror" placeholder="Add disclaimer or acceptance requirement before applying">{{ old('terms_acceptance', $job->terms_acceptance ?? '') }}</textarea>
                @error('terms_acceptance')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
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
  // This function must be globally accessible
  function initGoogleAddressMap() {
    const input = document.getElementById("autocomplete_address");
    autocomplete = new google.maps.places.Autocomplete(input);
    autocomplete.setFields(["address_component", "geometry"]);

    map = new google.maps.Map(document.getElementById("map"), {
      center: { lat: 37.7749, lng: -122.4194 },
      zoom: 13,
    });

    marker = new google.maps.Marker({
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
      // Clear fields first
      document.getElementById("country").value = "";
      document.getElementById("state").value = "";
      document.getElementById("city").value = "";
      document.getElementById("zipcode").value = "";

      // Extract address components
      const addressComponents = place.address_components;
      addressComponents.forEach((component) => {
        const types = component.types;
        if (types.includes("country")) {
          document.getElementById("country").value = component.long_name;
        } else if (types.includes("administrative_area_level_1")) {
          document.getElementById("state").value = component.long_name;
        } else if (types.includes("locality")) {
          document.getElementById("city").value = component.long_name;
        } else if (types.includes("postal_code")) {
          document.getElementById("zipcode").value = component.long_name;
        }
      });
    });
    marker.addListener("dragend", function () {
      const pos = marker.getPosition();
      document.getElementById("latitude").value = pos.lat();
      document.getElementById("longitude").value = pos.lng();
    });
  }
</script>

<!-- Important: this must come AFTER the function above -->
<script
  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDpAp8c4sU4fU8bxZyYVCuyEHBXT3Y3wjA&libraries=places&callback=initGoogleAddressMap"
  async defer>
</script>
<script>
$(document).ready(function () {

  // ckeditor classes
  document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.editor').forEach(function (el) {
      ClassicEditor
        .create(el)
        .catch(error => {
          console.error('CKEditor init error:', error);
        });
    });
  });
  
  let endPicker;
  flatpickr("#start_date", {
    dateFormat: "Y-m-d",
    onChange: function (selectedDates, dateStr, instance) {
      if (selectedDates.length > 0) {
        const minEndDate = new Date(selectedDates[0]);
        minEndDate.setDate(minEndDate.getDate() + 10); // add 10 days
        if (endPicker) {
          endPicker.set("minDate", minEndDate);
        }
      }
    }
  });
  endPicker = flatpickr("#deadline", {
    dateFormat: "Y-m-d"
  });
  $('#select_certificate').select2({
        placeholder: 'Select Certifications', // <--- Change this line
        allowClear: true,
    });

    
  const finalbasbaseUrlCertificationeUrl = "{{ route('user.get.certifications') }}";
  
  let currentPage = 1;

function fetchCertifications(page = 1) {
    fetch(`${finalbasbaseUrlCertificationeUrl}?page=${page}&per_page=100`)
        .then(response => response.json())
        .then(data => {
          const select = document.getElementById('select_certificate');
            select.innerHTML = ''; // Clear existing options

            data.data.forEach(cert => {
                const option = document.createElement('option');
                option.value = cert.id;
                option.text = cert.name;
                select.appendChild(option);
            }); // The actual certification items
            console.log(data.current_page); // Current page number
            console.log(data.last_page); // Total pages
            // Now populate your frontend accordingly
        });
}

$('#selectTools').select2({
    placeholder: 'Select Tools', // <--- Change this line
    allowClear: true,
});

    
  const finalToolsURL = "{{ route('user.get.tools') }}";
  

function fetchTools(page = 1) {
    fetch(`${finalToolsURL}?page=${page}&per_page=100`)
        .then(response => response.json())
        .then(data => {
          const select = document.getElementById('selectTools');
            select.innerHTML = ''; // Clear existing options

            data.data.forEach(cert => {
                const option = document.createElement('option');
                option.value = cert.id;
                option.text = cert.name;
                select.appendChild(option);
            }); // The actual certification items
            console.log(data.current_page); // Current page number
            console.log(data.last_page); // Total pages
            // Now populate your frontend accordingly
        });
}

fetchCertifications(); // Initial load
fetchTools(); // Initial load
 

  $('#finalSubmit').on('click', function () {
        
        $('#multiForm').on('submit', function (e) {
        e.preventDefault();
          const form = document.getElementById('multiForm');
          const formData = new FormData(form); // Automatically includes all inputs including file

          const actionUrl = $(this).attr('action'); // Replace with your actual route
          const csrfToken = $('meta[name="csrf-token"]').attr('content');
      
          $.ajax({
              url: actionUrl,
              type: 'POST',
              data: formData,
              contentType: false, // Important for file upload
              processData: false, // Important for file upload
              headers: {
                  'X-CSRF-TOKEN': csrfToken
              },
              success: function (response) {
                console.log(response);
                if (response.success == true) {
                    Swal.fire({
                        title: 'Success!',
                        text: response.message,
                        timer: 1500,
                        timerProgressBar: true,
                        toast: false,
                        icon: 'success'
                    }).then(() => {
                          $('#multiForm')[0].reset();

                          setTimeout(function () {
                            location.reload();
                        }, 1500);
                      });
                    } else if (response.success !== true) {
                    // Laravel-level exception or manually returned error
                    let errorText = response.message;
                    if (response.error) {
                        errorText += `\n${response.error}`;
                    }

                    Swal.fire({
                        title: 'Error',
                        text: errorText,
                        showConfirmButton: false,
                        icon: 'error'
                    });
                }
              },
              error: function (xhr, status, error) {
                  if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    let errorList = '';
                    $.each(errors, function (key, messages) {
                        errorList += `<li>${messages[0]}</li>`;
                    });

                    Swal.fire({
                        title: 'Validation Failed',
                        showConfirmButton: false,
                        html: `<ul style="text-align:left;">${errorList}</ul>`,
                        icon: 'error'
                    });
                }
              }
          });
        });
      });


    
    // var baseUrl = "{{ route('user.get.states', ['country' => '0']) }}";
    // $('#country').on('change', function () {
    //     var countryCode = $(this).val();
       
    //     var finalUrl = baseUrl + countryCode;
    //     console.log(finalUrl);

    //     $.ajax({
    //         url: finalUrl,
    //         method: 'GET',
    //         success: function (data) {
    //             var $stateSelect = $('#state');
    //             $stateSelect.empty().append('<option value="">Select State</option>');

    //            $.each(data, function (index, state) {
    //                 $stateSelect.append('<option value="' + state.id + '">' + state.name + '</option>');
    //             });
    //         },
    //         error: function () {
    //             alert('Unable to fetch states. Please try again.');
    //         }
    //     });
    // });



    
  
  

  let toolIndex = 1;
  let testIndex = 1;

let testOptions = `@foreach($tests as $test)<option value="{{ $test->id }}">{{ $test->title }}</option>@endforeach`;

function getSelectedTestIds() {
    const ids = [];
    $('#test-wrapper .select2').each(function () {
        const val = $(this).val();
        if (val && val !== "0") {
            ids.push(val);
        }
    });
    return ids;
}
function generateFilteredTestOptions() {
    const selectedIds = getSelectedTestIds();
    let options = `<option value="0">-- Please Select Test --</option>`;
    
    @foreach($tests as $test)
        if (!selectedIds.includes("{{ $test->id }}")) {
            options += `<option value="{{ $test->id }}">{{ $test->title }}</option>`;
        }
    @endforeach

    return options;
}
function initSelect2() {
    $('#test-wrapper .select2').select2({
        placeholder: "Select Tests",
        allowClear: false,
        width: '100%'
    });
}

 initSelect2();

    $("#add-test").on('click', function () {
        const filteredOptions = generateFilteredTestOptions();

        const testHTML = `
            <div class="row g-3 test-row mb-3 border p-3 rounded bg-light">
                <div class="col-md-6">
                    <label class="form-label">Test Title</label>
                    <select name="test[${testIndex}][test_id]" class="select2 form-select form-select-lg">
                        ${filteredOptions}
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

        $('#test-wrapper').append(testHTML);
        initSelect2();
        testIndex++;
    });

    // Remove test row and refresh options
    $(document).on('click', '.remove-test', function () {
        $(this).closest('.test-row').remove();
    });
  
    $('#industry_id').select2({
        placeholder: "Select Industry",
        width: '100%'
    });
    $('#selectpickerSelection').select2({
        placeholder: "Select Skills",
        width: '100%'
    });
    $('#industry_id').on('change', function () {
      var industryId = $(this).val();
      

      $('#selectpickerSelection').html('<option value="">Loading...</option>');

      if (industryId) {
        $.ajax({
          url: '{{ route("get.skills.by.industry") }}',
          type: 'GET',
          data: { industry_id: industryId },
          success: function (response) {
            $('#selectpickerSelection').empty();
            if (response.length > 0) {
              $.each(response, function (key, skill) {
                $('#selectpickerSelection').append('<option value="' + skill.id + '">' + skill.name + '</option>');
              });
            } else {
              $('#selectpickerSelection').append('<option value="">No Skills Available</option>');
            }
          }
        });
      } else {
        $('#selectpickerSelection').html('<option value="">-- Select Skill --</option>');
      }
    });

    
    $('#test_required_checkbox').on('change', function () {
      if ($(this).is(':checked')) {
        
        $('#test_fields').slideDown();
      } else {
        $('#test_fields').slideUp();
      }
    });
    $('#tools_required_checkbox').on('change', function () {
      if ($(this).is(':checked')) {
        $('#tool_fields').slideDown();
      } else {
        $('#tool_fields').slideUp();
      }
    });

    $('#certificate_required_checkbox').on('change', function () {
      if ($(this).is(':checked')) {
        $('#certificate_fields').slideDown();
      } else {
        $('#certificate_fields').slideUp();
      }
    });

  // Run once on page load (e.g. when editing a job)
  $('#test_required_checkbox').trigger('change');
  $('#tools_required_checkbox').trigger('change');
  });
</script>
<script>
   $(document).ready(function () {
    $('#jobType').select2({
        placeholder: "Select Job Type",
        width: '100%'
    });
    $('#jobLocation').select2({
        placeholder: "Select Job Location Type",
        width: '100%'
    });
    
    
    $('#jobType').on('change', function () {
        if ($(this).val() === 'hourly') {
            $('#hourly-rate-fields').show();
            $('#fixed-rate-fields').hide();
        } else {
            $('#fixed-rate-fields').show();
            $('#hourly-rate-fields').hide();
        }
    });
});
</script>
<script>
    ClassicEditor
        .create(document.querySelector('#description'))
        .catch(error => {
            console.error(error);
        });
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
        ClassicEditor
        .create(document.querySelector('#description1'))
        .catch(error => {
            console.error(error);
        });

        $(document).ready(function () {
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