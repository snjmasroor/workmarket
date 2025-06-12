<!doctype html>

<html
  lang="en"
  class="light-style layout-wide customizer-hide"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="{{ asset('assets') }}/"
  data-template="horizontal-menu-template"
  data-style="light">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Registration</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon/favicon.ico') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&amp;display=swap"
      rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/fontawesome.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/tabler-icons.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/flag-icons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/rtl/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/rtl/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/node-waves/node-waves.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/typeahead-js/typeahead.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/bs-stepper/bs-stepper.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/bootstrap-select/bootstrap-select.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/dropzone/dropzone.css') }}" />

    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/@form-validation/form-validation.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/flatpickr/flatpickr.css') }}" />
    <!-- Page CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/page-auth.css') }}" />
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/animate-css/animate.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/sweetalert2/sweetalert2.css')}}" />

    <!-- Helpers -->
    <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>

    <!-- Template customizer & Theme config -->
    <script src="{{ asset('assets/vendor/js/template-customizer.js') }}"></script>
    <script src="{{ asset('assets/js/config.js') }}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.min.css" />
    <style>
        #phone:focus {
          padding: 6px;
          margin: 0px;
          width: 339px;
        }
        #phone {
          padding: 6px;
          margin: 0px;
          width: 339px;
        }
        .auth-cover-brand img{
          width: 20%;
          height: 20%;
        }
        .auth-cover-brand {
          margin: -90px;
        }
    </style>   
  </head>
  <body>
    <!-- Content -->
    <div class="authentication-wrapper authentication-cover authentication-bg">
        <!-- Logo -->
        <a href="index.html" class="app-brand auth-cover-brand">
        <img src="{{asset('assets/img/logo.webp')}}">
          <span class="app-brand-text demo text-heading fw-bold"></span>
        </a>
        <!-- /Logo -->
        <div class="authentication-inner row">
           <!-- Left Text -->
            <div class="d-none d-lg-flex col-lg-4 align-items-center justify-content-center p-5 auth-cover-bg-color position-relative auth-multisteps-bg-height">
            <img src="{{asset('assets/img/illustrations/auth-register-multisteps-illustration.png')}}" alt="auth-register-multisteps" class="img-fluid" width="280" />
            <img src="{{asset('assets//img/illustrations/auth-register-multisteps-shape-light.png')}}" alt="auth-register-multisteps" class="platform-bg" data-app-light-img="illustrations/auth-register-multisteps-shape-light.png" data-app-dark-img="illustrations/auth-register-multisteps-shape-dark.png" />
        </div>
        <!-- /Left Text -->

        <!--  Multi Steps Registration -->
        <div class="d-flex col-lg-8 align-items-center justify-content-center authentication-bg p-5">
          <div class="w-px-700">
            <div id="multiStepsValidation" class="bs-stepper border-none shadow-none mt-5">
              <div class="bs-stepper-header border-none pt-12 px-0">
                  <div class="step" data-target="#accountDetailsValidation">
                    <button type="button" class="step-trigger">
                      <span class="bs-stepper-circle"><i class="ti ti-file-analytics ti-md"></i></span>
                      <span class="bs-stepper-label">
                        <span class="bs-stepper-title">Account</span>
                        <span class="bs-stepper-subtitle">Account Details</span>
                      </span>
                    </button>
                  </div>
                  <div class="line">
                    <i class="ti ti-chevron-right"></i>
                  </div>
                  <div class="step" data-target="#personalInfoValidation">
                    <button type="button" class="step-trigger">
                      <span class="bs-stepper-circle"><i class="ti ti-user ti-md"></i></span>
                      <span class="bs-stepper-label">
                        <span class="bs-stepper-title">Education</span>
                        <span class="bs-stepper-subtitle">Enter Information</span>
                      </span>
                    </button>
                  </div>
                  <div class="line">
                    <i class="ti ti-chevron-right"></i>
                  </div>
                  <div class="step" data-target="#billingLinksValidation">
                    <button type="button" class="step-trigger">
                      <span class="bs-stepper-circle"><i class="ti ti-credit-card ti-md"></i></span>
                      <span class="bs-stepper-label">
                        <span class="bs-stepper-title">Industry and Skills</span>
                        <span class="bs-stepper-subtitle">Industry and Skills Details</span>
                      </span>
                    </button>
                  </div>
                </div>
               <div class="bs-stepper-content px-0">
                <form id="multiStepsForm" method="post"  onSubmit="return false" action="{{ route('add.user') }}" enctype="multipart/form-data">
                  
                  <!-- Account Details -->
                  <div id="accountDetailsValidation" class="content">
                      <div class="content-header mb-6">
                        <h4 class="mb-0">Account Information</h4>
                        <p class="mb-0">Enter Your Account Details</p>
                      </div>
                      <div class="row g-6">
                        <div class="col-sm-6">
                          <label class="form-label" for="firstname">First Name</label>
                          <input type="text" name="firstname" id="firstname" class="form-control" placeholder="john" />
                        </div>
                        <div class="col-sm-6">
                          <label class="form-label" for="lastname">Last Name</label>
                          <input type="text" name="lastname" id="lastname" class="form-control" placeholder="john" />
                        </div>
                        <div class="col-sm-6">
                          <label class="form-label" for="multiStepsUsername">Username</label>
                          <input type="text" name="username" id="multiStepsUsername" class="form-control" placeholder="johndoe" />
                        </div>
                        <div class="col-sm-6">
                          <label class="form-label" for="multiStepsEmail">Email</label>
                          <input type="email" name="email" id="multiStepsEmail" class="form-control" placeholder="john.doe@email.com" aria-label="john.doe" />
                        </div>
                        <div class="col-sm-6 form-password-toggle">
                          <label class="form-label" for="multiStepsPass">Password</label>
                          <div class="input-group input-group-merge">
                            <input type="password" id="multiStepsPass" name="password" class="form-control" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="multiStepsPass2" />
                            <span class="input-group-text cursor-pointer" id="multiStepsPass2"><i class="ti ti-eye-off"></i></span>
                          </div>
                        </div>
                        <div class="col-sm-6 form-password-toggle">
                          <label class="form-label" for="multiStepsConfirmPass">Confirm Password</label>
                          <div class="input-group input-group-merge">
                            <input type="password" id="multiStepsConfirmPass" name="password_confirmation" class="form-control" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="multiStepsConfirmPass2" />
                            <span class="input-group-text cursor-pointer" id="multiStepsConfirmPass2"
                              ><i class="ti ti-eye-off"></i
                            ></span>
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <label class="form-label" for="photo">Mobile</label>
                          <div class="input-group">
                            <input type="tel" id="phone" name="phone" class="form-control multi-steps-mobile">
                            <input type="hidden" id="full_phone" name="full_phone">
                          </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="country">Country</label>
                            <select id="country" class="select2 form-select" data-allow-clear="true" name="country">
                              <option value="">Select Country</option>
                                @foreach($countries as $code => $country)
                                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                                @endforeach
                            </select>
                          </div>
                        <div class="col-sm-6">
                            <label for="select2Multiple" class="form-label">Select State</label>
                            <select id="state" class="select2 form-select" name="state">
                                <option value="">Select State</option>        
                            </select>
                        </div>
                        <div class="col-sm-6">
                          <label class="form-label" for="postal_code">Pincode</label>
                          <input type="text" id="postal_code" name="postal_code" class="form-control multi-steps-pincode" placeholder="Postal Code" maxlength="6" />
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="address">Address</label>
                            <gmpx-place-autocomplete style="width: 100%">
                                <input type="text" id="autocomplete" name="address" class="form-control" placeholder="Enter your address" autocomplete="off" />
                            </gmpx-place-autocomplete>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label" for="city">City</label>
                            <input type="text" id="city" name="city" class="form-control" placeholder="City" />
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
                      <h4 class="mb-0">Education Information</h4>
                      <p class="mb-0">Enter Your Highest Educational</p>
                    </div>
                    <div class="row g-6">
                      <div class="col-sm-6">
                        <label class="form-label" for="school">School / University</label>
                        <input
                          type="text"
                          name="school"
                          id="school"
                          class="form-control"
                          placeholder="University" />
                      </div>
                      <div class="col-sm-6">
                        <label class="form-label" for="degree">Degree</label>
                        <input
                          type="text"
                          name="degree"
                          id="degree"
                          class="form-control"
                          placeholder="e.g. BSc, MSc, PhD" />
                      </div>
                      <div class="col-sm-6">
                        <label class="form-label" for="field">Field of Study</label>
                        <input
                          type="text"
                          name="field"
                          id="field"
                          class="form-control"
                          placeholder="e.g Computer Science" />
                      </div>
                      <div class="col-sm-6">
                       <label class="form-label" for="start_date">Start Date</label>
                        <input
                          type="text"
                          name="start_date"
                          id="start_date"
                          class="form-control"
                          placeholder="Select Start Date" />
                          <label class="switch switch-dark">
                            <input type="checkbox" id="dateToggle" class="switch-input" />
                            <span class="switch-toggle-slider">
                              <span class="switch-on">
                                <i class="ti ti-check"></i>
                              </span>
                              <span class="switch-off">
                                <i class="ti ti-x"></i>
                              </span>
                            </span>
                            <span class="switch-label">Still Continue</span>
                          </label>
                      </div>
                      <div class="col-sm-6" id="endDateWrapper">
                        <label class="form-label" for="end_date">End Date</label>
                        <input
                          type="text"
                          name="end_date"
                          id="end_date"
                          class="form-control"
                          placeholder="Select End Date" />

                      </div>
                      <div class="col-sm-12">
                        <label class="form-label" for="description">Additional Information</label>
                        <textarea
                          type="text"
                          name="description"
                          id="description"
                          class="form-control"
                           rows="4"
                          placeholder=""> 
                          </textarea>
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
                      <h4 class="mb-0">Industry and Skills</h4>
                      <p class="mb-0">Industry and Skills as per your requirement</p>
                    </div>
                    <!-- Custom plan options -->
                    <div class="row gap-md-0 gap-4 mb-12">
                       <div class="row g-6">
                      <div class="col-sm-6">
                        <label class="form-label" for="industry">Industry</label>
                         <select name ="industry_id" id="industry_id" class="select2 form-select" data-allow-clear="true">
                          <option value="">Select Industry</option>
                            @foreach($industry_skills as $code => $industry_skill)
                                <option value="{{ $industry_skill->id }}">{{ $industry_skill->name }}</option>
                            @endforeach
                        </select>
                      </div>
                      <div class="col-sm-6">
                        <label class="form-label" for="skill">Select Skills</label>
                          <select
                            id="selectpickerSelection"
                            class="selectpicker w-100"
                            data-style="btn-default"
                            name="skill_ids[]"
                            multiple
                            data-max-options="10">
                          <option value="">Select Skills</option>
                        </select>
                      </div>
                      <div class="col-sm-12">
                         <label class="form-label" for="resume">Resume</label>
                         <input type="file" name="resume" class="form-control" id="inputGroupFile02">
                         <label class="input-group-text" for="inputGroupFile02">Upload</label>
                      </div>
                      
                  
                      
                      <div class="col-12 d-flex justify-content-between">
                        <button class="btn btn-label-secondary btn-prev">
                          <i class="ti ti-arrow-left ti-xs me-sm-2 me-0"></i>
                          <span class="align-middle d-sm-inline-block d-none">Previous</span>
                        </button>
                        <button type="submit" class="btn btn-success btn-submit" id="finalSubmit">Submit</button>
                      </div>
                    </div>
                    </div>
                    <!--/ Custom plan options -->
                      
                    <!--/ Credit Card Details -->
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- / Multi Steps Registration -->
      </div>
    </div>

    <script>
      // Check selected custom option
      window.Helpers.initCustomOptionCheck();
    </script>

    <!-- / Content -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->

  <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
  <script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/node-waves/node-waves.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/hammer/hammer.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/i18n/i18n.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/typeahead-js/typeahead.js') }}"></script>
  <script src="{{ asset('assets/vendor/js/menu.js') }}"></script>

  <!-- Vendors JS -->
  <script src="{{ asset('assets/vendor/libs/cleavejs/cleave.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/cleavejs/cleave-phone.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/bs-stepper/bs-stepper.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/@form-validation/popular.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/@form-validation/bootstrap5.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/@form-validation/auto-focus.js') }}"></script>
 <script src="{{ asset('assets/js/extended-ui-sweetalert2.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>

  <!-- Main JS -->
  <script src="{{ asset('assets/js/main.js') }}"></script>

  <!-- Page JS -->
  <script src="{{ asset('assets/js/pages-auth-multisteps.js') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.css" />
    <script src="{{ asset('assets/vendor/libs/flatpickr/flatpickr.js') }}"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script>
  flatpickr("#start_date", {
    dateFormat: "Y-m-d",
    onChange: function(selectedDates, dateStr, instance) {
      endPicker.set("minDate", dateStr); // set minDate on end date
    }
  });

  const endPicker = flatpickr("#end_date", {
    dateFormat: "Y-m-d",
  });
