@extends('layouts.backend.master')
@push('styles')
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/bs-stepper/bs-stepper.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/bootstrap-select/bootstrap-select.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/tagify/tagify.css') }}" />
@endpush 
@section('page-content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"></div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('message') }}
                        </div>
                    @endif

                   <h3>Recuitments</h3> 
                </div>
            </div>
            
        </div>
    </div>
</div>
<hr>
<div class="container">
      <div class="row justify-content-center">
            <div class="col-md-8">
                  <h4> Job Description</h4>
                 
            </div>
            <div class="col-md-4">
                  <h4>Contracts</h4>
                  @if ($contracts->isEmpty())
                        <div class="alert alert-info">You have no contracts yet.</div>
                  @else
                        @foreach ($contracts as $contract)
                              <p><a href="{{ route('user.contracts.view', $contract->id) }}"> Contracts</a></p>
                        @endforeach
                  @endif
            </div>
      </div>
      <div class="row">
            <div class="col-md-8">
                  <h4>Job Industry</h4>
                 
            </div>
      </div>
</div>
@endsection
@push('scripts')
<script src="{{ asset('assets/vendor/libs/cleavejs/cleave.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/cleavejs/cleave-phone.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/bs-stepper/bs-stepper.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/bloodhound/bloodhound.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/tagify/tagify.js') }}"></script>
<script>
      function applyForJob(jobId) {
            const csrfToken = $('meta[name="csrf-token"]').attr('content');
            const applyJobRouteBase = "{{ url('/user/job/apply') }}";
            fetch(`${applyJobRouteBase}/${jobId}`, {
                  method: 'POST',
                  headers: {
                  'X-CSRF-TOKEN': csrfToken
                  },
                  
            })
            .then(response => response.json())
            .then(data => {
            if (data.status === 'success') {
                  Swal.fire({
                        title: 'Success!',
                        text: data.message ?? 'Application submitted successfully.',
                        timer: 3000,
                        timerProgressBar: true,
                        toast: false,
                        icon: 'success'
                  }).then(() => {
                        // Optional actions after success (e.g., reset form, reload, close modal)
                        // Example:
                        // $('#multiForm')[0].reset();
                        // location.reload();
                  });
            } else {
                  let errorText = data.message ?? 'Something went wrong.';
                  if (data.error) {
                        errorText += `\n${data.error}`;
                  }

                  Swal.fire({
                        title: 'Error',
                        text: errorText,
                        timer: 3000,
                        timerProgressBar: true,
                        toast: false,
                        icon: 'error',
                        showConfirmButton: false
                  });
            }
            })
            .catch(err => {
                  console.error('Request failed', err);
            });
      }
</script>
@endpush