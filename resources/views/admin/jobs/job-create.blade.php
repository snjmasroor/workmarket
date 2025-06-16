
@extends('layouts.backend.master') 
@push('styles')
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/bs-stepper/bs-stepper.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/bootstrap-select/bootstrap-select.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/@form-validation/form-validation.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/tagify/tagify.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/page-auth.css') }}" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

@endpush 
@section('page-content') 
<div class="d-flex col-lg-12 align-items-center justify-content-center authentication-bg px-9">
  <div class="w-px-800">
    <div id="multiStepsValidation" class="bs-stepper border-none shadow-none mt-5">
      <form onSubmit="return false">
        <ul class="nav nav-tabs mb-3" id="tabList">
          <li class="nav-item">
            <a class="nav-link active" data-tab="tab1" href="#"><span class="bs-stepper-circle"><i class="ti ti-file-analytics ti-md"></i></span>
              <span class="bs-stepper-label">
                <span class="bs-stepper-title">Basic Job Detail</span>
                
              </span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-tab="tab2" href="#"><span class="bs-stepper-circle"><i class="ti ti-user ti-md"></i></span>
              <span class="bs-stepper-label">
                <span class="bs-stepper-title">Education Detail</span>
                
              </span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-tab="tab3" href="#"><span class="bs-stepper-circle"><i class="ti ti-credit-card ti-md"></i></span>
              <span class="bs-stepper-label">
                <span class="bs-stepper-title">Certifications Tools and Test</span>
              </span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-tab="tab4" href="#"><span class="bs-stepper-circle"><i class="ti ti-shield-check ti-md"></i></span>
              <span class="bs-stepper-label">
                <span class="bs-stepper-title">Location and Requirement</span>
              </span></a>
          </li>
          </ul>
          <div id="tab1" class="tab-content-section">
            <div class="content-header mb-6">
              <h5 class="mb-0">Job Basic Information</h5>
              <p>The official name or designation of the job role, This should be clear and descriptive.</p>
            </div>
            <div class="row g-6">
              <div class="col-sm-6">
                <label class="form-label" for="jobTitle">Job Title</label>
                <input type="text" name="title" id="jobTitle" class="form-control" placeholder="e.g PHP Developer" />
              </div>
              <div class="col-sm-6">
                  <label for="industry_id" class="form-label">Industry <span class="text-danger">*</span></label>
                  <select data-allow-clear="true" name="industry_id" id="industry_id" class="select2 form-select form-select-lg @error('industry_id') is-invalid @enderror" required>
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
                <select data-allow-clear="true" id="selectpickerSelection" class="select2 form-select form-select-lg" data-style="btn-default" name="skill_ids[]" multiple data-max-options="10">
                  <option value="">Select Skills</option>
                </select>
                @error('skill_ids')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="col-sm-6 ">
                <label for="jobType" class="form-label">Job Type <span class="text-danger">*</span></label>
                <select data-allow-clear="true" class="select2 form-select form-select-lg @error('jobType') is-invalid @enderror" name="jobType" id="jobType" required>
                  <option value=''>Please select the Job Type</option>
                  <option value='fixed' {{ old('jobType', $job->jobType ?? '') == 'fixed' ? 'selected' : '' }}>Fixed – One-time payment</option>
                  <option value="hourly" {{ old('jobType', $job->jobType ?? '') == 'hourly' ? 'selected' : '' }}>Hourly – Pay based on time worked</option>
                </select>
              </div>
              <div class="col-sm-6">
                <label class="form-label" for="budget">Budget</label>
                <input id="budget" type="number" step="0.01" name="budget" class="form-control" placeholder="e.g: 1 or 1.5" />
              </div>
              <div class="col-sm-6" id="fixed-rate-fields">
                <label class="form-label" for="fixed_rate">Fixed Amount</label>
                <input type="number" step="0.01" id="fixed_rate" name="fixed_rate" class="form-control" placeholder="e.g 100, 100.50"/>
              </div>
              <div class="col-sm-6" id="hourly-rate-fields">
                <label class="form-label" for="hourly_rate">Hourly Rate</label>
                <input type="number" step="0.01" id="hourly_rate" name="hourly_rate" class="form-control multi-steps-mobile" placeholder="e.g 100, 100.50" />
              </div>
              <div class="col-sm-6">
                <label class="form-label" for="estimated_hours">Estimated Hours</label>
                <input type="text" id="estimated_hours" name="estimated_hours" class="form-control" placeholder="Estimated Hours" maxlength="2" />
              </div>
              <div class="col-sm-6">
                <label class="form-label" for="start_date">Application Start Date</label>
                <input type="text" id="start_date" name="start_date" class="form-control " placeholder="Start Date" />
              </div>
              <div class="col-sm-6">
                <label class="form-label" for="deadline">Application Deadline</label>
                <input type="text" id="deadline" name="deadline" class="form-control" placeholder="Deadline Date" />
              </div>
              <div class="col-md-12">
                <label class="form-label" for="estimated_hours">Description</label>
                <textarea name="description" id="description" rows="4" cols="5" class="form-control summernote">{{ old('description') }}</textarea>
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
              <div class="row g-6">
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
            <div class="row g-6">
              
              <div class="mb-3">
                <div id="certificate-wrapper">
                  <div class="row g-3 certificate-row mb-2">
                    <div class="col-md-6">
                      <label class="form-label">Certification Name</label>
                      <select  name="certificate[0][]" id="" class="select2 form-select form-select-lg">
                        @foreach($certificates as $certification)
                          <option value="{{ $certification->id }}">{{ $certification->name }}</option>
                        @endforeach
                      </select>
                     
                    </div>
                    
                    <div class="col-md-4">
                      <label class="form-label">Short Description</label>
                      <input type="text" name="certificate[0][description]" class="form-control" placeholder="Short Description">
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                      <button type="button" class="btn btn-danger remove-certificate"><i class="ti ti-trash"></i></button>
                    </div>
                  </div>
                </div>
                <button type="button" class="btn btn-primary mt-2" id="add-certificate">Add Another Certification</button>
              </div>

                 <div class="col-sm-6">
                  <label class="switch switch-info">
                  <input type="checkbox" class="switch-input" id="test_required_checkbox" />
                  <span class="switch-toggle-slider">
                    <span class="switch-on">
                      <i class="ti ti-check"></i>
                    </span>
                      <span class="switch-off">
                        <i class="ti ti-x"></i>
                      </span>
                    </span>
                    <span class="switch-label">Requirement for Test?</span>
                  </label>
                </div>
                <div class="col-sm-6">
                  <label class="switch switch-info">
                  <input type="checkbox" class="switch-input" id="tools_required_checkbox" />
                  <span class="switch-toggle-slider">
                    <span class="switch-on">
                      <i class="ti ti-check"></i>
                    </span>
                      <span class="switch-off">
                        <i class="ti ti-x"></i>
                      </span>
                    </span>
                    <span class="switch-label">Requirement for Tools?</span>
                  </label>
                </div>
                <div class="row g-6" id="test_fields" style="display: none;">
                  <div class="mb-3">
                    <label class="form-label">Required Test</label>
                    <div id="test-wrapper">
                      <div class="row g-3 test-row mb-2">
                        <div class="col-md-6">
                          <label class="form-label">Test Title</label>
                          <select  name="test[0][]" id="" class="select2 form-select form-select-lg">
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
                          <button type="button" class="btn btn-danger remove-test"><i class="ti ti-trash"></i></button>
                        </div>
                      </div>
                    </div>
                    <button type="button" class="btn btn-primary mt-2" id="add-test">Add Another Test</button>
                  </div>
                 
                </div>

                <div class="row g-6" id="tool_fields" style="display: none;">
                  <div class="mb-3">
                    <label class="form-label">Required Tools</label>
                    <div id="tool-wrapper">
                      <div class="row g-3 tool-row mb-2">
                        <div class="col-md-6">
                          <select  name="tool[0][]" id="" class="select2 form-select form-select-lg">
                            @foreach($tools as $tool)
                              <option value="{{ $tool->id }}">{{ $tool->name }}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="col-md-4">
                        </div>
                        <div class="col-md-2">
                          <button type="button" class="btn btn-danger remove-tool"><i class="ti ti-trash"></i></button>
                        </div>
                      </div>
                    </div>
                    <button type="button" class="btn btn-primary" id="add-tool">Add Another Tool</button>
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
                <select class="select2 form-select form-select-lg @error('jobLocation') is-invalid @enderror" name="jobLocation" id="jobLocation" required>
                  <option value='remote' {{ old('jobLocation', $job->jobLocation ?? '') == 'remote' ? 'selected' : '' }}>Remote – Work from anywhere</option>
                  <option value="onsite" {{ old('jobLocation', $job->jobLocation ?? '') == 'onsite' ? 'selected' : '' }}>On Site – Specific physical location</option>
                </select>
                @error('jobLocation')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="col-sm-6">
                <label for="country" class="form-label">Country</label>
                <select class="select2 form-select form-select-lg @error('country') is-invalid @enderror" name="country" id="country" required>
                  <option>country</option>
                </select>
                @error('country')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="col-sm-6">
                <label for="country" class="form-label">State </label>
                <select class="select2 form-select form-select-lg @error('state') is-invalid @enderror" name="state" id="state" required>
                  <option>State</option>
                </select>
                @error('state')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="col-sm-6">
                  <label for="state" class="form-label">City </label>
                  <input type="text" id="city" name="city" class="form-control multi-steps-mobile" placeholder="e.g City" />
                  @error('state')
                      <div class="invalid-feedback">{{ $message }}</div>
                   @enderror
              </div>
              <div class="col-sm-6 ">
                <label for="address" class="form-label">Address</label>
                <input type="text" name="address" id="address" class="form-control @error('address') is-invalid @enderror" placeholder="Full street address for job site" value="{{ old('address', $job->address ?? '') }}">
                @error('address')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="col-sm-6 ">
                  <label for="zip" class="form-label">Zip Code</label>
                  <input type="text" name="zip" id="zip" class="form-control @error('zip') is-invalid @enderror" placeholder="e.g. 90001" value="{{ old('zip', $job->zip ?? '') }}">
                  @error('zip')
                      <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
              </div>
              <div class="col-sm-6 ">
                <label for="radius" class="form-label">Work Radius</label>
                <input type="text" name="radius" id="radius" class="form-control @error('radius') is-invalid @enderror" placeholder="Max distance contractor can be from job" value="{{ old('radius', $job->radius ?? '') }}">
                @error('radius')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="col-sm-6 ">
                <label for="radius" class="form-label">Payment Terms</label>
                <input type="text" name="payment_terms" id="payment_terms" class="form-control @error('payment_terms') is-invalid @enderror" placeholder="Max distance contractor can be from job" value="{{ old('radius', $job->radius ?? '') }}">
                @error('radius')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="col-sm-6">
                <label class="switch switch-info">
                <input type="checkbox" class="switch-input" name="nda_agreement" id="nda_agreement_required_checkbox"/>
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
              </div>
              <div class="col-sm-12 ">
                <label for="radius" class="form-label">Terms and Condition</label>
                <textarea name="conditions" id="conditions" rows="4" cols="5" class="form-control summernote @error('conditions') is-invalid @enderror" placeholder="Conditions such as tools required, work hours, etc.">{{ old('conditions', $job->conditions ?? '') }}</textarea>
                @error('conditions')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="col-sm-12 ">
                <label for="terms_acceptance" class="form-label">Terms Acceptance Notice</label>
                <textarea name="terms_acceptance" id="terms_acceptance" rows="4" cols="5" class="form-control summernote @error('terms_acceptance') is-invalid @enderror" placeholder="Add disclaimer or acceptance requirement before applying">{{ old('terms_acceptance', $job->terms_acceptance ?? '') }}</textarea>
                @error('terms_acceptance')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="col-12 d-flex justify-content-between">
                  <button class="btn btn-secondary prev-btn" data-prev="tab3"><i class="ti ti-arrow-left ti-xs me-sm-2 me-0"></i>
                    <span class="align-middle d-sm-inline-block d-none">Previous</span></button>
                    <button class="btn btn-success" type="submit"><span class="align-middle d-sm-inline-block d-none me-sm-1 me-0">Submit</span>
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
  <script src="{{ asset('assets/js/pages-auth-multisteps.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/bloodhound/bloodhound.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/tagify/tagify.js') }}"></script>
