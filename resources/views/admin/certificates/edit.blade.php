@extends('layouts.backend.master') 
@push('styles')
@endpush
@section('page-content')
<div class="row justify-content-center mt-5">
      <div class="col-md-8 col-lg-6">
        <div class="card border-0 shadow rounded-3">
          <div class="card-header text-white text-center rounded-top">
            <h4 class="mb-0">Update Certificate</h4>
            <small class="text-light">Fill out the details below</small>
          </div>
          <div class="card-body p-4">
            <form method="POST" action="{{route('admin.certificates.update', $certificate->id) }}">
                  @csrf
                  @method('PUT')

                  <div class="mb-3">
                        <label class="form-label fw-semibold">Certificate Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $certificate->name) }}" required>
                  </div>

                  <div class="mb-3">
                        <label class="form-label fw-semibold">Issuing Organization <span class="text-danger">*</span></label>
                        <input type="text" name="issuing_organization" class="form-control" value="{{ old('issuing_organization', $certificate->issuing_organization) }}" required>
                  </div>

                  <div class="mb-3">
                        <label class="form-label fw-semibold">Certification Level</label>
                        <input type="text" name="certification_level" class="form-control" value="{{ old('certification_level', $certificate->certification_level) }}">
                  </div>

                  <div class="mb-3">
                        <label class="form-label fw-semibold">Validity Period</label>
                        <input type="text" name="validity_period" class="form-control" value="{{ old('validity_period', $certificate->validity_period) }}">
                  </div>

                  <div class="mb-3">
                        <label class="form-label fw-semibold">Expiration Date</label>
                        <input type="date" name="expiration_date" class="form-control" value="{{ old('expiration_date', $certificate->expiration_date) }}">
                  </div>

                  <div class="mb-3">
                        <label class="form-label fw-semibold">Verification Method</label>
                        <input type="text" name="verification_method" class="form-control" value="{{ old('verification_method', $certificate->verification_method) }}">
                  </div>

                  <div class="mb-3">
                        <label class="form-label fw-semibold">Description</label>
                        <textarea name="description" class="form-control" rows="3">{{ old('description', $certificate->description) }}</textarea>
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select">
                      <option value="1" {{ $certificate->active ? 'selected' : '' }}>Active</option>
                      <option value="0" {{ !$certificate->active ? 'selected' : '' }}>Inactive</option>
                    </select>
                  </div>

                  <div class="text-end">
                        <button type="submit" class="btn btn-primary">
                              <i class="ti ti-check"></i> Update Certificate
                        </button>
                  </div>
            </form>
          </div>
        </div>
      </div>
    </div>

@endsection 
@push('scripts')
@endpush
