@extends('layouts.backend.master') 

@push('styles')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/select2/select2.css')}}" />
 
<link rel="stylesheet" href="{{asset('assets/vendor/libs/bootstrap-select/bootstrap-select.css')}}" />  
<link rel="stylesheet" href="{{asset('assets/vendor/libs/animate-css/animate.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/sweetalert2/sweetalert2.css')}}" />
@endpush


@section('page-content')

<div class="card">
  <div class="card-header sticky-element bg-label-secondary d-flex justify-content-sm-between align-items-sm-center flex-column flex-sm-row">
    <h5 class="card-title mb-sm-0 me-2">Jobs</h5>
    <div class="action-btns">
      <button class="btn btn-label-primary me-4">
        <span class="align-middle"> Back</span>
      </button>
      <a href="{{route('admin.jobs.create')}}" class="btn btn-primary">Add Jobs</a>
    </div>
  </div>
</div>
<div class="card">
  <h5 class="card-header">All Jobs</h5>
  <div class="card-datatable table-responsive">
    <table class="dt-responsive table">
      <thead class="table-dark">
        <tr>
          <th>Id</th>
          <th>Title</th>
            <th>Description</th>
            <th>Industry</th>
            <th>Budget</th>
            <th>Deadline</th>
          <th>Status</th>
          <th>Active</th>
        </tr>
      </thead>
    </table>
  </div>
</div>
<div class="bounce-in-animation">

</div>
@endsection 
      
@push('scripts')
      <!-- DataTables -->
<script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>

<!-- Flat Picker -->
<script src="{{ asset('assets/vendor/libs/moment/moment.js') }}"></script>

<!-- Main JS -->
<script src="{{ asset('assets/js/forms-selects.js') }}"></script>
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
    ajax: '{{ route("admin.jobs.data") }}',
    columns: [
    { data: 'id', name: 'id' },
    { data: 'title', name: 'title' },
    { data: 'description', name: 'description' },
    { data: 'industry_name', name: 'industry_name' },
    { data: 'budget', name: 'budget' },
    { data: 'deadline', name: 'deadline' },
    { data: 'flags', name: 'flags' },
    { data: 'action', name: 'action', orderable: false, searchable: false }
   
  ], 
    dom: 'Bfrtip',
    buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
    responsive: true
  });
  
});

</script> 


@endpush