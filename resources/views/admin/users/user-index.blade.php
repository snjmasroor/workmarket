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
    <h5 class="card-title mb-sm-0 me-2">Users</h5>
    <div class="action-btns">
      <button class="btn btn-label-primary me-4">
        <span class="align-middle"> Back</span>
      </button>
      <a href="" class="btn btn-primary">Add User</a>
    </div>
  </div>
</div>
<div class="card">
  <h5 class="card-header">All User</h5>
  <div class="card-datatable table-responsive">
    <table class="dt-responsive table">
      <thead class="table-dark">
        <tr>
          <th>Id</th>
          <th>Firstname</th>
          <th>Lastname</th>
          <th>Username</th>
          <th>Email</th>
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
    ajax: '{{ route("admin.user.index.data") }}',
    columns: [
        { data: 'id', name: 'id' },
        { data: 'firstname', name: 'firstname' },
        { data: 'lastname', name: 'lastname' },
        { data: 'username', name: 'username' },
        { data: 'email', name: 'email' },
        { data: 'flags', name: 'flags', orderable: false, searchable: false },
        { data: 'action', name: 'action', orderable: false, searchable: false },
   
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