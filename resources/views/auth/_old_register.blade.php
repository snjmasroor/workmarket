<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>3-Step Registration Form</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="{{asset('assets/css/select2.min.css')}}"> 
  <style>
    .form-step {
      display: none;
    }
    .form-step.active {
      display: block;
    }
    .preview-img {
      max-height: 200px;
      margin-top: 10px;
    }
  </style>
</head>
<body class="bg-light">

<div class="container mt-5">
  <div class="card shadow-lg">
    <div class="card-header bg-primary text-white text-center">
      <h4>User Registration</h4>
    </div>
    <div class="card-body">
      <form id="registrationForm" method="post" action="{{ route('add.user') }}" enctype="multipart/form-data">
        <!-- Step 1 -->
        <div class="form-step active" id="step-1">
          <h5 class="mb-3">Personal Details</h5>
          <div class="row mb-3">
            <div class="col-md-6">
              <label class="form-label">First name</label>
              <input type="text" class="form-control" name="firstname" required />
            </div>
            <div class="col-md-6">
              <label class="form-label">Last name</label>
              <input type="text" class="form-control" name="lastname" required />
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-md-6">
              <label class="form-label">Email</label>
              <input type="email" class="form-control" required name="email"/>
            </div>
            <div class="col-md-6">
              <label class="form-label">Phone</label>
              <input type="tel" class="form-control" required  name="phone"/>
            </div>
          </div>
          <div class="mb-3">
            <label class="form-label">Address Line</label>
            <input type="text" class="form-control" required  name="address"/>
          </div>
          <div class="row mb-3">
            <div class="col-md-6">
              <label class="form-label">Country</label>
              <select class="form-select" name="country" required>
                <option value="">Select Country</option>
                <option value="USA">USA</option>
                <option value="Canada">Canada</option>
                <option value="UK">UK</option>
                <option value="India">India</option>
              </select>
            </div>
            <div class="col-md-6">
              <label class="form-label">State/Province</label>
              <input type="text" class="form-control" required name="state"/>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-md-6">
              <label class="form-label">ZIP Code</label>
              <input type="text" class="form-control" name="zipcode" required />
            </div>
            <div class="col-md-6">
              <label class="form-label">City</label>
              <input type="text" class="form-control" required name="city"/>
            </div>
          </div>
          <div class="text-end">
            <button type="button" class="btn btn-primary" onclick="goToStep(2)">Next</button>
          </div>
        </div>

        <!-- Step 2 -->
        <div class="form-step" id="step-2">
          <h5 class="mb-3">Account Credentials</h5>
          <div class="mb-3">
            <label class="form-label">Username</label>
            <input type="text" class="form-control"  name="username" required />
          </div>
          <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" class="form-control" name="password" required />
          </div>
          <div class="mb-3">
            <label class="form-label">Confirm Password</label>
            <input type="password" class="form-control" name="password_confirmation" required />
          </div>
          <div class="d-flex justify-content-between">
            <button type="button" class="btn btn-secondary" onclick="goToStep(1)">Back</button>
            <button type="button" class="btn btn-primary" onclick="goToStep(3)">Next</button>
          </div>
        </div>

        <!-- Step 3 -->
        <div class="form-step" id="step-3">
          <h5 class="mb-3">Upload Profile Image</h5>
          <div class="mb-3">
            <label class="form-label">Select Image</label>
            <input type="file" class="form-control" name="image" id="imageUpload" accept="image/*" onchange="previewImage(event)" required />
            <img id="imagePreview" class="preview-img d-none img-thumbnail" />
          </div>
          <div class="d-flex justify-content-between">
            <button type="button" class="btn btn-secondary" onclick="goToStep(2)">Back</button>
            <button type="button" class="btn btn-primary" onclick="goToStep(4)">Next</button>
          </div>
        </div>
 <div class="form-step" id="step-4">
          <h5 class="mb-3">Your Industry and Skills</h5>
<div class="mb-3">
  <label class="form-label">Select Your Industry and Skills</label>
  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <label>Industry</label>
        <select name="industry_id" id="industry_id" class="form-control" required>
          <option value="">-- Select Industry --</option>
          @foreach($industry_skills as $industry)
            <option value="{{ $industry->id }}">{{ $industry->name }}</option>
          @endforeach
        </select>
      </div>
    </div>

    <div class="col-md-6">
      <div class="form-group">
        <label>Skills</label>
        <select class="form-control" id="skills" name="skill_ids[]" multiple>
          <option value="">-- Select Skill --</option>
        </select>
      </div>
    </div>
  </div>

  <!-- Status (unchanged) -->
                        
          <div class="d-flex justify-content-between">
            <button type="button" class="btn btn-secondary" onclick="goToStep(3)">Back</button>
            <button type="submit" class="btn btn-success">Submit</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('assets/js/select2.min.js') }}"></script>
<script>
    
  function goToStep(step) {
    document.querySelectorAll('.form-step').forEach(el => el.classList.remove('active'));
    document.getElementById(`step-${step}`).classList.add('active');
  }

  function previewImage(event) {
    const img = document.getElementById('imagePreview');
    img.src = URL.createObjectURL(event.target.files[0]);
    img.classList.remove('d-none');
  }

  $('#registrationForm').on('submit', function (e) {
    e.preventDefault();

    const form = document.getElementById('registrationForm');
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
            console.log("Success Response:", response);
            $('#responseMessage').text('Data sent successfully! Response: ' + JSON.stringify(response));
        },
        error: function (xhr, status, error) {
            console.error("Error Status:", status);
            console.error("Error XHR:", xhr);
            console.error("Error Message:", error);
            let errorMessage = 'An error occurred.';
            if (xhr.responseJSON && xhr.responseJSON.message) {
                errorMessage = xhr.responseJSON.message;
            }
            $('#responseMessage').text('Error: ' + errorMessage);
        }
    });
});
</script>

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

</body>
</html>
