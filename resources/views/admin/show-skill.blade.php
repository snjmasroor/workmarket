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
      <h4 class="page-title">Skills</h4>
    </div>
    <div class="col-sm-7 col-7 text-right m-b-30">
      <a href="add-department.html" class="btn btn-primary btn-rounded">
        <i class="fa fa-plus"></i> Add Skills </a>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12">
      <div class="card-box">
        <div class="card-block">
          <h6 class="card-title text-bold">Skills</h6>
          <p class="content-group"> This page displays a comprehensive list of Skills maintained in the system. Each skill entry includes its name, status, and available actions (edit or delete). The table is interactive, with features such as sorting, pagination, and the ability to select how many entries to display. This allows administrators to efficiently manage skill data with minimal effort. </p>
          <div class="table-responsive">
            <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
              <div class="row">
                <div class="col-sm-12 col-md-6">
                  
                </div>
                <div class="col-sm-12 col-md-6"></div>
              </div>
              <div class="row">
                <div class="col-sm-12">
                  <table class="datatable table table-stripped dataTable no-footer" id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info">
                    <thead>
                      <tr role="row">
                        <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-sort="ascending" aria-label="#: activate to sort column descending" style="width: 95.6406px;">#</th>
                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Department Name: activate to sort column ascending" style="width: 423.031px;">skill Name</th>
                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Status: activate to sort column ascending" style="width: 271.5px;">Status</th>
                        <th class="text-right sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Action: activate to sort column ascending" style="width: 197.828px;">Action</th>
                      </tr>
                    </thead>
                    <tbody> <?php $counter = 1;?> @forelse ($skills as $skill) <tr role="row" class="odd">
                        <td class="sorting_1">{{ $counter }}</td>
                        <td>{{ $skill->name }}</td>
                        <td>
                          <span class="custom-badge {{ $skill->active ? 'status-green' : 'status-red' }}">
                                {{ $skill->active ? 'Active' : 'Deactive' }}
                            </span>
                        </td>
                        <td class="text-right">
                          <div class="dropdown dropdown-action">
                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                              <i class="fa fa-ellipsis-v"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                              <a class="dropdown-item" href="edit-department.html">
                                <i class="fa fa-pencil m-r-5"></i> Edit </a>
                              <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_department">
                                <i class="fa fa-trash-o m-r-5"></i> Delete </a>
                            </div>
                          </div>
                        </td> <?php $counter++;?>
                      </tr> @empty @endforelse </tbody>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div> @endsection @push('scripts') <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
      <script src="{{ asset('assets/js/dataTables.bootstrap4.min.js') }}"></script>
       @endpush