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
                            <th>title</th>
                            <th>description</th>
                            <th>industry</th>
                            <th>budget</th>
                            <th>deadline</th>
                            <th>Status</th>
                            <th class="text-right">Action</th>
                        </tr>
                    </thead>
                <tbody>
                    @php $counter = 1; @endphp
                        <tr role="row">
                            <td>{{ $counter++ }}</td>
                            <td></td>
                            <td></td>
                            <td>
                                <span class="custom-badge {{-- $industry->active ? 'status-green' : 'status-red' --}}">
                                    {{-- $industry->active ? 'Active' : 'Deactive' --}}
                                </span>
                            </td>
                            <td class="text-right">
                                <div class="dropdown dropdown-action">
                                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                        <i class="fa fa-ellipsis-v"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="#">
                                            <i class="fa fa-pencil m-r-5"></i> Edit
                                        </a>
                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_department">
                                            <i class="fa fa-trash-o m-r-5"></i> Delete
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    
                        <tr>
                            <td colspan="5" class="text-center">No Data in Database</td>
                        </tr>
                </tbody>
</table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div> @endsection @push('scripts') <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
      <script src="{{ asset('assets/js/dataTables.bootstrap4.min.js') }}"></script>
       @endpush