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
<style>
    /* General body styling for a clean background */

    /* Card styling */
    .card {
        border-radius: 12px; /* Softer rounded corners */
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08); /* Subtle shadow for depth */
        border: none; /* Remove default border */
    }

    .card-header {
        border-top-left-radius: 12px;
        border-top-right-radius: 12px;
        font-weight: 600; /* Bolder header text */
        padding: 1.25rem 1.5rem; /* More padding */
        background-color: #007bff; /* Primary blue */
        color: white;
    }

    /* Modal Styling */
    .modal-content {
        border-radius: 15px; /* More pronounced rounded corners for the modal */
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2); /* Stronger shadow for modal */
        border: none;
        overflow: hidden; /* Ensures rounded corners clip content */
    }

    .modal-header {
        background: linear-gradient(to right, #64DEDE 0%, #64DEDE 100%); /* Elegant gradient */
        color: white;
        border-bottom: none; /* Remove default border */
        padding: 20px 30px; /* Generous padding */
        position: relative;
        overflow: hidden; /* For pseudo-elements */
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
    }

    .modal-header .modal-title {
        font-size: 1.8rem; /* Larger, more impactful title */
        font-weight: 700; /* Bold title */
        position: relative;
        z-index: 1; /* Ensure text is above pseudo-elements */
    }

    .modal-header .close {
        font-size: 2rem; /* Larger close button */
        opacity: 0.8; /* Slightly transparent */
        transition: opacity 0.3s ease; /* Smooth transition */
        text-shadow: none; /* Remove default text shadow */
        color: white; /* Ensure close button is white */
        position: relative;
        z-index: 1;
    }

    .modal-header .close:hover {
        opacity: 1; /* Full opacity on hover */
    }

    .modal-body {
        padding: 30px; /* More internal padding */
        color: #343a40; /* Darker text for readability */
    }

    .modal-body p {
        font-size: 1.1rem; /* Slightly larger body text */
        line-height: 1.6;
    }

    .form-label {
        font-weight: 600; /* Bolder labels */
        color: #495057; /* Slightly darker label color */
        margin-bottom: 0.5rem; /* Space below label */
    }

    .form-control {
        border-radius: 8px; /* Rounded input fields */
        padding: 0.75rem 1rem; /* More comfortable padding */
        border: 1px solid #ced4da; /* Subtle border */
        transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }

    .form-control:focus {
        border-color: #80bdff; /* Standard Bootstrap focus blue */
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25); /* Subtle shadow on focus */
    }

    .form-control-lg {
        padding: 0.85rem 1.15rem; /* Even larger padding for large controls */
    }

    .btn {
        border-radius: 25px; /* Pill-shaped buttons */
        font-weight: 600; /* Bolder button text */
        padding: 0.75rem 2rem; /* Generous padding */
        transition: all 0.3s ease; /* Smooth hover effects */
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); /* Subtle button shadow */
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #004085;
        transform: translateY(-2px); /* Slight lift on hover */
        box-shadow: 0 6px 15px rgba(0, 123, 255, 0.3); /* Enhanced shadow on hover */
    }

    .btn-outline-primary {
        border-color: #007bff;
        color: #007bff;
    }

    .btn-outline-primary:hover {
        background-color: #007bff;
        color: white;
    }

    .btn-success {
        background-color: #28a745;
        border-color: #28a745;
    }

    .btn-success:hover {
        background-color: #218838;
        border-color: #1e7e34;
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(40, 167, 69, 0.3);
    }

    .btn-secondary {
        background-color: #6c757d;
        border-color: #6c757d;
    }

    .btn-secondary:hover {
        background-color: #5a6268;
        border-color: #545b62;
        transform: translateY(-2px);
    }

    .modal-footer {
        border-top: 1px solid #e9ecef; /* Subtle border at the top of the footer */
        padding: 20px 30px; /* More padding */
        background-color: #f8f9fa; /* Light background for footer */
        border-bottom-left-radius: 15px;
        border-bottom-right-radius: 15px;
    }

    /* Icon for "Add Job Qualification" button */
    .btn i {
        vertical-align: middle;
    }

    /* Small text for file input helper */
    .form-text {
        font-size: 0.875rem;
        color: #6c757d;
    }
