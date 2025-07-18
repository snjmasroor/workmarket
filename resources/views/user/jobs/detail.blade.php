@extends('layouts.backend.master')
@push('styles')
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/bs-stepper/bs-stepper.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/bootstrap-select/bootstrap-select.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/tagify/tagify.css') }}" />
<script src="https://www.paypal.com/sdk/js?client-id={{ config('paypal.sandbox.client_id') }}&components=buttons,card-fields"></script>
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

                   <h3>Job Title</h3>
                   <h4>{{ $job->title }}</h4> 
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
                  {!! html_entity_decode($job->description) !!}
            </div>
            <div class="col-md-4">
                  <div class="card">
                        <div class="card-header"><h4 class="justify-content-center">Apply Here</h4></div>
                        <div class="card-body">
                              <button class="btn btn-primary" onclick="applyForJob({{ $job->id }})">Apply Now</button>
                          </div>
                  </div>

            </div>
      </div>
      <div class="row">
            <div class="col-md-8">
                  <h4>Job Industry</h4>
                  {{ $job->industry->name}}
            </div>
      </div>
@if($job->tools && $job->tools->count())
  <div class="row mt-4">
    <div class="col-12 mb-3">
      <h5 class="text-primary">Required Tools</h5>
    </div>

    @foreach($job->tools as $tool)
      <div class="card mb-3">
      <div class="card-body">
            <h5>{{ $tool->name }}</h5>
            <p>{{ $tool->description }}</p>
            <strong>${{ $tool->price }}</strong>

            
            <button class="btn btn-primary mt-2 show-paypal-btn" data-tool-id="{{ $tool->id }}">
            Buy Tool
            </button>
            <div id="paypal-button-container-{{ $tool->id }}" class="mt-2" style="display:none;"></div>
      </div>
      </div>
      @endforeach
  </div>
@else
  <p class="text-muted">No tools are required for this job.</p>
@endif
</div>
@endsection
@push('scripts')
<script src="https://www.paypal.com/sdk/js?client-id={{ env('PAYPAL_CLIENT_ID') }}&currency=USD&intent=capture"></script>

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

<script>
$(document).ready(function () {
    $(".show-paypal-btn").click(function () {
        const toolId = $(this).data("tool-id");
        $(this).hide();
        $("#paypal-button-container-" + toolId).show();
        var csrf = $('meta[name="csrf-token"]').attr('content');
        paypal.Buttons({
            createOrder: function () {
                return $.ajax({
                    url: "{{ route('paypal.order.create') }}",
                    method: "POST",
                    contentType: "application/json",
                    data: JSON.stringify({ tool_id: toolId }),
                    headers: {
                        "X-CSRF-TOKEN": csrf 
                    }
                }).then(res => res.id);
            },
            onApprove: function (data) {
                return $.ajax({
                    url: "{{ route('paypal.order.capture') }}",
                    method: "POST",
                    contentType: "application/json",
                    data: JSON.stringify({
                        order_id: data.orderID,
                        tool_id: toolId
                    }),
                    headers: {
                        "X-CSRF-TOKEN": csrf 
                    }
                }).then(res => {
                    alert("Tool purchased successfully!");
                    location.reload();
                });
            },
            onError: function (err) {
                console.error(err);
                alert("Payment failed.");
            }
        }).render("#paypal-button-container-" + toolId);
    });
});
</script>
@endpush