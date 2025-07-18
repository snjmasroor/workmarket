@extends('layouts.backend.master') 
@push('styles')
@endpush
@section('page-content')
<div class="row justify-content-center mt-5">
      <div class="col-md-8 col-lg-6">
        <div class="card border-0 shadow rounded-3">
          <div class="card-header text-white text-center rounded-top">
            <h4 class="mb-0">Add Certificate</h4>
            <small class="text-light">Fill out the details below</small>
          </div>
          <div class="card-body p-4">
            <form method="POST" action="{{ route('admin.certificates.store') }}">
              @csrf

              <div class="mb-3">
                  <label for="name" class="form-label fw-semibold">Certificate Name <span class="text-danger">*</span></label>
                  <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="Enter the certificate name" required>
                  @error('name')
                      <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
              </div>

              <div class="mb-3">
                  <label for="issuing_organization" class="form-label fw-semibold">Issuing Organization <span class="text-danger">*</span></label>
                  <input type="text" name="issuing_organization" id="issuing_organization" class="form-control @error('issuing_organization') is-invalid @enderror" placeholder="e.g., Microsoft, Cisco" required>
                  @error('issuing_organization')
                      <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
              </div>

              <div class="mb-3">
                  <label for="certification_level" class="form-label fw-semibold">Certification Level</label>
                  <input type="text" name="certification_level" id="certification_level" class="form-control @error('certification_level') is-invalid @enderror" placeholder="Leave blank for unlimited">
                  @error('certification_level')
                      <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
              </div>

              <div class="mb-3">
                  <label for="validity_period" class="form-label fw-semibold">Validity Period</label>
                  <input type="text" name="validity_period" id="validity_period" class="form-control @error('validity_period') is-invalid @enderror" placeholder="e.g., 2 years">
                  @error('validity_period')
                      <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
              </div>

              <div class="mb-3">
                  <label for="expiration_date" class="form-label fw-semibold">Expiration Date</label>
                  <input type="date" name="expiration_date" id="expiration_date" class="form-control @error('expiration_date') is-invalid @enderror">
                  @error('expiration_date')
                      <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
              </div>

              <div class="mb-3">
                  <label for="verification_method" class="form-label fw-semibold">Verification Method</label>
                  <input type="text" name="verification_method" id="verification_method" class="form-control @error('verification_method') is-invalid @enderror" placeholder="e.g., Online verification, ID number">
                  @error('verification_method')
                      <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
              </div>

              <div class="mb-3">
                  <label for="description" class="form-label fw-semibold">Description</label>
                  <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" rows="3" placeholder="Optional description..."></textarea>
                  @error('description')
                      <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
              </div>

              <div class="text-end">
                  <button type="submit" class="btn btn-primary">
                      <i class="ti ti-check"></i> Save Certificate
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