</style>
</style>
@endpush @section('page-content') 
 <div class="content">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <h4 class="page-title"></h4>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <form action="{{ route('job.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Job Details Section --}}
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Job Qualifications</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 mb-3 text-center"> {{-- Centered the button --}}
                                <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#jobQualificationModal">
                                    <i class="fas fa-plus-circle mr-2"></i> Add Job Qualification
                                </button>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <div class="modal fade" id="jobQualificationModal" tabindex="-1" role="dialog" aria-labelledby="jobQualificationModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg"> {{-- Increased modal size and centered it --}}
                                        <div class="modal-content">
                                            <div class="modal-header bg-gradient-primary text-white"> {{-- Gradient header --}}
                                                <h3 class="modal-title" id="jobQualificationModalLabel">Create a Job Qualification Group</h3>
                                                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body p-4"> {{-- Added padding --}}
                                                <p class="text-muted mb-4">Groups are where your team communicates. They’re best when organized around a topic — #leads, for example.</p>
                                                <form id="jobQualificationForm" action="{{ route('job.store') }}" method="POST" enctype="multipart/form-data">
                                                    @csrf

                                                    <div class="form-group mb-3">
                                                        <label for="education_level" class="form-label">Qualification Level</label>
                                                        <select name="education_level" id="education_level" class="form-control form-control-lg" required> {{-- Larger form control --}}
                                                            <option value="">Select Level</option>
                                                            <option value="high_school">High School</option>
                                                            <option value="bachelor">Bachelor's</option>
                                                            <option value="master">Master's</option>
                                                            <option value="phd">PhD</option>
                                                            <option value="diploma">Diploma</option>
                                                            <option value="certificate">Certificate</option>
                                                        </select>
                                                    </div>

                                                    <div class="form-group mb-3">
                                                        <label for="min_years_experience" class="form-label">Experience (Years)</label>
                                                        <input type="number" class="form-control form-control-lg" id="min_years_experience" name="min_years_experience" placeholder="e.g., 2" min="0"> {{-- Number input for experience --}}
                                                    </div>

                                                    <div class="form-group mb-3">
                                                        <label for="license" class="form-label">License</label>
                                                        <input type="text" class="form-control form-control-lg" id="license" name="license" placeholder="e.g., PMP, CPA">
                                                    </div>

                                                    {{-- <div class="form-group mb-3">
                                                        <label for="attachments" class="form-label">Attachments</label>
                                                        <input type="file" class="form-control-file" id="attachments" name="attachments"> 
                                                        <small class="form-text text-muted">Max file size 5MB. Allowed types: PDF, DOC, DOCX.</small>
                                                    </div> --}}

                                                    <div class="form-group mb-3">
                                                        <label for="language" class="form-label">Language</label>
                                                        <input type="text" class="form-control form-control-lg" id="language" name="language" placeholder="e.g., English, Spanish">
                                                    </div>

                                                    <div class="form-group mb-4">
                                                        <label for="qualification_description" class="form-label">Description</label>
                                                        <textarea class="form-control form-control-lg" id="qualification_description" name="description" placeholder="Provide a detailed description of the qualification requirements..." rows="4"></textarea> {{-- Increased rows --}}
                                                    </div>

                                                    <div class="modal-footer d-flex justify-content-between border-top pt-3"> {{-- Improved footer layout --}}
                                                        <button type="button" class="btn btn-secondary btn-lg" data-dismiss="modal">Cancel</button>
                                                        <button type="submit" class="btn btn-primary btn-lg">Save Qualification</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-center mb-5">
                    <button type="submit" class="btn btn-success submit-btn btn-lg">Create Job</button> {{-- Changed to success for job creation --}}
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