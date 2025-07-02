@extends('layouts.backend.master') 

@push('styles')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/select2/select2.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/bootstrap-select/bootstrap-select.css')}}" />  
@endpush


@section('page-content')
<div class="card">
      <h5 class="card-header">All Applications</h5>
      <div class="card-datatable table-responsive">
        <table id="jobApplicationsTable" class="table table-bordered dt-responsive nowrap w-100">
          <thead class="table-dark">
            <tr>
              <th>ID</th>
              <th>Job Title</th>
              <th>Applicant Name</th>
              <th>Email</th>
              <th>Status</th>
              <th>Actions</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
<div class="bounce-in-animation">

</div>
@endsection 
      
@push('scripts')
<script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>

<!-- Flat Picker -->
<script src="{{ asset('assets/vendor/libs/moment/moment.js') }}"></script>

<!-- Main JS -->
<script src="{{ asset('assets/js/forms-selects.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/bootstrap-select/bootstrap-select.js') }}"></script>



<script>
$(document).ready(function () {
      if ($.fn.DataTable.isDataTable('#jobApplicationsTable')) {
      $('#jobApplicationsTable').DataTable().clear().destroy();
      }
      $('#jobApplicationsTable').DataTable({
      processing: true,
      serverSide: true,
      ajax: "{{ route('admin.jobs.application.process.data', ['flag' => 'accepted']) }}",
      columns: [
            { data: 'id', name: 'id' },
            { data: 'job_title', name: 'job_title' },
            { data: 'applicant_name', name: 'applicant_name' },
            { data: 'email', name: 'email' },
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