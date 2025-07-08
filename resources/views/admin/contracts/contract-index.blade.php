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
    <h5 class="card-title mb-sm-0 me-2">Contracts</h5>
    <div class="action-btns">
      <button class="btn btn-label-primary me-4">
        <span class="align-middle"> Back</span>
      </button>
      <a href="{{route('admin.jobs.create')}}" class="btn btn-primary">Add Contract</a>
    </div>
  </div>
</div>
<div class="card">
  <h5 class="card-header">All Contract</h5>
  <div class="card-datatable table-responsive">
    <table class="dt-responsive table">
      <thead class="table-dark">
        <tr>
          <th>Id</th>
          <th>User</th>
          <th>Job</th>
          <th>Amount</th>
          <th>Start Date</th>
          <th>End Date</th>
          <th>Status</th>
         
          <th>Action</th>
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
    ajax: '{{ route("admin.jobs.contract.data") }}',
    columns: [
      { data: 'id', name: 'id' },
      { data: 'user_name', name: 'user_name' },
      { data: 'job_title', name: 'job_title' },
      { data: 'amount', name: 'amount' },
      { data: 'start_date', name: 'start_date' },
      { data: 'end_date', name: 'end_date' },
      { data: 'status', name: 'status' },
      //{ data: 'accepted_at', name: 'accepted_at' },
      { data: 'action', name: 'action', orderable: false, searchable: false }
    ], 
    dom: 'Bfrtip',
    buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
    responsive: true
  });
  
});

</script> 


@endpush