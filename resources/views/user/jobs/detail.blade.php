@extends('layouts.backend.master')

@section('page-content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"></div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('message') }}
                        </div>
                    @endif

                   <h3>Job Title</h3>
                   <h4>{{ $job->title }}</h4> 
                </div>
            </div>
            
        </div>
    </div>
</div>
<hr>
<div class="container">
      <div class="row justify-content-center">
            <div class="col-md-8">
                  <h4> Job Description</h4>
                  {!! html_entity_decode($job->description) !!}
            </div>
            <div class="col-md-4">
                  <div class="card">
                        <div class="card-header"><h4 class="justify-content-center">Apply Here</h4></div>
                  </div>

            </div>
      </div>
      <div class="row">
            <div class="col-md-8">
                  <h4>Job Industry</h4>
                  {{ $job->industry->name}}
            </div>
      </div>
</div>
@endsection