<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>3-Step Registration Form</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
      <form id="registrationForm" method="post" action="{{ route('add.user') }}">
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
            <input type="file" class="form-control" id="imageUpload" accept="image/*" onchange="previewImage(event)" required />
            <img id="imagePreview" class="preview-img d-none img-thumbnail" />
          </div>
          <div class="d-flex justify-content-between">
            <button type="button" class="btn btn-secondary" onclick="goToStep(2)">Back</button>
            <button type="button" class="btn btn-primary" onclick="goToStep(4)">Next</button>
          </div>
        </div>
 <div class="form-step" id="step-4">
          <h5 class="mb-3">Your Skills</h5>
          <div class="mb-3">
            <label class="form-label">Select Your Skills</label>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="Laravel" id="skillLaravel" name="skills">
              <label class="form-check-label" for="skillLaravel">Laravel</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="SQL" id="skillSQL" name="skills">
              <label class="form-check-label" for="skillSQL">SQL</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="JavaScript" id="skillJS" name="skills">
              <label class="form-check-label" for="skillJS">JavaScript</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="Python" id="skillPython" name="skills">
              <label class="form-check-label" for="skillPython">Python</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="Vue.js" id="skillVue" name="skills">
              <label class="form-check-label" for="skillVue">Vue.js</label>
            </div>
            <!-- Add more as needed -->
          </div>
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

  document.getElementById('registrationForm').addEventListener('submit', function(e) {
    e.preventDefault();
        const formData = $(this).serialize(); // Get all form data (name=John+Doe&email=...)
        const actionUrl = $(this).attr('action'); // Get the URL from the form's 'action' attribute
        const csrfToken = $('meta[name="csrf-token"]').attr('content'); // Get CSRF token if meta tag exists

        console.log("Form Data:", formData);
        console.log("Sending to URL:", actionUrl);

        // Option 1: Using $.ajax() (Recommended for more control)
        $.ajax({
            url: actionUrl, // The URL to which the data is sent
            type: 'POST',   // HTTP method (GET, POST, PUT, DELETE)
            data: formData, // The serialized form data
            headers: {
                'X-CSRF-TOKEN': csrfToken // Send CSRF token for Laravel forms
            },
            success: function(response) {
                // This function runs if the request is successful (HTTP status 200 OK)
                console.log("Success Response:", response);
                $('#responseMessage').text('Data sent successfully! Response: ' + JSON.stringify(response));
                // You can perform actions here, e.g., update UI, redirect, etc.
            },
            error: function(xhr, status, error) {
                // This function runs if the request fails (e.g., server error, validation errors)
                console.error("Error Status:", status);
                console.error("Error XHR:", xhr);
                console.error("Error Message:", error);
                let errorMessage = 'An error occurred.';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMessage = xhr.responseJSON.message;
                }
                $('#responseMessage').text('Error: ' + errorMessage);
                // Handle specific error types (e.g., display validation errors)
            }
          });
  });
</script>

</body>
</html>
