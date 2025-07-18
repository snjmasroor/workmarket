@extends('layouts.backend.master') 
@push('styles')
@endpush
@section('page-content')
<div class="row justify-content-center mt-5">
      <div class="col-md-8 col-lg-6">
        <div class="card border-0 shadow rounded-3">
          <div class="card-header text-white text-center rounded-top">
            <h4 class="mb-0">Add Tools</h4>
            <small class="text-light">Fill out the details below</small>
          </div>
          <div class="card-body p-4">
            <form method="POST" action="{{ route('admin.tools.store') }}">
              @csrf

            <!-- Tool Name -->
            <div class="mb-3">
                  <label for="name" class="form-label">Tool Name <span class="text-danger">*</span></label>
                  <input type="text" name="name" id="name" class="form-control" required>
            </div>

            <!-- Type -->
            <div class="mb-3">
                  <label for="type" class="form-label">Type</label>
                  <input type="text" name="type" id="type" class="form-control">
            </div>

            <!-- Model -->
            <div class="mb-3">
                  <label for="model" class="form-label">Model</label>
                  <input type="text" name="model" id="model" class="form-control">
            </div>

            <!-- Verification Method -->
            <div class="mb-3">
                  <label for="verification_method" class="form-label">Verification Method</label>
                  <input type="text" name="verification_method" id="verification_method" class="form-control">
            </div>

            <!-- Price -->
            <div class="mb-3">
                  <label for="price" class="form-label">Price ($)</label>
                  <input type="number" step="0.01" name="price" id="price" class="form-control">
            </div>

             <!-- Description -->
            <div class="mb-3">
                  <label for="description" class="form-label">Description</label>
                  <textarea name="description" id="description" class="form-control" rows="4"></textarea>
            </div>

            <!-- Submit Button -->
            <div class="mt-4">
                  <button type="submit" class="btn btn-primary">
                        <i class="ti ti-plus"></i> Create Tool
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
