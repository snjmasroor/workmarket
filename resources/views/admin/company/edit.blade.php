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
              <h5 class="mb-0">Create Company</h5>
              <small class="text-light">Fill the details below</small>
          </div>
          <div class="card-body px-4">
              <form action="{{ route('admin.company.update', $company->id) }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label">Company Name</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $company->name) }}" required>
                </div>

                <div class="mb-3">
                    <label for="industry_id" class="form-label">Industry</label>
                    <select name="industry_id" class="form-select" required>
                        @foreach($industries as $industry)
                            <option value="{{ $industry->id }}" {{ $company->industry_id == $industry->id ? 'selected' : '' }}>
                                {{ $industry->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="logo" class="form-label">Company Logo</label>
                    @if($company->logo)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $company->logo) }}" alt="Logo" height="60">
                        </div>
                    @endif
                    <input type="file" name="logo" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Company Description</label>
                    <textarea name="description" class="form-control" rows="4">{{ old('description', $company->description) }}</textarea>
                </div>

                <div class="mb-4">
                      <label class="form-label fw-semibold">Status</label>
                      <div class="d-flex gap-4">
                          <div class="form-check">
                              <input class="form-check-input" type="radio" name="status" id="active1" value="1" checked>
                              <label class="form-check-label" for="active1">Active</label>
                          </div>
                          <div class="form-check">
                              <input class="form-check-input" type="radio" name="status" id="active0" value="0">
                              <label class="form-check-label" for="active0">Inactive</label>
                          </div>
                      </div>
                  </div>

                <button type="submit" class="btn btn-primary">Update Company</button>
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
