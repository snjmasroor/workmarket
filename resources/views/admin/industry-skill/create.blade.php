 @extends('layouts.backend.master') 
@push('styles')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/spinkit/spinkit.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/select2/select2.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/tagify/tagify.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/bootstrap-select/bootstrap-select.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/typeahead-js/typeahead.css')}}" />
@endpush @section('page-content') 

<div class="row justify-content-center mt-5">
    <div class="col-md-6">
        <div class="card shadow-lg border-0">
            <div class="card-header text-center bg-warning text-white">
                <h5 class="mb-0">Add Industry Skill</h5>
                <small class="text-light">Associate multiple skills with an industry</small>
            </div>

            <div class="card-body px-4 py-4">
                <form action="{{ route('industry-skill.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label for="industry_id" class="form-label fw-semibold">Select Industry</label>
                        <select id="industry_id" name="industry_id" class="form-select select2" required>
                            <option value="">-- Select Industry --</option>
                            @foreach($industries as $industry)
                                <option value="{{ $industry->id }}">{{ $industry->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="skill_ids" class="form-label fw-semibold">Select Skills</label>
                        <select multiple name="skill_ids[]" id="skill_ids" class="form-select select2" required>
                            @foreach($skills as $skill)
                                <option value="{{ $skill->id }}">{{ $skill->name }}</option>
                            @endforeach
                        </select>
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

                    <div class="text-end">
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-plus-circle me-1"></i> Create Industry Skills
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts') 
<script src="{{asset('assets/js/cards-actions.js')}}"></script>
    <script src="{{asset('assets/vendor/libs/block-ui/block-ui.js')}}"></script>
    <script src="{{asset('assets/vendor/libs/sortablejs/sortable.js')}}"></script>
    <script src="{{asset('assets/vendor/libs/select2/select2.js')}}"></script>
    <script src="{{asset('assets/vendor/libs/tagify/tagify.js')}}"></script>
    <script src="{{asset('assets/vendor/libs/bootstrap-select/bootstrap-select.js')}}"></script>
    <script src="{{asset('assets/vendor/libs/bloodhound/bloodhound.js')}}"></script>
    <script src="{{asset('assets/js/forms-selects.js')}}"></script>
    <script src="{{asset('assets/js/forms-tagify.js')}}"></script>
    <script src="{{asset('assets/js/forms-typeahead.js')}}"></script>
@endpush