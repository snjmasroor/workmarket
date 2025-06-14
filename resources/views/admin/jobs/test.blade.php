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





            <div class="bs-stepper-header" role="tablist">
                <!-- Step 1 -->
                <div class="step" data-target="#accountDetailsValidation">
                  <button type="button" class="step-trigger" role="tab" id="stepper1-trigger-1" aria-controls="accountDetailsValidation">
                    <span class="bs-stepper-circle"><i class="ti ti-file-analytics ti-md"></i></span>
                    <span class="bs-stepper-label">
                      <span class="bs-stepper-title">Basic Information</span>
                    </span>
                  </button>
                </div>
                <div class="line"><i class="ti ti-chevron-right"></i></div>

                <!-- Step 2 -->
                <div class="step" data-target="#personalInfoValidation">
                  <button type="button" class="step-trigger" role="tab" id="stepper1-trigger-2" aria-controls="personalInfoValidation">
                    <span class="bs-stepper-circle"><i class="ti ti-user ti-md"></i></span>
                    <span class="bs-stepper-label">
                      <span class="bs-stepper-title">Job Detail and Scope</span>
                    </span>
                  </button>
                </div>
                <div class="line"><i class="ti ti-chevron-right"></i></div>

                <!-- Step 3 -->
                <div class="step" data-target="#billingLinksValidation">
                  <button type="button" class="step-trigger" role="tab" id="stepper1-trigger-3" aria-controls="billingLinksValidation">
                    <span class="bs-stepper-circle"><i class="ti ti-credit-card ti-md"></i></span>
                    <span class="bs-stepper-label">
                      <span class="bs-stepper-title">Location Information</span>
                    </span>
                  </button>
                </div>
                <div class="line"><i class="ti ti-chevron-right"></i></div>

                <!-- ✅ Step 4 -->
                <div class="step" data-target="#termsAndConditionsValidation">
                  <button type="button" class="step-trigger" role="tab" id="stepper1-trigger-4" aria-controls="termsAndConditionsValidation">
                    <span class="bs-stepper-circle"><i class="ti ti-shield-check ti-md"></i></span>
                    <span class="bs-stepper-label">
                      <span class="bs-stepper-title">Terms & Requirements</span>
                    </span>
                  </button>
                </div>
              </div>

              <div class="bs-stepper-content px-0">
                <form id="multiStepsForm" onSubmit="return false">
                  <!-- Account Details -->
                  <div id="accountDetailsValidation" class="content">
                    <div class="content-header mb-6">
                      <h4 class="mb-0">Job</h4>
                      <p class="mb-0">Job Basic Information</p>
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
                                  {{-- Add logic for selected if this is an edit form: {{ old('industry_id', $job->industry_id ?? '') == $industry->id ? 'selected' : '' }} --}}
                                  <option value="{{ $industry->id }}">{{ $industry->name }}</option>
                              @endforeach
                          </select>
                          @error('industry_id')
                              <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                      </div>
                      <div class="col-sm-6">
                       <label class="form-label" for="skill">Select Skills</label>
                          <select
                            data-allow-clear="true"
                            id="selectpickerSelection"
                            class="select2 form-select form-select-lg"
                            data-style="btn-default"
                            name="skill_ids[]"
                            multiple
                            data-max-options="10">
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
                      <div class="col-md-12">
                        <textarea name="description" id="description" class="form-control" rows="6">{{ old('description') }}</textarea>
                      </div>
                      <div class="col-12 d-flex justify-content-between">
                        <button class="btn btn-label-secondary btn-prev" disabled>
                          <i class="ti ti-arrow-left ti-xs me-sm-2 me-0"></i>
                          <span class="align-middle d-sm-inline-block d-none">Previous</span>
                        </button>
                        <button class="btn btn-primary btn-next">
                          <span class="align-middle d-sm-inline-block d-none me-sm-1 me-0">Next</span>
                          <i class="ti ti-arrow-right ti-xs"></i>
                        </button>
                      </div>
                    </div>
                  </div>
                  <!-- Personal Info -->
                  <div id="personalInfoValidation" class="content">
                    <div class="content-header mb-6">
                      <h4 class="mb-0">Job Detail </h4>
                      <p class="mb-0">Job Scope Information</p>
                    </div>
                    <div class="row g-6">
                      <div class="col-sm-6">
                        <label class="form-label" for="budget">Budget</label>
                        <input id="budget" type="number" step="0.01" name="budget" class="form-control" placeholder="e.g: 1 or 1.5" />
                      </div>
                      <div class="col-sm-6" id="fixed-rate-fields">
                        <label class="form-label" for="fixed_rate">Fixed Amount</label>
                        <input
                          type="number"
                          step="0.01"
                          id="fixed_rate"
                          name="fixed_rate"
                          class="form-control"
                          placeholder="e.g 100, 100.50"/>
                      </div>
                      <div class="col-sm-6" id="hourly-rate-fields">
                        <label class="form-label" for="hourly_rate">Hourly Rate</label>
                        <div class="input-group">
                          <input
                           type="number"
                            step="0.01"
                            id="hourly_rate"
                            name="hourly_rate"
                            class="form-control multi-steps-mobile"
                            placeholder="e.g 100, 100.50" />
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <label class="form-label" for="estimated_hours">Estimated Hours</label>
                        <input
                          type="text"
                          id="estimated_hours"
                          name="estimated_hours"
                          class="form-control "
                          placeholder="Estimated Hours"
                          maxlength="2" />
                      </div>
                      
                      
                      <div class="col-12 d-flex justify-content-between">
                        <button class="btn btn-label-secondary btn-prev">
                          <i class="ti ti-arrow-left ti-xs me-sm-2 me-0"></i>
                          <span class="align-middle d-sm-inline-block d-none">Previous</span>
                        </button>
                        <button class="btn btn-primary btn-next">
                          <span class="align-middle d-sm-inline-block d-none me-sm-1 me-0">Next</span>
                          <i class="ti ti-arrow-right ti-xs"></i>
                        </button>
                      </div>
                    </div>
                  </div>
                  
                  <!-- Billing Links -->
                  <div id="billingLinksValidation" class="content">
                    <div class="content-header mb-6">
                      <h4 class="mb-0">Personal Information</h4>
                      <p class="mb-0">Enter Your Personal Information</p>
                    </div>
                    <div class="row g-6">
                      <div class="col-sm-6">
                        <label class="form-label" for="multiStepsFirstName">First Name</label>
                        <input
                          type="text"
                          id="multiStepsFirstName"
                          name="multiStepsFirstName"
                          class="form-control"
                          placeholder="John" />
                      </div>
                      <div class="col-sm-6">
                        <label class="form-label" for="multiStepsLastName">Last Name</label>
                        <input
                          type="text"
                          id="multiStepsLastName"
                          name="multiStepsLastName"
                          class="form-control"
                          placeholder="Doe" />
                      </div>
                      <div class="col-sm-6">
                        <label class="form-label" for="multiStepsMobile">Mobile</label>
                        <div class="input-group">
                          <span class="input-group-text">US (+1)</span>
                          <input
                            type="text"
                            id="multiStepsMobile"
                            name="multiStepsMobile"
                            class="form-control multi-steps-mobile"
                            placeholder="202 555 0111" />
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <label class="form-label" for="multiStepsPincode">Pincode</label>
                        <input
                          type="text"
                          id="multiStepsPincode"
                          name="multiStepsPincode"
                          class="form-control multi-steps-pincode"
                          placeholder="Postal Code"
                          maxlength="6" />
                      </div>
                      <div class="col-md-12">
                        <label class="form-label" for="multiStepsAddress">Address</label>
                        <input
                          type="text"
                          id="multiStepsAddress"
                          name="multiStepsAddress"
                          class="form-control"
                          placeholder="Address" />
                      </div>
                      <div class="col-md-12">
                        <label class="form-label" for="multiStepsArea">Landmark</label>
                        <input
                          type="text"
                          id="multiStepsArea"
                          name="multiStepsArea"
                          class="form-control"
                          placeholder="Area/Landmark" />
                      </div>
                      <div class="col-sm-6">
                        <label class="form-label" for="multiStepsCity">City</label>
                        <input type="text" id="multiStepsCity" class="form-control" placeholder="Jackson" />
                      </div>
                      <div class="col-sm-6">
                        <label class="form-label" for="multiStepsState">State</label>
                        <select id="multiStepsState" class="select2 form-select" data-allow-clear="true">
                          <option value="">Select</option>
                          <option value="AL">Alabama</option>
                          <option value="AK">Alaska</option>
                          <option value="AZ">Arizona</option>
                          <option value="AR">Arkansas</option>
                          <option value="CA">California</option>
                          <option value="CO">Colorado</option>
                          <option value="CT">Connecticut</option>
                          <option value="DE">Delaware</option>
                          <option value="DC">District Of Columbia</option>
                          <option value="FL">Florida</option>
                          <option value="GA">Georgia</option>
                          <option value="HI">Hawaii</option>
                          <option value="ID">Idaho</option>
                          <option value="IL">Illinois</option>
                          <option value="IN">Indiana</option>
                          <option value="IA">Iowa</option>
                          <option value="KS">Kansas</option>
                          <option value="KY">Kentucky</option>
                          <option value="LA">Louisiana</option>
                          <option value="ME">Maine</option>
                          <option value="MD">Maryland</option>
                          <option value="MA">Massachusetts</option>
                          <option value="MI">Michigan</option>
                          <option value="MN">Minnesota</option>
                          <option value="MS">Mississippi</option>
                          <option value="MO">Missouri</option>
                          <option value="MT">Montana</option>
                          <option value="NE">Nebraska</option>
                          <option value="NV">Nevada</option>
                          <option value="NH">New Hampshire</option>
                          <option value="NJ">New Jersey</option>
                          <option value="NM">New Mexico</option>
                          <option value="NY">New York</option>
                          <option value="NC">North Carolina</option>
                          <option value="ND">North Dakota</option>
                          <option value="OH">Ohio</option>
                          <option value="OK">Oklahoma</option>
                          <option value="OR">Oregon</option>
                          <option value="PA">Pennsylvania</option>
                          <option value="RI">Rhode Island</option>
                          <option value="SC">South Carolina</option>
                          <option value="SD">South Dakota</option>
                          <option value="TN">Tennessee</option>
                          <option value="TX">Texas</option>
                          <option value="UT">Utah</option>
                          <option value="VT">Vermont</option>
                          <option value="VA">Virginia</option>
                          <option value="WA">Washington</option>
                          <option value="WV">West Virginia</option>
                          <option value="WI">Wisconsin</option>
                          <option value="WY">Wyoming</option>
                        </select>
                      </div>
                      <div class="col-12 d-flex justify-content-between">
                        <button class="btn btn-label-secondary btn-prev">
                          <i class="ti ti-arrow-left ti-xs me-sm-2 me-0"></i>
                          <span class="align-middle d-sm-inline-block d-none">Previous</span>
                        </button>
                        <button class="btn btn-primary btn-next">
                          <span class="align-middle d-sm-inline-block d-none me-sm-1 me-0">Next</span>
                          <i class="ti ti-arrow-right ti-xs"></i>
                        </button>
                      </div>
                    </div>
                  </div>
                  <div id="termsAndConditionsValidation" class="content">
                    <div class="content-header mb-6">
                      <h4 class="mb-0">Select Plan</h4>
                      <p class="mb-0">Select plan as per your requirement</p>
                    </div>
                    <!-- Custom plan options -->
                    <div class="row gap-md-0 gap-4 mb-12">
                      <div class="col-md">
                        <div class="form-check custom-option custom-option-icon">
                          <label class="form-check-label custom-option-content" for="basicOption">
                            <span class="custom-option-body">
                              <span class="d-block mb-2 h5">Basic</span>
                              <span>A simple start for start ups & Students</span>
                              <span class="d-flex justify-content-center mt-2">
                                <sup class="text-primary h6 fw-normal pt-2 mb-0">$</sup>
                                <span class="fw-medium h3 text-primary mb-0">0</span>
                                <sub class="h6 fw-normal mt-3 mb-0 text-muted">/month</sub>
                              </span>
                            </span>
                            <input
                              name="customRadioIcon"
                              class="form-check-input"
                              type="radio"
                              value=""
                              id="basicOption" />
                          </label>
                        </div>
                      </div>
                      <div class="col-md">
                        <div class="form-check custom-option custom-option-icon">
                          <label class="form-check-label custom-option-content" for="standardOption">
                            <span class="custom-option-body">
                              <span class="d-block mb-2 h5">Standard</span>
                              <span>For small to medium businesses</span>
                              <span class="d-flex justify-content-center mt-2">
                                <sup class="text-primary h6 fw-normal pt-2 mb-0">$</sup>
                                <span class="fw-medium h3 text-primary mb-0">99</span>
                                <sub class="h6 fw-normal mt-3 mb-0 text-muted">/month</sub>
                              </span>
                            </span>
                            <input
                              name="customRadioIcon"
                              class="form-check-input"
                              type="radio"
                              value=""
                              id="standardOption"
                              checked />
                          </label>
                        </div>
                      </div>
                      <div class="col-md">
                        <div class="form-check custom-option custom-option-icon">
                          <label class="form-check-label custom-option-content" for="enterpriseOption">
                            <span class="custom-option-body">
                              <span class="d-block mb-2 h5">Enterprise</span>
                              <span>Solution for enterprise & organizations</span>
                              <span class="d-flex justify-content-center mt-2">
                                <sup class="text-primary h6 fw-normal pt-2 mb-0">$</sup>
                                <span class="fw-medium h3 text-primary mb-0">499</span>
                                <sub class="h6 fw-normal mt-3 mb-0 text-muted">/year</sub>
                              </span>
                            </span>
                            <input
                              name="customRadioIcon"
                              class="form-check-input"
                              type="radio"
                              value=""
                              id="enterpriseOption" />
                          </label>
                        </div>
                      </div>
                    </div>
                    <!--/ Custom plan options -->
                    <div class="content-header mb-6">
                      <h4 class="mb-0">Payment Information</h4>
                      <p class="mb-0">Enter your card information</p>
                    </div>
                    <!-- Credit Card Details -->
                    <div class="row g-6">
                      <div class="col-md-12">
                        <label class="form-label w-100" for="multiStepsCard">Card Number</label>
                        <div class="input-group input-group-merge">
                          <input
                            id="multiStepsCard"
                            class="form-control multi-steps-card"
                            name="multiStepsCard"
                            type="text"
                            placeholder="1356 3215 6548 7898"
                            aria-describedby="multiStepsCardImg" />
                          <span class="input-group-text cursor-pointer" id="multiStepsCardImg"
                            ><span class="card-type"></span
                          ></span>
                        </div>
                      </div>
                      <div class="col-md-5">
                        <label class="form-label" for="multiStepsName">Name On Card</label>
                        <input
                          type="text"
                          id="multiStepsName"
                          class="form-control"
                          name="multiStepsName"
                          placeholder="John Doe" />
                      </div>
                      <div class="col-6 col-md-4">
                        <label class="form-label" for="multiStepsExDate">Expiry Date</label>
                        <input
                          type="text"
                          id="multiStepsExDate"
                          class="form-control multi-steps-exp-date"
                          name="multiStepsExDate"
                          placeholder="MM/YY" />
                      </div>
                      <div class="col-6 col-md-3">
                        <label class="form-label" for="multiStepsCvv">CVV Code</label>
                        <div class="input-group input-group-merge">
                          <input
                            type="text"
                            id="multiStepsCvv"
                            class="form-control multi-steps-cvv"
                            name="multiStepsCvv"
                            maxlength="3"
                            placeholder="654" />
                          <span class="input-group-text cursor-pointer" id="multiStepsCvvHelp"
                            ><i
                              class="ti ti-help text-muted"
                              data-bs-toggle="tooltip"
                              data-bs-placement="top"
                              title="Card Verification Value"></i
                          ></span>
                        </div>
                      </div>
                      <div class="col-12 d-flex justify-content-between">
                        <button class="btn btn-label-secondary btn-prev">
                          <i class="ti ti-arrow-left ti-xs me-sm-2 me-0"></i>
                          <span class="align-middle d-sm-inline-block d-none">Previous</span>
                        </button>
                        <button type="submit" class="btn btn-success btn-next btn-submit">Submit</button>
                      </div>
                    </div>
                    <!--/ Credit Card Details -->
                  </div>
                </form>
              </div>