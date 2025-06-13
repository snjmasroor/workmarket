
@extends('layouts.backend.master') 
@push('styles')
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/bs-stepper/bs-stepper.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/bootstrap-select/bootstrap-select.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/@form-validation/form-validation.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/tagify/tagify.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/page-auth.css') }}" />
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
                <span class="bs-stepper-title">Certifications</span>
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
              <h4 class="mb-0">Job Basic Information</h4>
            </div>
            <div class="row g-6">
              <div class="col-sm-6">
                <label class="form-label" for="jobTitle">Job Title</label>
                <input type="text" name="title" id="jobTitle" class="form-control" placeholder="e.g PHP Developer" />
              </div>
              <div class="col-sm-6">
                  <label for="industry_id" class="form-label">Industry <span class="text-danger">*</span></label>
                  <select data-allow-clear="true" name="industry_id" id="industry_id" class="form-control form-select @error('industry_id') is-invalid @enderror" required>
                    <option value="">-- Select Industry relevant to the job --</option>
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
                <input type="text" id="start_date" name="start_date" class="form-control" placeholder="Start Date" />
              </div>
              <div class="col-sm-6">
                <label class="form-label" for="deadline">Application Deadline</label>
                <input type="text" id="deadline" name="deadline" class="form-control" placeholder="Deadline Date" />
              </div>
              <div class="col-md-12">
                <label class="form-label" for="estimated_hours">Description</label>
                <textarea name="description" id="description" class="form-control" rows="6">{{ old('description') }}</textarea>
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
              <h4 class="mb-0">Job Education Requirement</h4>
            </div>
              <div class="row g-6">
                <div class="col-sm-6">
                  <label class="form-label" for="jobTitle"></label>
                   <input type="text" name="title" id="jobTitle" class="form-control" placeholder="e.g PHP Developer" />
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
            <div class="row g-6">
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
                <label for="state" class="form-label">State </label>
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
<script>
$(document).ready(function () {
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