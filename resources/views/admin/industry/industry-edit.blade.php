@extends('layouts.backend.master') 
@push('styles')
@endpush
@section('page-content')
<div class="row justify-content-center mt-5">
  <div class="col-md-6">
    <div class="card shadow-sm">
      <div class="card-header text-center">
        <h5 class="mb-0">Edit Industry</h5>
        <small class="text-muted">Edit Industry Form</small>
      </div>
      <div class="card-body">
        <form method="POST" action="{{ route('admin.industry.update', $industry->id) }}">
          @csrf
            @method('PUT')
          <div class="mb-3 row">
            <label for="industry-name" class="col-sm-3 col-form-label">Industry Name</label>
            <div class="col-sm-9">
              <input type="text" name="name" value="{{ $industry->name ?? '' }}" id="industry-name" class="form-control" placeholder="E.g. Technology" required>
            </div>
          </div>
          <input type="hidden" name="id" value ="{{$industry->id}}">

          <div class="mb-3 row">
            <label class="col-sm-3 col-form-label">Status</label>
            <div class="col-sm-9 d-flex align-items-center">
              <div class="form-check me-3">
                <input class="form-check-input" type="radio" name="active"  id="active1" value="1" {{ isset($industry) && $industry->active == 1 ? 'checked' : '' }}>
                <label class="form-check-label" for="active1">Active</label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="active" id="active0" value="0" {{ isset($industry) && $industry->active == 0 ? 'checked' : '' }}>
                <label class="form-check-label" for="active0">Inactive</label>
              </div>
            </div>
          </div>

          <div class="row justify-content-end">
            <div class="col-sm-9 offset-sm-3">
              <button type="submit" class="btn btn-primary">Update Industry</button>
            </div>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>
@endsection 
@push('scripts')
@endpush
