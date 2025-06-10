@extends('layouts.backend.master') 
@push('styles')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/spinkit/spinkit.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/select2/select2.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/tagify/tagify.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/bootstrap-select/bootstrap-select.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/typeahead-js/typeahead.css')}}" />
@endpush @section('page-content') 

               <div class="container py-5">
        <!-- Use d-flex and justify-content-center on the row to center the column -->
        <div class="row justify-content-center">
            <!-- You can adjust the column size (e.g., col-md-6) to control the width of the card -->
            <div class="col-md-6">
                <div class="card card-action mb-6">
                    <div class="card-header">
                        <h5 class="card-action-title mb-0">Edit Industry Skills</h5>
                        <div class="card-action-element">
                            <ul class="list-inline mb-0">
                                <li class="list-inline-item">
                                    <a href="javascript:void(0);" class="card-expand">
                                        <i class="tf-icons ti ti-arrows-maximize ti-sm"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="card-body">
                        <!-- Removed redundant d-flex align-items-center around the form -->
                        <form action="{{route('industry-skill.update', $selectedIndustryId)}}" method="post">
                             @csrf  
                            @method('PUT')
                            <div class="mb-3">
                                <label for="select2Basic" class="form-label">Industry</label>
                                <select id="select2Basic" name="industry_id" class="select2 form-select form-select-lg" disabled data-allow-clear="true">
                                    <option value="">-- Choose Industry --</option>
                                    @foreach ($industries as $industry)
                                        <option value="{{ $industry->id }}" {{ $selectedIndustryId == $industry->id ? 'selected' : '' }}>
                                            {{ $industry->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                 <label for="select2Basic" class="form-label">Skills</label>
                                    <select multiple name="skill_ids[]" id="select2Basic2" class="select2 form-select form-select-lg"   data-allow-clear="true">
                                    @foreach ($allSkills as $skill)
                                        <option value="{{ $skill->id }}" {{ in_array($skill->id, $selectedSkills) ? 'selected' : '' }}>
                                            {{ $skill->name }}
                                        </option>
                                    @endforeach
                                    </select>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Status</label>
                                <div class="col-sm-9 d-flex align-items-center">
                                    <div class="form-check me-3">
                                        <input class="form-check-input" type="radio" name="status" id="active1" value="1" checked>
                                        <label class="form-check-label" for="active1">Active</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status" id="active0" value="0">
                                        <label class="form-check-label" for="active0">Inactive</label>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Create Industry Skills</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
 {{-- <div class="content">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <h4 class="page-title">Add Industry Skills</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <form action="{{route('industry-skill.store')}}" method="post">
                        @csrf    
                        <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
										<label>Industry</label>
										 <select name="industry_id" class="form-control" required>
                                            <option value="">-- Select Industry --</option>
                                            @foreach($industries as $industry)
                                                <option value="{{ $industry->id }}">{{ $industry->name }}</option>
                                            @endforeach
                                        </select>
									</div>
                                </div>
                                <div class="col-md-6">
									<div class="form-group">
										<label>Skills</label>
										<select class="select" multiple name="skill_ids[]">
											<option value="">-- Select Skill --</option>
                                                @foreach($skills as $skill)
                                                    <option value="{{ $skill->id }}">{{ $skill->name }}</option>
                                                @endforeach
										</select>
									</div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="display-block">Schedule Status</label>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="radio" name="status" id="product_active" value=1 checked>
									<label class="form-check-label" for="product_active">
									Active
									</label>
								</div>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="radio" name="status" id="product_inactive" value=0>
									<label class="form-check-label" for="product_inactive">
									Inactive
									</label>
								</div>
                            </div>
                            <div class="m-t-20 text-center">
                                <button class="btn btn-primary submit-btn">Create Industry Skills</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div> --}}

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