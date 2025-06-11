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
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

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
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/@form-validation/form-validation.css') }}" />

    <!-- Page CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/page-auth.css') }}" />

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
    </style>  
</head>

  <body>
    <!-- Content -->

    <div class="authentication-wrapper authentication-cover authentication-bg">
      <!-- Logo -->
      <a href="index.html" class="app-brand auth-cover-brand">
        <span class="app-brand-logo demo">
          <svg width="32" height="22" viewBox="0 0 32 22" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path
              fill-rule="evenodd"
              clip-rule="evenodd"
              d="M0.00172773 0V6.85398C0.00172773 6.85398 -0.133178 9.01207 1.98092 10.8388L13.6912 21.9964L19.7809 21.9181L18.8042 9.88248L16.4951 7.17289L9.23799 0H0.00172773Z"
              fill="#7367F0" />
            <path
              opacity="0.06"
              fill-rule="evenodd"
              clip-rule="evenodd"
              d="M7.69824 16.4364L12.5199 3.23696L16.5541 7.25596L7.69824 16.4364Z"
              fill="#161616" />
            <path
              opacity="0.06"
              fill-rule="evenodd"
              clip-rule="evenodd"
              d="M8.07751 15.9175L13.9419 4.63989L16.5849 7.28475L8.07751 15.9175Z"
              fill="#161616" />
            <path
              fill-rule="evenodd"
              clip-rule="evenodd"
              d="M7.77295 16.3566L23.6563 0H32V6.88383C32 6.88383 31.8262 9.17836 30.6591 10.4057L19.7824 22H13.6938L7.77295 16.3566Z"
              fill="#7367F0" />
          </svg>
        </span>
        <span class="app-brand-text demo text-heading fw-bold">Vuexy</span>
      </a>
      <!-- /Logo -->
      <div class="authentication-inner row">
        <!-- Left Text -->
        <div
          class="d-none d-lg-flex col-lg-4 align-items-center justify-content-center p-5 auth-cover-bg-color position-relative auth-multisteps-bg-height">
          <img
            src="{{asset('assets/img/illustrations/auth-register-multisteps-illustration.png')}}"
            alt="auth-register-multisteps"
            class="img-fluid"
            width="280" />

          <img
            src="{{asset('assets//img/illustrations/auth-register-multisteps-shape-light.png')}}"
            alt="auth-register-multisteps"
            class="platform-bg"
            data-app-light-img="illustrations/auth-register-multisteps-shape-light.png"
            data-app-dark-img="illustrations/auth-register-multisteps-shape-dark.png" />
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
                <form id="multiStepsForm" onSubmit="return false">
                  <!-- Account Details -->
                  <div id="accountDetailsValidation" class="content">
                    <div class="content-header mb-6">
                      <h4 class="mb-0">Account Information</h4>
                      <p class="mb-0">Enter Your Account Details</p>
                    </div>
                    <div class="row g-6">
                      <div class="col-sm-6">
                        <label class="form-label" for="firstname">First Name</label>
                        <input
                          type="text"
                          name="firstname"
                          id="firstname"
                          class="form-control"
                          placeholder="john" />
                      </div>
                      <div class="col-sm-6">
                        <label class="form-label" for="lastname">Last Name</label>
                        <input
                          type="text"
                          name="lastname"
                          id="lastname"
                          class="form-control"
                          placeholder="john" />
                      </div>
                      <div class="col-sm-6">
                        <label class="form-label" for="multiStepsUsername">Username</label>
                        <input
                          type="text"
                          name="multiStepsUsername"
                          id="multiStepsUsername"
                          class="form-control"
                          placeholder="johndoe" />
                      </div>
                      <div class="col-sm-6">
                        <label class="form-label" for="multiStepsEmail">Email</label>
                        <input
                          type="email"
                          name="multiStepsEmail"
                          id="multiStepsEmail"
                          class="form-control"
                          placeholder="john.doe@email.com"
                          aria-label="john.doe" />
                      </div>
                      <div class="col-sm-6 form-password-toggle">
                        <label class="form-label" for="multiStepsPass">Password</label>
                        <div class="input-group input-group-merge">
                          <input
                            type="password"
                            id="multiStepsPass"
                            name="multiStepsPass"
                            class="form-control"
                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                            aria-describedby="multiStepsPass2" />
                          <span class="input-group-text cursor-pointer" id="multiStepsPass2"
                            ><i class="ti ti-eye-off"></i
                          ></span>
                        </div>
                      </div>
                      <div class="col-sm-6 form-password-toggle">
                        <label class="form-label" for="multiStepsConfirmPass">Confirm Password</label>
                        <div class="input-group input-group-merge">
                          <input
                            type="password"
                            id="multiStepsConfirmPass"
                            name="multiStepsConfirmPass"
                            class="form-control"
                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                            aria-describedby="multiStepsConfirmPass2" />
                          <span class="input-group-text cursor-pointer" id="multiStepsConfirmPass2"
                            ><i class="ti ti-eye-off"></i
                          ></span>
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <label class="form-label" for="photo">Mobile</label>
                        <div class="input-group">
                          <input type="tel" id="phone" name="phone" class="form-control multi-steps-mobile">
                          
                        </div>
                      </div>
                       

                        <div class="col-md-6">
                        <label class="form-label" for="country">Country</label>
                         <select id="country" class="select2 form-select" data-allow-clear="true">
                          <option value="">Select Country</option>
                            @foreach($countries as $code => $country)
                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                            @endforeach
                        </select>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label" for="state">State</label>
                            <select id="state" class="select2 form-select" data-allow-clear="true">
                                <option value="">Select State</option>
                                    
                            </select>
                        </div>
                        <div class="col-sm-6">
                        <label class="form-label" for="postal_code">Pincode</label>
                        <input
                          type="text"
                          id="postal_code"
                          name="postal_code"
                          class="form-control multi-steps-pincode"
                          placeholder="Postal Code"
                          maxlength="6" />
                      </div>
                       <div class="col-md-6">
                        <label class="form-label" for="address">Address</label>
                        <gmpx-place-autocomplete style="width: 100%">
                            <input
                            type="text"
                            id="autocomplete"
                            class="form-control"
                            placeholder="Enter your address"
                            autocomplete="off" />
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
                          placeholder="" />
                      </div>
                      <div class="col-sm-6">
                        <label class="form-label" for="start_date">Start Date</label>
                        <input
                          type="text"
                          name="start_date"
                          id="start_date"
                          class="form-control"
                          placeholder="" />
                      </div>
                      <div class="col-sm-6">
                        <label class="form-label" for="end_date">End Date</label>
                        <input
                          type="text"
                          name="end_date"
                          id="end_date"
                          class="form-control"
                          placeholder="" />
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
                        <label class="form-label" for="school">Industry</label>
                         <select  id="industry_id" class="select2 form-select" data-allow-clear="true">
                          <option value="">Select Industry</option>
                            @foreach($industry_skills as $code => $industry_skill)
                                <option value="{{ $industry_skill->id }}">{{ $industry_skill->name }}</option>
                            @endforeach
                        </select>
                      </div>
                      <div class="col-sm-6">
                        <label class="form-label" for="school">Skills</label>
                         <select multiple id="skills" class="select2 form-select" data-allow-clear="true">
                          <option value="">Select Skills</option>
                        </select>
                      </div>
                      <div class="col-sm-6">
                        <label class="form-label" for="field">Field of Study</label>
                        <input
                          type="text"
                          name="field"
                          id="field"
                          class="form-control"
                          placeholder="" />
                      </div>
                      <div class="col-sm-6">
                        <label class="form-label" for="start_date">Start Date</label>
                        <input
                          type="text"
                          name="start_date"
                          id="start_date"
                          class="form-control"
                          placeholder="" />
                      </div>
                      <div class="col-sm-6">
                        <label class="form-label" for="end_date">End Date</label>
                        <input
                          type="text"
                          name="end_date"
                          id="end_date"
                          class="form-control"
                          placeholder="" />
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
                        <button type="submit" class="btn btn-success btn-next btn-submit">Submit</button>
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

  <!-- Main JS -->
  <script src="{{ asset('assets/js/main.js') }}"></script>

  <!-- Page JS -->
  <script src="{{ asset('assets/js/pages-auth-multisteps.js') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    var input = document.querySelector("#phone");
    window.intlTelInput(input, {
        // You can still set an initial country if you want, e.g., based on your app's locale or common user base
        initialCountry: "us", // This will default to the first country in the dropdown without a geoIpLookup
        preferredCountries: ['us', 'gb', 'in'], // Prioritize certain countries if needed
        separateDialCode: true, // Show dial code separately
        utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js", // Still necessary for formatting/validation
    });
});
</script>
  <script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDpAp8c4sU4fU8bxZyYVCuyEHBXT3Y3wjA&libraries=places"></script>
<script>
  document.addEventListener("DOMContentLoaded", function () {
    const autocompleteElement = document.getElementById("autocomplete");
    console.log(autocompleteElement);

    if (!autocompleteElement) return;

    autocompleteElement.addEventListener("gmpx-placeautocomplete-placechange", () => {
      const place = autocompleteElement.value;

      const cityInput = document.getElementById("city");
      const stateInput = document.getElementById("state");
      const areaInput = document.getElementById("country"); // this is your area/landmark field

      if (!autocompleteElement.getPlace) return;
      const details = autocompleteElement.getPlace();

      let city = "", state = "", area = "";

      if (details?.address_components) {
        details.address_components.forEach((component) => {
          const types = component.types;
          if (types.includes("locality")) city = component.long_name;
          if (types.includes("administrative_area_level_1")) state = component.long_name;
          if (types.includes("sublocality") || types.includes("neighborhood")) area = component.long_name;
        });
      }

      if (cityInput) cityInput.value = city;
      if (stateInput) stateInput.value = state;
      if (areaInput) areaInput.value = area;
    });
  });
</script>
<script>
$(document).ready(function () {
    var baseUrl = "{{ route('user.get.states', ['country' => '0']) }}";
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

  </body>
</html>
