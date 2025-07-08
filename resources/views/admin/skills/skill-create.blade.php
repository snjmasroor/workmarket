@extends('layouts.backend.master') 

@section('page-content')
<div class="row justify-content-center mt-5">
  <div class="col-md-6">
    <div class="card shadow-lg border-0">
      <div class="card-header text-center text-white">
        <h5 class="mb-0">Add Skill</h5>
        <small class="text-light">Skill Form</small>
      </div>
      <div class="card-body px-4 py-4">
        <form method="POST" action="{{ route('admin.skill.store') }}">
          @csrf

          <div class="mb-4">
            <label for="skill-name" class="form-label fw-semibold">Skill Name</label>
            <input type="text" name="name" id="skill-name" class="form-control" placeholder="E.g. PHP, HTML5" required>
          </div>

          <div class="mb-4">
            <label class="form-label fw-semibold">Status</label>
            <div class="d-flex gap-4">
              <div class="form-check">
                <input class="form-check-input" type="radio" name="active" id="active1" value="1" checked>
                <label class="form-check-label" for="active1">Active</label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="active" id="active0" value="0">
                <label class="form-check-label" for="active0">Inactive</label>
              </div>
            </div>
          </div>

          <div class="text-end">
            <button type="submit" class="btn btn-success">
              <i class="bi bi-plus-circle me-1"></i> Add Skill
            </button>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>
@endsection 

