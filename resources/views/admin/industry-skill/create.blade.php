 @extends('layouts.backend.master') 
@push('styles')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/select2.min.css')}}"> 

@endpush @section('page-content') 
 <div class="content">
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
            </div>
            @endsection @push('scripts') <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
      <script src="{{ asset('assets/js/select2.min.js') }}"></script>
       @endpush