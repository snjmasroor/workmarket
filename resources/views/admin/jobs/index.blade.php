@extends('layouts.backend.master') 
@push('styles')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/dataTables.bootstrap4.min.css')}}"> 
<style>
    div.dataTables_wrapper div.dataTables_length select {
        width:100% !important
    }
</style>
@endpush @section('page-content') 
<div class="content">  
<div class="row">
    <div class="col-sm-5 col-5">
      <h4 class="page-title">Jobs </h4>
    </div>
    <div class="col-sm-7 col-7 text-right m-b-30">
      <a href="{{route('jobs.create')}}" class="btn btn-primary btn-rounded">
        <i class="fa fa-plus"></i> Add Jobs  </a>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12">
      <div class="card-box">
        <div class="card-block">
          <h6 class="card-title text-bold">Jobs </h6>
          <p class="content-group"> This page displays a comprehensive list of Jobs  maintained in the system. Each skill entry includes its name, status, and available actions (edit or delete). The table is interactive, with features such as sorting, pagination, and the ability to select how many entries to display. This allows administrators to efficiently manage skill data with minimal effort. </p>
          <div class="table-responsive">
            <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
              <div class="row">
                <div class="col-sm-12 col-md-6">
                  
                </div>
                <div class="col-sm-12 col-md-6"></div>
              </div>
              <div class="row">
                <div class="col-sm-12">
                  <table class="datatable table table-striped dataTable no-footer" id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info">
                    <thead>
    <tr role="row">
        <th>#</th>
        <th>Title</th>
        <th>Description</th>
        <th>Industry</th>
        <th>Budget</th>
        <th>Deadline</th>
        <th>Status</th>
        <th class="text-right">Action</th>
    </tr>
</thead>
<tbody>
    @forelse ($jobs as $index => $job)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $job->title }}</td>
            <td>{{ Str::limit(strip_tags(htmlspecialchars_decode($job->description)), 50) }}</td>
            <td>{{ $job->industry->name ?? 'N/A' }}</td>
            <td>${{ number_format($job->budget, 2) }}</td>
            <td>{{ \Carbon\Carbon::parse($job->deadline)->format('d M, Y') }}</td>
            <td>
             @php
                $statuses = [
                    'active' => 'success',
                    'fixed' => 'primary',
                    'hourly' => 'info',
                    'remote' => 'secondary',
                    'onsite' => 'dark',
                    'open' => 'outline-success',
                    'in_progress' => 'warning text-white',
                    'completed' => 'success',
                    'cancelled' => 'danger',
                ];
            @endphp

            @foreach ($statuses as $key => $color)
                @if ($job->$key)
                    <span class="btn btn-{{ $color }}">{{ ucwords(str_replace('_', ' ', $key)) }}</span>
                @endif
            @endforeach
            </td>
            <td class="text-right">
                <div class="dropdown dropdown-action">
                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-ellipsis-v"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="{{ route('jobs.edit', $job->id) }}">
                            <i class="fa fa-pencil m-r-5"></i> Edit
                        </a>
                        {{-- <form action="{{ route('jobs.destroy', $job->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="dropdown-item">
                                <i class="fa fa-trash-o m-r-5"></i> Delete
                            </button>
                        </form> --}}
                    </div>
                </div>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="8">No jobs found.</td>
        </tr>
    @endforelse
</tbody>
</table>
                </div>
              </div>
            </div>
          </div>
        </div>
          @if (session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Success',
        text: '{{ session('success') }}',
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'OK'
    });
</script>
@endif
      </div> @endsection @push('scripts') <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
      <script src="{{ asset('assets/js/dataTables.bootstrap4.min.js') }}"></script>
    
       @endpush