</script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    var input = document.querySelector("#phone");
    var fullPhoneInput = document.querySelector("#full_phone");
   const iti = window.intlTelInput(input, {
        // You can still set an initial country if you want, e.g., based on your app's locale or common user base
        initialCountry: "us", // This will default to the first country in the dropdown without a geoIpLookup
        preferredCountries: ['us', 'gb', 'in'], // Prioritize certain countries if needed
        separateDialCode: true, // Show dial code separately
        utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js", // Still necessary for formatting/validation
    });
    function updateFullPhone() {
      fullPhoneInput.value = iti.getNumber(); // Always update with full international number
    }

    // Update on input and country change
    input.addEventListener("input", updateFullPhone);
    input.addEventListener("change", updateFullPhone);
    input.addEventListener("countrychange", updateFullPhone);
});
</script>
  <script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDpAp8c4sU4fU8bxZyYVCuyEHBXT3Y3wjA&libraries=places"></script>

<script>
$(document).ready(function () {
    var baseUrl = "{{ route('user.get.states', ['country' => '0']) }}";
    $('#state').select2({
        placeholder: 'Select your state', // <--- Change this line
        // ... other options
    });
     $('#country').select2({
        placeholder: 'Select your country', // <--- Change this line
        // ... other options
    });
    $('#industry_id').select2({
        placeholder: 'Select your industry', // <--- Change this line
        // ... other options
    });
    $('#selectpickerSelection').select2({
        placeholder: 'Select your skills', // <--- Change this line
        // ... other options
    });

    const toggle = document.getElementById("dateToggle");
  const endDateWrapper = document.getElementById("endDateWrapper");

  toggle.addEventListener("change", () => {
    if (toggle.checked) {
      endDateWrapper.style.display = "none";
    } else {
      endDateWrapper.style.display = "block";
    }
  });

  // Run on page load to set correct visibility
  if (toggle.checked) {
    endDateWrapper.style.display = "none";
  }
    $('#country').on('change', function () {
        var countryCode = $(this).val();
       
        var finalUrl = baseUrl + countryCode;
        console.log(finalUrl);

        $.ajax({
            url: finalUrl,
            method: 'GET',
            success: function (data) {
                var $stateSelect = $('#state');
                $stateSelect.empty().append('<option value="">Select State</option>');

               $.each(data, function (index, state) {
                    $stateSelect.append('<option value="' + state.id + '">' + state.name + '</option>');
                });
            },
            error: function () {
                alert('Unable to fetch states. Please try again.');
            }
        });
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
});

$('#finalSubmit').on('click', function () {
  $('#multiStepsForm').on('submit', function (e) {
      e.preventDefault();

      const form = document.getElementById('multiStepsForm');
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
            console.log(response.status);
              if (response.status == true) {
                    Swal.fire({
                        title: 'Success!',
                        text: response.message,
                        timer: 3000,
                        timerProgressBar: true,
                        toast: false,
                        icon: 'success'
                    }).then(() => {
                          $('#multiStepsForm')[0].reset();

                          setTimeout(function () {
                            location.reload();
                        }, 3000);
                      });
                    } else if (response.status !== true) {
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
    
</script>

  </body>
</html>
