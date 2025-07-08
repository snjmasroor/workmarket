@extends('layouts.backend.master') 
@push('styles')
<style>
    .form-label {
        font-weight: 500;
    }
    .form-control, textarea {
        border-radius: 0.375rem;
    }
</style>
@endpush
@section('page-content')
<div class="row justify-content-center mt-5">
  <div class="col-md-8">
      <div class="card shadow-lg border-0">
          <div class="card-header text-center  text-white">
              <h5 class="mb-0">Edit Contract</h5>
              <small class="text-light">Edit the filled the details below</small>
          </div>
          <div class="card-body px-4">
              <form id="contractForm" action="{{ route('admin.jobs.contract.update', $contract->id) }}" method="POST">
                  @csrf
                  @method('PUT')
                  
                  <div class="mb-4">
                      <label for="terms" class="form-label">Contract Terms</label>
                      <textarea id="terms" name="terms" class="form-control" rows="5" >{{ htmlspecialchars($contract->terms) }}</textarea>
                  </div>

                  <div class="mb-4">
                      <label for="amount" class="form-label">Amount (USD)</label>
                      <input type="number" id="amount" name="amount" class="form-control" value="{{ $contract->amount }}" step="0.01">
                  </div>

                  <div class="mb-4">
                      <label for="start_date" class="form-label">Start Date</label>
                      <input type="date" id="start_date" name="start_date" value="{{ $contract->start_date }}" class="form-control">
                  </div>

                  <div class="mb-4">
                      <label for="end_date" class="form-label">End Date</label>
                      <input type="date" id="end_date" name="end_date" value="{{ $contract->end_date }}" class="form-control">
                  </div>

                  <div class="text-end">
                      <button type="submit" id="finalSubmit" class="btn btn-success">
                          <i class="bi bi-file-earmark-plus"></i> Update Contract
                      </button>
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
                  type: 'PUT',
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
