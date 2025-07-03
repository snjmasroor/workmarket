@extends('layouts.backend.master') 
@push('styles')
@endpush
@section('page-content')
<div class="row justify-content-center mt-5">
  <div class="col-md-6">
    <div class="card shadow-sm">
      <div class="card-header text-center">
        <h5 class="mb-0">Add Contract</h5>
        <small class="text-muted">Contract Form</small>
      </div>
      <div class="card-body">
            <form id="contractForm" action="{{ route('admin.contracts.store') }}" method="POST">
          @csrf

            <input type="hidden" id="job_application_id" name="job_application_id" value="{{ $application->id }}">
            <input type="hidden" id="user_id" name="user_id" value="{{ $application->user_id }}">
            <input type="hidden" id="job_id" name="job_id" value="{{ $application->job_id }}">

          <div class="mb-3 row">
            <label for="industry-name" class="col-sm-3 col-form-label">Contract Terms</label>
            <div class="col-sm-9">
              <textarea id="terms" id="terms" name="terms" class="form-control" required></textarea>
            </div>
          </div>

          <div class="mb-3 row">
            <label class="col-sm-3 col-form-label">Amount</label>
            <div class="col-sm-9">            
                  <input type="number" id="amount" name="amount" class="form-control" step="0.01" required>
            </div>
          </div>
          
          <div class="mb-3 row">
            <label class="col-sm-3 col-form-label">Start Date</label>
            <div class="col-sm-9">            
                  <input type="date" id="start_date" name="start_date" class="form-control" required>
            </div>
          </div>

          <div class="mb-3 row">
            <label class="col-sm-3 col-form-label">End Date</label>
            <div class="col-sm-9">            
                  <input type="date" id="end_date" name="end_date" class="form-control">
            </div>
          </div>

          <div class="row justify-content-end">
            <div class="col-sm-9 offset-sm-3">
                  <button type="submit" id="finalSubmit" class="btn btn-primary">Create Contract</button>
            </div>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>
@endsection 
@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<script>
$(document).ready(function () {
     
      
$('#finalSubmit').on('click', function () {
      
    $('#contractForm').on('submit', function (e) {
        e.preventDefault(); 
      //   alert('asdads');
        const formData = new FormData(this);
      console.log(formData);

        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (res) {
                if (res.success) {
                    Swal.fire('Success', res.message, 'success');
                    $('#contractForm')[0].reset();
                    termsEditor.setData(''); // clear editor
                } else {
                    Swal.fire('Error', res.message, 'error');
                }
            },
            error: function (xhr) {
                Swal.fire('Error', xhr.responseJSON?.message ?? 'Server error.', 'error');
            }
        });
      });
});
});
</script>
@endpush
