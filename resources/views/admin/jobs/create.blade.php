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

    <div class="row">
        <div class="col-lg-8 offset-lg-2">
            <form action="{{ route('job.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="row">
                        <!-- Industry -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Industry</label>
                                    <select name="industry_id" id="industry_id" class="form-control" required>
                                        <option value="">-- Select Industry relevant to the job --</option>
                                        @foreach($industries as $industry)
                                            <option value="{{ $industry->id }}">{{ $industry->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!-- Skills -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Skills</label>
                                    <select class="form-control" multiple id="skills" name="skill_ids[]">
                                        <option value="">-- Select required skills for this job --</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <!-- Title -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Job Title</label>
                                    <input class="form-control" type="text" name="title" placeholder="e.g. Electrician Needed for Office Setup">
                                </div>
                            </div>

                            <!-- Job Type -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Job Type</label>
                                    <select class="form-control" name="jobType" id="jobType" required>
                                        <option value=''>Please select the Job Type</option>
                                        <option value='fixed'>Fixed – One-time payment</option>
                                        <option value="hourly">Hourly – Pay based on time worked</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <!-- Budget -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Budget</label>
                                    <input class="form-control" type="text" name="budget" placeholder="Estimated job budget (e.g. 1000)">
                                </div>
                            </div>
                            <!-- Estimated Hours -->
                            <div  id="estimated_hours" class="col-md-6">
                                <div class="form-group">
                                    <label>Estimated Hours</label>
                                    <input type="text" name="estimated_hours" class="form-control" placeholder="Expected hours to complete the job">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <!-- Job Location Type -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Job Location Type</label>
                                    <select class="form-control" name="jobLocation" id="jobLocation" required>
                                        <option value='remote'>Remote – Work from anywhere</option>
                                        <option value="onsite">On Site – Specific physical location</option>
                                    </select>
                                </div>
                            </div>
                            <!-- State -->
                            <div id="state" class="col-md-3 ">
                                <div class="form-group">
                                    <label>State</label>
                                    <input class="form-control" type="text" name="state" placeholder="State where the job is located">
                                </div>
                            </div>
                            <!-- City -->
                            <div id="city" class="col-md-3 ">
                                <div class="form-group">
                                    <label>City</label>
                                    <input class="form-control" type="text" name="city" placeholder="City where the job is located">
                                </div>
                            </div>
                        </div>

                        <!-- Attachments, Address, Radius, Zip -->
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Attachment</label>
                                    <input type="file" name="attachments" class="form-control" placeholder="Upload reference documents or specs">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Address</label>
                                    <input type="text" name="address" class="form-control" placeholder="Full street address for job site">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Zip Code</label>
                                    <input type="text" name="zip" class="form-control" placeholder="e.g. 90001">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Work Radius</label>
                                    <input type="text" name="radius" class="form-control" placeholder="Max distance contractor can be from job">
                                </div>
                            </div>
                        </div>

                        <!-- Start Date, Estimated Hours, Currency -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Start Date</label>
                                    <div class="cal-icon">
                                        <input type="text" name="start_date" class="form-control datetimepicker" placeholder="When the job will start"> 
                                    </div>
                                </div>
                            </div>
                            <!-- Deadline -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Application Deadline</label>
                                    <div class="cal-icon">
                                        <input class="form-control datetimepicker" type="text" name="deadline" placeholder="Select deadline (dd/mm/yyyy)">
                                    </div>
                                </div>
                            </div>                            
                        </div>

                        <!-- Payment Terms, Payment Type -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Payment Terms</label>
                                    <input type="text" name="payment_terms" class="form-control" placeholder="e.g. Upon completion, Net 30 days">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Rate Per Hour</label>
                                    <input type="text" name="rate_per_hour" class="form-control" placeholder="e.g. Rate Per Hour $10">
                                </div>
                            </div>
                        </div>
                    </div>

    

    

    <!-- Terms, Conditions, NDA, Terms Acceptance -->
    <div class="form-group">
        <label>Job Terms</label>
        <textarea name="terms" rows="4" cols="5" class="form-control summernote" placeholder="Define expectations, scope, rules, etc."></textarea>
    </div>

    <div class="form-group">
        <label>Job Conditions</label>
        <textarea name="conditions" rows="4" cols="5" class="form-control summernote" placeholder="Conditions such as tools required, work hours, etc."></textarea>
    </div>

    <div class="form-group">
        <label>NDA Requirement</label>
        <textarea name="nda_requirement" rows="4" cols="5" class="form-control summernote" placeholder="Mention if contractor must sign NDA or confidentiality agreement"></textarea>
    </div>

    <div class="form-group">
        <label>Terms Acceptance Notice</label>
        <textarea name="terms_acceptance" rows="4" cols="5" class="form-control summernote" placeholder="Add disclaimer or acceptance requirement before applying"></textarea>
    </div>

    <!-- Description -->
    <div class="form-group">
        <label>Job Description</label>
        <textarea rows="4" cols="5" class="form-control summernote" name="description" placeholder="Detailed job description to inform applicants about duties and expectations"></textarea>
    </div>

    <!-- Status -->
    <div class="form-group">
        <label class="display-block">Schedule Status</label>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="status" id="product_active" value="1" checked>
            <label class="form-check-label" for="product_active">Active – Visible to users</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="status" id="product_inactive" value="0">
            <label class="form-check-label" for="product_inactive">Inactive – Hidden from users</label>
        </div>
    </div>

    <div class="m-t-20 text-center">
        <button class="btn btn-primary submit-btn">Create Job</button>
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
            // Function to show/hide and manage required attributes
            function toggleOnSiteFields() {
                
                if ($('#jobLocation').val() === 'onsite') {
                    $('#state').removeClass('onSiteFields');
                    $('#city').removeClass('onSiteFields');
                } else {
                    $('#state').addClass('onSiteFields');
                    $('#city').addClass('onSiteFields'); // Clear and unrequire
                }
            }

            function jobType () {
                
                if ($('#jobType').val() == 'hourly') {
                    $('#estimated_hours').removeClass('onSiteFields');
                    
                } else {
                    $('#estimated_hours').addClass('onSiteFields');
                   
                }
            }

            // Call on page load
            // toggleOnSiteFields();
            // jobType();

            // Call on change
            // $('#jobLocation').change(toggleOnSiteFields);
            // $('#jobType').change(jobType);
        });
    </script>

@endpush