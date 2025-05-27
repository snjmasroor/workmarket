 @extends('layouts.backend.master') 
@push('styles')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/select2.min.css')}}"> 
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/bootstrap-datetimepicker.min.css')}}">
@endpush @section('page-content') 
 <div class="content">
    <div class="row">
        <div class="col-lg-8 offset-lg-2">
            <h4 class="page-title">Add Jobs</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8 offset-lg-2">
            <form action="{{route('job.store')}}" method="post">
                @csrf    
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Industry</label>
                                <select name="industry_id" id="industry_id" class="form-control" required>
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
                            <select class="select" multiple id="skills" name="skill_ids[]">
                                <option value="">-- Select Skill --</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Title</label>
                            <input class="form-control" type="text" name="title">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Budget</label>
                            <input class="form-control" type="text" name="budget" placeholder="$">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Deadline</label>
                            <div class="cal-icon">
                                <input class="form-control datetimepicker" type="text" name="deadline" placeholder="dd/mm/yyyy">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Job Type</label>
                            <select class="select" name ="jobType"class="form-control" required>
                                <option value='fixed'>Fixed</option>
                                <option value="hourly">Hourly</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Job Location Type</label>
                                <select class="select" class="form-control" name="jobLocation" required>
                                <option value='remote'>Remote</option>
                                <option value="on-site">On Site</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" name="description" placeholder="Please write description"></textarea>
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
@endpush