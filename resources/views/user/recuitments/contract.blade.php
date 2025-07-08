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
                  <div class="card-header">Contract Details</div>
  
                  <div class="card-body">
                      @if (session('success'))
                          <div class="alert alert-success" role="alert">
                              {{ session('success') }}
                          </div>
                      @endif
  
                      <h3></h3>
                      <p><strong>Start Date:</strong> {{ \Carbon\Carbon::parse($contract->start_date)->format('d M Y') }}</p>
                      <p><strong>End Date:</strong> {{ \Carbon\Carbon::parse($contract->end_date)->format('d M Y') }}</p>
                      
                      <p><strong>Status:</strong>
                   @if ($contract->active)
                        <span class="badge bg-success">Active</span>
                        
                  @endif
                  @if ($contract->pending)
                        <span class="badge bg-warning text-dark">Pending</span>
                  @elseif ($contract->accepted)
                        <span class="badge bg-primary">Accepted</span>
                    @elseif ($contract->completed)
                        <span class="badge bg-primary">Completed</span>
                    @elseif ($contract->cancelled)
                        <span class="badge bg-danger">Cancelled</span>
                    @else
                        <span class="badge bg-secondary">Unknown</span>
                    @endif</p>

                  </div>
                  @if($contract->active && !$contract->cancelled && !$contract->completed && !$contract->accepted)
                  <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#acceptDeclineModal" data-id="{{ $contract->id }}">Accept</button>
                  @else
                  <button class="btn btn-danger btn-sm"
                        data-bs-toggle="modal"
                        data-bs-target="#declineInfoModal"
                        data-id="{{ $contract->id }}"
                        data-title="{{-- $contract->title --}}">
                  Cancelled
                  </button>
                  @endif
              </div>
          </div>
      </div>
  </div>
  
  <hr>
  <div class="modal fade" id="acceptDeclineModal" tabindex="-1" aria-labelledby="acceptDeclineLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
            <form id="contractDecisionForm" method="POST" enctype="multipart/form-data">
                  <div class="modal-header">
                        <h5 class="modal-title" id="acceptDeclineLabel">Respond to Contract</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
            
                  <div class="modal-body">
                        <p><strong>Contract:</strong> <span id="modalContractTitle">Loading...</span></p>
            
                        <div class="mb-3">
                        <label for="signature" class="form-label">Upload Signature</label>
                        <input type="file" class="form-control" id="signature" name="signature">
                        </div>
            
                        <input type="hidden" id="modalContractId" name="contractId" value="{{$contract->id}}">
                  </div>
            
                  <div class="modal-footer">
                        <button type="button" class="btn btn-success" id="acceptBtn">Accept</button>
                       
                        <button type="button" class="btn btn-danger" id="declineBtn">Decline</button>
                  </div>
            </form>
        </div>
      </div>
    </div>

    <div class="modal fade" id="declineInfoModal" tabindex="-1" aria-labelledby="declineInfoLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <form id="declineContractForm" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="modal-header">
              <h5 class="modal-title" id="declineInfoLabel">Decline Contract</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
    
            <div class="modal-body">
              <p><strong>Contract:</strong> <span id="declineModalContractTitle">Loading...</span></p>
    
              <div class="mb-3">
                <label for="reason" class="form-label">Reason for cancellation</label>
                <textarea class="form-control" id="reason" name="reason" rows="4" required></textarea>
              </div>
    
              <input type="hidden" id="declineModalContractId" name="contractId">
            </div>
    
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" id="declineBtn">Decline</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  
  <div class="container">
      <div class="row justify-content-center">
          <div class="col-md-8">
              <h4>Job Description</h4>
              <p>{{ $contract->terms }}</p>
          </div>
  
          <div class="col-md-4">
              <h4>Payment</h4>
              <p><strong>Amount:</strong> ${{ $contract->amount ?? 'N/A' }}</p>
              <p><strong>Method:</strong> {{ $contract->payment_method ?? 'N/A' }}</p>
          </div>
      </div>
  
      <div class="row mt-3">
          <div class="col-md-8">
              <h4>Job Industry</h4>
              <p>{{ $contract->industry ?? 'Not specified' }}</p>
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
      $('#acceptDeclineModal').on('show.bs.modal', function (event) {
            const button = $(event.relatedTarget);  // Button that triggered the modal
            const contractId = button.data('id');   // Get contract ID
            

            // Populate hidden field and title
            $('#modalContractId').val(contractId);           
            // Set form action
            $('#contractDecisionForm').attr('action', `/user/contracts/${contractId}/respond`);
      });
     function submitContractAction(action) {
        const csrfToken = $('meta[name="csrf-token"]').attr('content');
        const contractId = $('#modalContractId').val();
        const signature = $('#signature')[0].files[0];
        const formData = new FormData();

            formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
            formData.append('_method', 'PUT');
            formData.append('action', action);  // ✅ This is the missing field
            formData.append('signature', signature);

        const actionUrl = $(this).attr('action');
        $.ajax({
            url: `/user/contracts/${contractId}/respond`,
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (data) {
                  console.log(data);
                if (data.status === 'success') {
                    Swal.fire({
                        title: 'Success!',
                        text: data.message ?? 'Response submitted.',
                        icon: 'success',
                        timer: 3000,
                        showConfirmButton: false
                    }).then(() => {
                        $('#acceptDeclineModal').modal('hide');
                        location.reload(); // optional
                    });
                } else {
                    Swal.fire({
                        title: 'Error',
                        text: data.message ?? 'Something went wrong.',
                        icon: 'error',
                        timer: 3000,
                        showConfirmButton: false
                    });
                }
            },
            error: function (xhr) {
                const errorMsg = xhr.responseJSON?.message || 'An unexpected error occurred.';
                Swal.fire({
                    title: 'Error',
                    text: errorMsg,
                    icon: 'error',
                    timer: 3000,
                    showConfirmButton: false
                });
            }
        });
    }

    $('#acceptBtn').click(function () {
        submitContractAction('accept');
    });

    $('#declineBtn').click(function () {
        submitContractAction('decline');
    });
</script>
@endpush