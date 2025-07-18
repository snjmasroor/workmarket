@extends('layouts.backend.master') 
@push('styles')
@endpush
@section('page-content')
<div class="row justify-content-center mt-5">
      <div class="col-md-8 col-lg-6">
        <div class="card border-0 shadow rounded-3">
          <div class="card-header text-white text-center rounded-top">
            <h4 class="mb-0">Update Tools</h4>
            <small class="text-light">Fill out the details below</small>
          </div>
          <div class="card-body p-4">
            <form method="POST" action="{{ route('admin.tools.update', $tool->id) }}">
              @csrf
                  @method('PUT')

                  <div class="mb-3">
                        <label for="name" class="form-label">Tool Name</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $tool->name) }}" required>
                  </div>

                  <div class="mb-3">
                        <label for="type" class="form-label">Type</label>
                        <input type="text" name="type" class="form-control" value="{{ old('type', $tool->type) }}">
                  </div>

                  <div class="mb-3">
                        <label for="model" class="form-label">Model</label>
                        <input type="text" name="model" class="form-control" value="{{ old('model', $tool->model) }}">
                  </div>

                  <div class="mb-3">
                        <label for="verification_method" class="form-label">Verification Method</label>
                        <input type="text" name="verification_method" class="form-control" value="{{ old('verification_method', $tool->verification_method) }}">
                  </div>

                  <div class="mb-3">
                        <label for="price" class="form-label">Price ($)</label>
                        <input type="number" step="0.01" name="price" class="form-control" value="{{ old('price', $tool->price) }}">
                  </div>

                  <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" class="form-control">{{ old('description', $tool->description) }}</textarea>
                  </div>

                  <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select">
                        <option value="1" {{ $tool->active ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ !$tool->active ? 'selected' : '' }}>Inactive</option>
                        </select>
                  </div>

                  <button type="submit" class="btn btn-primary">
                        <i class="ti ti-edit"></i> Update Tool
                  </button>
            </form>
          </div>
        </div>
      </div>
    </div>

@endsection 
@push('scripts')
@endpush
