 @extends('layouts.backend.master') 
@push('styles')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/select2.min.css')}}"> 
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/bootstrap-datetimepicker.min.css')}}">
@endpush 
@section('page-content') 
 <div class="content">
    <div class="row">
        <div class="col-lg-8 offset-lg-2">
            <h4 class="page-title">Edit Job</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8 offset-lg-2">
            <form action="{{route('jobs.update', $job->id) }}" method="POST">
                @csrf
                 @method('PUT')
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="industry_id">Industry</label>
                            <select name="industry_id" id="industry_id" class="form-control" required>
                                <option value="">Select Industry</option>
                                @foreach($industries as $industry)
                                    <option value="{{ $industry->id }}" {{ $job->industry_id == $industry->id ? 'selected' : '' }}>
                                        {{ $industry->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Skills</label>
                            <select class="select" multiple id="skills" name="skill_ids[]">
                                @foreach($skills as $skill)
                                    <option value="{{ $skill->id }}" {{ in_array($skill->id, $job->skills->pluck('id')->toArray()) ? 'selected' : '' }}>
                                        {{ $skill->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="title">Job Title</label>
                            <input type="text" name="title" class="form-control" value="{{ old('title', $job->title) }}" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Budget</label>
                            <input class="form-control" type="text" name="budget" value="{{ old('budget', $job->budget) }}" placeholder="$">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Deadline</label>
                            <div class="cal-icon">
                                <input class="form-control datetimepicker" type="text" name="deadline" value="{{ old('deadline', $job->deadline ? \Carbon\Carbon::parse($job->deadline)->format('d/m/Y') : '') }}" placeholder="dd/mm/yyyy">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Job Type</label>
                            <select class="select form-control" name="jobType" required>
                                <option value="fixed" {{ $job->fixed == 'fixed' ? 'selected' : '' }}>Fixed</option>
                                <option value="hourly" {{ $job->hourly == 'hourly' ? 'selected' : '' }}>Hourly</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Job Location Type</label>
                            <select class="select form-control" name="jobLocation" required>
                                <option value="remote" {{ $job->remote == 'remote' ? 'selected' : '' }}>Remote</option>
                                <option value="onsite" {{ $job->onsite == 'onsite' ? 'selected' : '' }}>On Site</option>
                            </select>
                        </div>
                    </div>
                    <div id="state" class="col-md-3 onSiteFields">
                        <div class="form-group">
                            <label>State</label>
                            <input class="form-control" type="text" value="{{ old('state', $job->state) }}" name="state" placeholder="Please Enter State">
                        </div>
                    </div>
                    <div id="city" class="col-md-3 onSiteFields">
                        <div class="form-group">
                            <label>City</label>
                            <input class="form-control" type="text"  value="{{ old('city', $job->city) }}" name="city" placeholder="Please Enter City">
                        </div>
                    </div>
                </div>
            <div class="row">
                   <div class="col-md-6">
                    @if(auth()->user() && auth()->user()->type === 'superadmin')
                    <input type="radio" id="open" name="status_admin" value="open" {{ $job->open == 'open' ? 'checked' : '' }}>
                    <label for="open">Open</label><br>

                    <input type="radio" id="in_progress" name="status_admin" value="in_progress" {{ $job->in_progress == 'in_progress' ? 'checked' : '' }}>
                    <label for="in_progress">In Progress</label><br>

                    <input type="radio" id="completed" name="status_admin" value="completed" {{ $job->completed == 'completed' ? 'checked' : '' }}>
                    <label for="completed">Completed</label><br>

                    <input type="radio" id="cancelled" name="status_admin" value="cancelled" {{ $job->cancelled == 'cancelled' ? 'checked' : '' }}>
                    <label for="cancelled">Cancelled</label>
                    @endif
                </div>
                </div>
            </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" class="form-control" rows="5" required>{{ old('description', $job->description) }}</textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label class="display-block">Schedule Status</label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="status" id="product_active" value="1" {{ $job->active == 1 ? 'checked' : '' }}>
                        <label class="form-check-label" for="product_active">Active</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="status" id="product_inactive" value="0" {{ $job->active == 0 ? 'checked' : '' }}>
                        <label class="form-check-label" for="product_inactive">Inactive</label>
                    </div>
                </div>

                <div class="m-t-20 text-center">
                    <button class="btn btn-primary submit-btn">Update Job</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection 
@push('scripts') 
      <script src="{{ asset('assets/js/select2.min.js') }}"></script>
      <script src="{{ asset('assets/js/moment.min.js') }}"></script>
      <script src="{{ asset('assets/js/bootstrap-datetimepicker.min.js') }}"></script>
      <script>
  $(document).ready(function () {
    $('#industry_id').on('change', function () {
      var industryId = $(this).val();

      $('#skills').html('<option value="">Loading...</option>');

      if (industryId) {
        $.ajax({
          url: '{{ route("get.skills.by.industry") }}',
          type: 'GET',
          data: { industry_id: industryId },
          success: function (response) {
            $('#skills').empty();
            if (response.length > 0) {
              $.each(response, function (key, skill) {
                $('#skills').append('<option value="' + skill.id + '">' + skill.name + '</option>');
              });
            } else {
              $('#skills').append('<option value="">No Skills Available</option>');
            }
          }
        });
      } else {
        $('#skills').html('<option value="">-- Select Skill --</option>');
      }
    });
  });
</script>
<script>
        $(document).ready(function() {
            // Function to show/hide and manage required attributes
            function toggleOnSiteFields() {
                
                if ($('#jobLocation').val() === 'onsite') {
                    $('#state').removeClass('onSiteFields');
                    $('#city').removeClass('onSiteFields');
                } else {
                    $('#state').addClass('onSiteFields');
                    $('#city').addClass('onSiteFields'); // Clear and unrequire
                }
            }

            // Call on page load
            toggleOnSiteFields();

            // Call on change
            $('#jobLocation').change(toggleOnSiteFields);
        });
    </script>
@endpush