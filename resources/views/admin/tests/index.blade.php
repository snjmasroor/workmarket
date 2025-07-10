@extends('layouts.backend.master') 

@push('styles')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/select2/select2.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/tagify/tagify.css')}}" />  
<link rel="stylesheet" href="{{asset('assets/vendor/libs/bootstrap-select/bootstrap-select.css')}}" />  
<link rel="stylesheet" href="{{asset('assets/vendor/libs/animate-css/animate.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/sweetalert2/sweetalert2.css')}}" />
@endpush


@section('page-content')

<div class="card">
  <div class="card-header sticky-element bg-label-secondary d-flex justify-content-sm-between align-items-sm-center flex-column flex-sm-row">
    <h5 class="card-title mb-sm-0 me-2">Tests</h5>
    <div class="action-btns">
      <a href="{{ route('admin.dashboard') }}" class="btn btn-label-primary me-4">
        <span class="align-middle"> Back</span>
      </a>
      <a href="{{ route('admin.tests.create') }}" class="btn btn-primary">Add Test</a>
    </div>
  </div>
</div>

<div class="card">
  <h5 class="card-header">All Tests</h5>
  <div class="card-datatable table-responsive">
    <table class="dt-responsive table" id="tests-table">
      <thead class="table-dark">
        <tr>
          <th>ID</th>
          <th>Title</th>
          <th>Passing Score</th>
          <th>Max Attempts</th>
          <th>Duration Minutes</th>
          <th>Test Type</th>
          <th>Description</th>
          <th>Status</th>
          <th>Action</th>
        </tr>
      </thead>
    </table>
  </div>
</div>

@endsection
 
      
@push('scripts')
      <!-- DataTables -->
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
    ajax: '{{ route("admin.tests.data") }}',
      columns: [
        { data: 'id', name: 'id' },
        { data: 'title', name: 'title' },
        { data: 'passing_score', name: 'passing_score' },
        { data: 'max_attempts', name: 'max_attempts' },
        { data: 'duration_minutes', name: 'duration_minutes' },
        { data: 'test_type', name: 'test_type' },
        { data: 'description', name: 'description' },
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