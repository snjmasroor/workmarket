@extends('layouts.backend.master') 
@push('styles')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/select2/select2.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/tagify/tagify.css')}}" />  
<link rel="stylesheet" href="{{asset('assets/vendor/libs/bootstrap-select/bootstrap-select.css')}}" />  
<link rel="stylesheet" href="{{asset('assets/vendor/libs/animate-css/animate.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/sweetalert2/sweetalert2.css')}}" />
@endpush
@section('page-content')
<div class="row justify-content-center mt-5">
      <div class="col-md-8 col-lg-6">
        <div class="card border-0 shadow rounded-3">
          <div class="card-header text-white text-center rounded-top">
            <h5>Add Question to: {{ $test->title }}</h5>
            <small class="text-light">Fill out the details below</small>
          </div>
          <div class="card-body p-4">
            <form method="POST" action="{{ route('admin.tests.store_question', $test->id) }}">
                  @csrf
            
                  <div class="mb-3">
                    <label class="form-label">Question Text</label>
                    <textarea name="question_text" class="form-control" required></textarea>
                  </div>
            
                  <div class="mb-3">
                    <label class="form-label">Options (mark the correct one)</label>
                    @for ($i = 0; $i < 4; $i++)
                      <div class="input-group mb-2">
                        <span class="input-group-text">
                          <input type="radio" name="correct_option" value="{{ $i }}" {{ $i == 0 ? 'checked' : '' }}>
                        </span>
                        <input type="text" name="options[]" class="form-control" placeholder="Option {{ $i + 1 }}" required>
                      </div>
                    @endfor
                  </div>
            
                  <button type="submit" class="btn btn-primary">Add Question</button>
                </form>
          </div>
        </div>
      </div>
    </div>

    <div class="card">
      <h5 class="card-header">All question of this test</h5>
      <div class="card-datatable table-responsive">
        <table class="dt-responsive table" id="tests-table">
          <thead class="table-dark">
            <tr>
              <th>ID</th>
              <th>Question</th>
              <th>Test Type</th>
              <th>Marks</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>

@endsection 
@push('scripts')
<script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>

<!-- Flat Picker -->
<script src="{{ asset('assets/vendor/libs/moment/moment.js') }}"></script>

<!-- Main JS -->
<script src="{{ asset('assets/js/forms-selects.js') }}"></script>
<script src="{{ asset('assets/js/forms-tagify.js') }}"></script>
<script src="{{ asset('assets/js/forms-typeahead.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/tagify/tagify.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/bootstrap-select/bootstrap-select.js') }}"></script>
<script src="{{ asset('assets/js/extended-ui-sweetalert2.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>

<script>
$(document).ready(function () {
      $('.dt-responsive').DataTable().clear().destroy();
      
      $('.dt-responsive').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                  url: '{{ route("admin.question.data") }}',
                  data: function (d) {
                        d.test_id = '{{ $test->id }}'; // pass test ID
                  }
            },
            columns: [
                  { data: 'id', name: 'id' },
                  { data: 'question', name: 'question' },
                  { data: 'type', name: 'type' },
                  { data: 'marks', name: 'marks' },
                  { data: 'flags', name: 'flags' },
                  { data: 'action', name: 'action', orderable: false, searchable: false }
            ]
      });
});
      
      
      $('.dt-responsive').DataTable({
        dom: 'Bfrtip',
        buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
        // other config
      });
      </script>
@endpush
