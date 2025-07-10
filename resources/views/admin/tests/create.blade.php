@extends('layouts.backend.master') 
@push('styles')
@endpush
@section('page-content')
<div class="row justify-content-center mt-5">
      <div class="col-md-8 col-lg-6">
        <div class="card border-0 shadow rounded-3">
          <div class="card-header text-white text-center rounded-top">
            <h4 class="mb-0">Add Test</h4>
            <small class="text-light">Fill out the details below</small>
          </div>
          <div class="card-body p-4">
            <form method="POST" action="{{ route('admin.tests.store') }}">
              @csrf
    
              <div class="mb-3">
                <label class="form-label fw-semibold">Test Title <span class="text-danger">*</span></label>
                <input type="text" name="title" class="form-control" placeholder="Enter test title" required>
              </div>
    
              <div class="mb-3">
                <label class="form-label fw-semibold">Description</label>
                <textarea name="description" class="form-control" rows="3" placeholder="Optional description..."></textarea>
              </div>
    
              <div class="mb-3">
                <label class="form-label fw-semibold">Passing Score (%) <span class="text-danger">*</span></label>
                <input type="number" name="passing_score" class="form-control" min="0" max="100" placeholder="e.g. 70" required>
              </div>
    
              <div class="mb-3">
                <label class="form-label fw-semibold">Max Attempts</label>
                <input type="number" name="max_attempts" class="form-control" min="1" placeholder="Leave blank for unlimited">
              </div>
    
              <div class="mb-3">
                <label class="form-label fw-semibold">Duration (minutes) <span class="text-danger">*</span></label>
                <input type="number" name="duration_minutes" class="form-control" min="1" placeholder="e.g. 30" required>
              </div>

              <div class="mb-3">
                  <label class="form-label fw-semibold">Test Type <span class="text-danger">*</span></label>
                  <select name="test_type" class="form-select" required>
                        <option value="" disabled selected>Select Test Type</option>
                        <option value="Multiple Choice">Multiple Choice</option>
                        <option value="Timed Assessment">Timed Assessment</option>
                        <option value="Quiz">Quiz</option>
                        <option value="Case Study">Case Study</option>
                        <option value="Practical Test">Practical Test</option>
                  </select>
            </div>
    
              <div class="mb-3">
                <label class="form-label fw-semibold">Status <span class="text-danger">*</span></label>
                <select name="status" class="form-select" required>
                  <option value="" disabled selected>Select status</option>
                  <option value="1">Active</option>
                  <option value="0">Inactive</option>
                </select>
              </div>
    
              <div class="d-grid">
                <button type="submit" class="btn btn-primary btn-lg">
                  <i class="bi bi-plus-circle me-1"></i> Create Test
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
