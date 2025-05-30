 @extends('layouts.backend.master') 
@push('styles')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/select2.min.css')}}"> 
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/bootstrap-datetimepicker.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/plugins/summernote/dist/summernote-bs4.css')}}">
<style>
    .onSiteFields {
            display: none;
        }
        .show-block {
    display: block;
}
</style>
@endpush @section('page-content') 
 <div class="content">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <h4 class="page-title">Add Jobs</h4>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center"> {{-- Centering the form using justify-content-center --}}
    <div class="col-lg-8"> {{-- Removed offset, letting justify-content-center handle centering --}}
        <form action="{{ route('job.store') }}" method="POST" enctype="multipart/form-data">
             @csrf

            {{-- Job Details Section --}}
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Job Details</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        {{-- Industry --}}
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="industry_id" class="form-label">Industry <span class="text-danger">*</span></label>
                                <select name="industry_id" id="industry_id" class="form-control @error('industry_id') is-invalid @enderror" required>
                                    <option value="">-- Select Industry relevant to the job --</option>
                                    @foreach($industries as $industry)
                                        {{-- Add logic for selected if this is an edit form: {{ old('industry_id', $job->industry_id ?? '') == $industry->id ? 'selected' : '' }} --}}
                                        <option value="{{ $industry->id }}">{{ $industry->name }}</option>
                                    @endforeach
                                </select>
                                @error('industry_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        {{-- Skills --}}
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="skills" class="form-label">Skills</label>
                                <select class="form-control @error('skill_ids') is-invalid @enderror" multiple id="skills" name="skill_ids[]">
                                    <option value="">-- Select required skills for this job --</option>
                                    {{-- You'll likely populate this with JavaScript/AJAX based on industry selection --}}
                                </select>
                                @error('skill_ids')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        {{-- Title --}}
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="title" class="form-label">Job Title <span class="text-danger">*</span></label>
                                <input class="form-control @error('title') is-invalid @enderror" type="text" name="title" id="title" placeholder="e.g. Electrician Needed for Office Setup" value="{{ old('title', $job->title ?? '') }}" required>
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        {{-- Job Type --}}
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="jobType" class="form-label">Job Type <span class="text-danger">*</span></label>
                                <select class="form-control @error('jobType') is-invalid @enderror" name="jobType" id="jobType" required>
                                    <option value=''>Please select the Job Type</option>
                                    <option value='fixed' {{ old('jobType', $job->jobType ?? '') == 'fixed' ? 'selected' : '' }}>Fixed – One-time payment</option>
                                    <option value="hourly" {{ old('jobType', $job->jobType ?? '') == 'hourly' ? 'selected' : '' }}>Hourly – Pay based on time worked</option>
                                </select>
                                @error('jobType')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        {{-- Budget --}}
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="budget" class="form-label">Budget <span class="text-danger">*</span></label>
                                <input class="form-control @error('budget') is-invalid @enderror" type="text" name="budget" id="budget" placeholder="Estimated job budget (e.g. 1000)" value="{{ old('budget', $job->budget ?? '') }}" required>
                                @error('budget')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        {{-- Estimated Hours (conditionally visible) --}}
                        <div id="estimated_hours_field" class="col-md-6 mb-3" style="display: none;"> {{-- Initially hidden --}}
                            <div class="form-group">
                                <label for="estimated_hours" class="form-label">Estimated Hours</label>
                                <input type="text" name="estimated_hours" id="estimated_hours" class="form-control @error('estimated_hours') is-invalid @enderror" placeholder="Expected hours to complete the job" value="{{ old('estimated_hours', $job->estimated_hours ?? '') }}">
                                @error('estimated_hours')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Job Location Section --}}
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Job Location</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        {{-- Job Location Type --}}
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="jobLocation" class="form-label">Job Location Type <span class="text-danger">*</span></label>
                                <select class="form-control @error('jobLocation') is-invalid @enderror" name="jobLocation" id="jobLocation" required>
                                    <option value='remote' {{ old('jobLocation', $job->jobLocation ?? '') == 'remote' ? 'selected' : '' }}>Remote – Work from anywhere</option>
                                    <option value="onsite" {{ old('jobLocation', $job->jobLocation ?? '') == 'onsite' ? 'selected' : '' }}>On Site – Specific physical location</option>
                                </select>
                                @error('jobLocation')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        {{-- State and City (conditionally visible) --}}
                        <div id="onsite_location_fields" class="col-md-6 mb-3 d-flex" style="display: none;"> {{-- Initially hidden --}}
                            <div class="form-group me-3 flex-grow-1"> {{-- Added flex-grow-1 for spacing --}}
                                <label for="state" class="form-label">State</label>
                                <input class="form-control @error('state') is-invalid @enderror" type="text" name="state" id="state" placeholder="State where the job is located" value="{{ old('state', $job->state ?? '') }}">
                                @error('state')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group flex-grow-1">
                                <label for="city" class="form-label">City</label>
                                <input class="form-control @error('city') is-invalid @enderror" type="text" name="city" id="city" placeholder="City where the job is located" value="{{ old('city', $job->city ?? '') }}">
                                @error('city')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        {{-- Address --}}
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" name="address" id="address" class="form-control @error('address') is-invalid @enderror" placeholder="Full street address for job site" value="{{ old('address', $job->address ?? '') }}">
                                @error('address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        {{-- Zip Code --}}
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="zip" class="form-label">Zip Code</label>
                                <input type="text" name="zip" id="zip" class="form-control @error('zip') is-invalid @enderror" placeholder="e.g. 90001" value="{{ old('zip', $job->zip ?? '') }}">
                                @error('zip')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        {{-- Work Radius --}}
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="radius" class="form-label">Work Radius</label>
                                <input type="text" name="radius" id="radius" class="form-control @error('radius') is-invalid @enderror" placeholder="Max distance contractor can be from job" value="{{ old('radius', $job->radius ?? '') }}">
                                @error('radius')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        {{-- Attachment --}}
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="attachments" class="form-label">Attachment</label>
                                <input type="file" name="attachments" id="attachments" class="form-control @error('attachments') is-invalid @enderror">
                                <small class="form-text text-muted">Upload reference documents or specs (Max: 5MB)</small>
                                @error('attachments')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Dates & Payment Section --}}
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Dates & Payment</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        {{-- Start Date --}}
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="start_date" class="form-label">Start Date <span class="text-danger">*</span></label>
                                <div class="input-group date" id="start_date_picker" data-target-input="nearest"> {{-- Bootstrap 5 input group for date picker --}}
                                    <input type="text" name="start_date" id="start_date" class="form-control datetimepicker @error('start_date') is-invalid @enderror" placeholder="When the job will start (dd/mm/yyyy)" value="{{ old('start_date', $job->start_date ?? '') }}" required data-target="#start_date_picker"/>
                                    <div class="input-group-append" data-target="#start_date_picker" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                    @error('start_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        {{-- Deadline --}}
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="deadline" class="form-label">Application Deadline <span class="text-danger">*</span></label>
                                <div class="input-group date" id="deadline_picker" data-target-input="nearest">
                                    <input class="form-control datetimepicker @error('deadline') is-invalid @enderror" type="text" name="deadline" id="deadline" placeholder="Select deadline (dd/mm/yyyy)" value="{{ old('deadline', $job->deadline ?? '') }}" required data-target="#deadline_picker"/>
                                    <div class="input-group-append" data-target="#deadline_picker" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                    @error('deadline')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        {{-- Payment Terms --}}
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="payment_terms" class="form-label">Payment Terms</label>
                                <input type="text" name="payment_terms" id="payment_terms" class="form-control @error('payment_terms') is-invalid @enderror" placeholder="e.g. Upon completion, Net 30 days" value="{{ old('payment_terms', $job->payment_terms ?? '') }}">
                                @error('payment_terms')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        {{-- Rate Per Hour --}}
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="rate_per_hour" class="form-label">Rate Per Hour</label>
                                <input type="text" name="rate_per_hour" id="rate_per_hour" class="form-control @error('rate_per_hour') is-invalid @enderror" placeholder="e.g. Rate Per Hour $10" value="{{ old('rate_per_hour', $job->rate_per_hour ?? '') }}">
                                @error('rate_per_hour')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Job Description & Agreements Section --}}
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Job Description & Agreements</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="description" class="form-label">Job Description <span class="text-danger">*</span></label>
                        <textarea rows="4" cols="5" class="form-control summernote @error('description') is-invalid @enderror" name="description" id="description" placeholder="Detailed job description to inform applicants about duties and expectations" required>{{ old('description', $job->description ?? '') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="terms" class="form-label">Job Terms</label>
                        <textarea name="terms" id="terms" rows="4" cols="5" class="form-control summernote @error('terms') is-invalid @enderror" placeholder="Define expectations, scope, rules, etc.">{{ old('terms', $job->terms ?? '') }}</textarea>
                        @error('terms')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="conditions" class="form-label">Job Conditions</label>
                        <textarea name="conditions" id="conditions" rows="4" cols="5" class="form-control summernote @error('conditions') is-invalid @enderror" placeholder="Conditions such as tools required, work hours, etc.">{{ old('conditions', $job->conditions ?? '') }}</textarea>
                        @error('conditions')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="nda_requirement" class="form-label">NDA Requirement</label>
                        <textarea name="nda_requirement" id="nda_requirement" rows="4" cols="5" class="form-control summernote @error('nda_requirement') is-invalid @enderror" placeholder="Mention if contractor must sign NDA or confidentiality agreement">{{ old('nda_requirement', $job->nda_requirement ?? '') }}</textarea>
                        @error('nda_requirement')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="terms_acceptance" class="form-label">Terms Acceptance Notice</label>
                        <textarea name="terms_acceptance" id="terms_acceptance" rows="4" cols="5" class="form-control summernote @error('terms_acceptance') is-invalid @enderror" placeholder="Add disclaimer or acceptance requirement before applying">{{ old('terms_acceptance', $job->terms_acceptance ?? '') }}</textarea>
                        @error('terms_acceptance')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            {{-- Status Section --}}
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Status Settings</h5>
                </div>
                <div class="card-body">
                    <div class="form-group mb-3">
                        <label class="form-label display-block">Schedule Status <span class="text-danger">*</span></label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="status" id="product_active" value="1" {{ old('status', $job->status ?? '1') == '1' ? 'checked' : '' }} required>
                            <label class="form-check-label" for="product_active">Active – Visible to users</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="status" id="product_inactive" value="0" {{ old('status', $job->status ?? '') == '0' ? 'checked' : '' }}>
                            <label class="form-check-label" for="product_inactive">Inactive – Hidden from users</label>
                        </div>
                        @error('status')
                            <div class="invalid-feedback d-block">{{ $message }}</div> {{-- d-block to show for radio buttons --}}
                        @enderror
                    </div>

                    @if(auth()->user() && auth()->user()->type === 'superadmin')
                        <div class="form-group mb-3">
                            <label class="form-label display-block">Admin Status <span class="text-danger">*</span></label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status_admin" id="open" value="open" {{ old('status_admin', $job->status_admin ?? '') == 'open' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="open">Open </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status_admin" id="in_progress" value="in_progress" {{ old('status_admin', $job->status_admin ?? '') == 'in_progress' ? 'checked' : '' }}>
                                <label class="form-check-label" for="in_progress">In Progress</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status_admin" id="completed" value="completed" {{ old('status_admin', $job->status_admin ?? '') == 'completed' ? 'checked' : '' }}>
                                <label class="form-check-label" for="completed">Completed</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status_admin" id="cancelled" value="cancelled" {{ old('status_admin', $job->status_admin ?? '') == 'cancelled' ? 'checked' : '' }}>
                                <label class="form-check-label" for="cancelled">Cancelled</label>
                            </div>
                            @error('status_admin')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    @endif
                </div>
            </div>

            <div class="text-center mb-5"> {{-- Changed m-t-20 to mb-5 for more modern spacing --}}
                <button type="submit" class="btn btn-primary submit-btn btn-lg">Create Job</button>
            </div>
        </form>
    </div>
</div>
</div>
@endsection 
@push('scripts') 
      <script src="{{ asset('assets/js/select2.min.js') }}"></script>
      <script src="{{ asset('assets/js/moment.min.js') }}"></script>
      <script src="{{ asset('assets/js/bootstrap-datetimepicker.min.js') }}"></script>
      <script src="{{ asset('assets/plugins/summernote/dist/summernote-bs4.min.js') }}"></script>
      <script>
  $(document).ready(function () {
    $('#industry_id').on('change', function () {
      var industryId = $(this).val();

      $('#skills').html('<option value="">Loading...</option>');

      if (industryId) {
        $.ajax({
          url: '{{ route("get.skills.by.industry") }}',
          type: 'GET',
          data: { industry_id: industryId },
          success: function (response) {
            $('#skills').empty();
            if (response.length > 0) {
              $.each(response, function (key, skill) {
                $('#skills').append('<option value="' + skill.id + '">' + skill.name + '</option>');
              });
            } else {
              $('#skills').append('<option value="">No Skills Available</option>');
            }
          }
        });
      } else {
        $('#skills').html('<option value="">-- Select Skill --</option>');
      }
    });
  });
</script>
<script>
    $(document).ready(function() {
     $('.datetimepicker').each(function() {
                $(this).datetimepicker({
                    format: 'DD/MM/YYYY', // Example format
                    icons: {
                        time: 'far fa-clock',
                        date: 'far fa-calendar',
                        up: 'fas fa-arrow-up',
                        down: 'fas fa-arrow-down',
                        previous: 'fas fa-chevron-left',
                        next: 'fas fa-chevron-right',
                        today: 'fas fa-calendar-check',
                        clear: 'fas fa-trash',
                        close: 'fas fa-times'
                    }
                });
            });
             function toggleEstimatedHours() {
                const jobType = $('#jobType').val();
                if (jobType === 'hourly') {
                    $('#estimated_hours_field').show();
                    $('#estimated_hours').attr('required', true);
                } else {
                    $('#estimated_hours_field').hide();
                    $('#estimated_hours').removeAttr('required');
                }
            }

            // Conditional display for State/City based on Job Location Type
            function toggleOnsiteLocation() {
                const jobLocation = $('#jobLocation').val();
                if (jobLocation === 'onsite') {
                    $('#onsite_location_fields').show();
                    $('#state').attr('required', true);
                    $('#city').attr('required', true);
                    $('#address').attr('required', true); // Address might be required for onsite too
                } else {
                    $('#onsite_location_fields').hide();
                    $('#state').removeAttr('required');
                    $('#city').removeAttr('required');
                    $('#address').removeAttr('required');
                }
            }

            // Initial call on page load to set correct visibility based on old values or defaults
            toggleEstimatedHours();
            toggleOnsiteLocation();

            // Event listeners for changes
            $('#jobType').change(toggleEstimatedHours);
            $('#jobLocation').change(toggleOnsiteLocation);
    });
</script>

@endpush