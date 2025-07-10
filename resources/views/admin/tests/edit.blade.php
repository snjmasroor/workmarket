@extends('layouts.backend.master') 
@push('styles')
@endpush
@section('page-content')
<div class="row justify-content-center mt-5">
      <div class="col-md-8 col-lg-6">
        <div class="card border-0 shadow rounded-3">
          <div class="card-header text-white text-center rounded-top">
            <h4 class="mb-0">Update Test</h4>
            <small class="text-light">Fill out the details below</small>
          </div>
          <div class="card-body p-4">
            <form method="POST" action="{{ route('admin.tests.update', $test->id) }}">
                  @csrf
                  @method('PUT')
            
                  <div class="mb-3">
                    <label class="form-label">Test Title</label>
                    <input type="text" name="title" value="{{ old('title', $test->title) }}" class="form-control" required>
                  </div>
            
                  <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control">{{ old('description', $test->description) }}</textarea>
                  </div>
            
                  <div class="mb-3">
                    <label class="form-label">Passing Score (%)</label>
                    <input type="number" name="passing_score" value="{{ old('passing_score', $test->passing_score) }}" class="form-control" min="0" max="100" required>
                  </div>
            
                  <div class="mb-3">
                    <label class="form-label">Max Attempts</label>
                    <input type="number" name="max_attempts" value="{{ old('max_attempts', $test->max_attempts) }}" class="form-control" min="1">
                  </div>
            
                  <div class="mb-3">
                    <label class="form-label">Duration (minutes)</label>
                    <input type="number" name="duration_minutes" value="{{ old('duration_minutes', $test->duration_minutes) }}" class="form-control" min="1" required>
                  </div>
                  <div class="mb-3">
                        <label class="form-label fw-semibold">Test Type <span class="text-danger">*</span></label>
                        <select name="test_type" class="form-select" required>
                          <option value="" disabled {{ !$test->test_type ? 'selected' : '' }}>Select Test Type</option>
                          <option value="Multiple Choice" {{ $test->test_type == 'Multiple Choice' ? 'selected' : '' }}>Multiple Choice</option>
                          <option value="Timed Assessment" {{ $test->test_type == 'Timed Assessment' ? 'selected' : '' }}>Timed Assessment</option>
                          <option value="Quiz" {{ $test->test_type == 'Quiz' ? 'selected' : '' }}>Quiz</option>
                          <option value="Case Study" {{ $test->test_type == 'Case Study' ? 'selected' : '' }}>Case Study</option>
                          <option value="Practical Test" {{ $test->test_type == 'Practical Test' ? 'selected' : '' }}>Practical Test</option>
                        </select>
                      </div>
                  <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select">
                      <option value="1" {{ $test->active ? 'selected' : '' }}>Active</option>
                      <option value="0" {{ !$test->active ? 'selected' : '' }}>Inactive</option>
                    </select>
                  </div>
            
                  <button type="submit" class="btn btn-success">Update Test</button>
                </form>
          </div>
        </div>
      </div>
    </div>

@endsection 
@push('scripts')
@endpush