<script src="{{ asset('assets/js/forms-selects.js') }}"></script>
<script src="{{ asset('assets/js/forms-tagify.js') }}"></script>
<script src="{{ asset('assets/js/forms-typeahead.js') }}"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>  
<script>
$(document).ready(function () {

      $('#selectpickerSelection').html('<option value="">Loading...</option>');

    
  
      const endPicker = flatpickr("#deadline", {
        dateFormat: "Y-m-d",
      });

    flatpickr("#start_date", {
      dateFormat: "Y-m-d",
      onChange: function(selectedDates, dateStr, instance) {
        if (selectedDates.length > 0) {
          const minEndDate = new Date(selectedDates[0]);
          minEndDate.setDate(minEndDate.getDate() + 10); // add 10 days
          endPicker.set("minDate", minEndDate);
        }
      }
    });

  let toolIndex = 1;
  let testIndex = 1; // Make sure this is defined somewhere globally
  let testOptions = `@foreach($tests as $test)<option value="{{ $test->id }}">{{ $test->title }}</option>@endforeach`;

    $("#add-test").on('click', function() {
        const testHTML = `
            <div class="row g-3 test-row mb-2">
                <div class="col-sm-5">
                    <label class="form-label" for="title">Test Title</label>
                    <select name="test[${testIndex}][]" class="select2 form-select form-select-lg">
                      <option value="">Select Tests</option>
                      ${testOptions}
                    </select>
                </div>
                <div class="col-sm-5">
                    <label class="form-label" for="scoring_criteria">Scoring Criteria</label>
                    <input type="text" name="test[${testIndex}][scoring_criteria]" class="form-control" placeholder="Criteria"/> 
                </div>
                <div class="col-sm-2 d-flex align-items-end">
                    <button type="button" class="btn btn-danger remove-test"><i class="ti ti-trash"></i></button>
                </div>
            </div>
        `;

        $('#test-wrapper').append(testHTML); 
        testIndex++;
    });

    let certificateIndex = 1; // Make sure this is defined somewhere globally
    let certificateOptions = `@foreach($certificates as $certificate)<option value="{{ $certificate->id }}">{{ $certificate->name }}</option>@endforeach`;

    $("#add-certificate").on('click', function() {
        const certificateHTML = `
    <div class="row g-3 certificate-row mb-2">
      <div class="col-sm-5">
        <label class="form-label" for="title">Certification Name</label>
       <select name="certificate[${certificateIndex}][]" class="select2 form-select form-select-lg">
          <option value="">Select Certificates</option>
          ${certificateOptions}
        </select>
      </div>
      <div class="col-sm-5">
        <label class="form-label" for="scoring_criteria">Short Description</label>
        <input type="text" name="certificate[${certificateIndex}][description]" class="form-control" placeholder="Short Desciption" />
      </div>
      <div class="col-sm-2 d-flex align-items-end">
        <button type="button" class="btn btn-danger remove-certificate">
          <i class="ti ti-trash"></i>
        </button>
      </div>
    </div>
        `;

        $('#certificate-wrapper').append(certificateHTML); 
        certificateIndex++;
    });


    $(document).on('click', '.remove-test', function () {
      $(this).closest('.test-row').remove();
    });

    $(document).on('click', '.remove-certificate', function () {
      $(this).closest('.certificate-row').remove();
    });

    let toolOptions = `@foreach($tools as $tool)<option value="{{ $tool->id }}">{{ $tool->name }}</option>@endforeach`;

    $('#add-tool').on('click', function () {
      const toolHtml = `
        <div class="row g-3 tool-row mb-2">
          <div class="col-md-6">
           <select name="tool[${toolIndex}][]" class="select2 form-select form-select-lg">
            <option value="">Select Certificates</option>
            ${toolOptions}
          </select>
          </div>
          <div class="col-md-4">
         
          </div>
          <div class="col-md-2">
            <button type="button" class="btn btn-danger remove-tool"><i class="ti ti-trash"></i></button>
          </div>
        </div>
      `;

      $('#tool-wrapper').append(toolHtml);
        toolIndex++;
    
        });
      $(document).on('click', '.remove-tool', function () {
        $(this).closest('.tool-row').remove();
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

  // Run once on page load (e.g. when editing a job)
  $('#test_required_checkbox').trigger('change');
  $('#tools_required_checkbox').trigger('change');
  });
</script>
<script>
   $(document).ready(function () {
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