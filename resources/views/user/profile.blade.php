@extends('layouts.backend.master')
@section('page-content')


  <style>
    body {
      background-color: #f1f1f1;
    }

    .profile-header {
      background: linear-gradient(to right, #005792, #0078AA);
      color: white;
      padding: 20px;
      position: relative;
    }

    .profile-header img {
      width: 80px;
      height: 80px;
      border-radius: 5px;
      background: #fff;
      position: absolute;
      top: 10px;
      left: 5px;
    }

    .tabs-section {
      background-color: white;
      padding: 20px;
    }

    .nav-tabs .nav-link.active {
      background-color: #f5a623 !important;
      color: white !important;
      border-color: #f5a623;
    }

    .rating-box {
      background: white;
      padding: 20px;
      margin-top: 20px;
    }

    .btn-upload {
      background-color: #007bff;
      color: white;
    }

    .rating-bar {
      background-color: #ddd;
      height: 12px;
      margin: 3px 0;
    }

    .rating-bar-fill {
      height: 100%;
      background-color: #007bff;
    }
    .nav-tabs {
      padding:2px;
    }
   .username {
    padding: 10px;
    margin-left: 18px;
    }
  </style>

<div class="container">
    
  <div class="profile-header d-flex justify-content-between align-items-center">
    <div>
      <img src="https://via.placeholder.com/80" alt="User Image">
      <div class="username">
      <h4 class="ml-5">{{ auth()->user()->name }}</h4>
      <p class="ml-5 mb-0"> {{ $user->industry->name }} | {{ $user->firstname }}  {{ $user->lastname }}</p>
      <small class="ml-5">DeSoto, TX 75115</small>
    </div>
    </div>
    <div class="text-right">
      <button class="btn btn-primary">PROFILE SETTINGS</button>
      <p class="mb-0">
        huzaifa.snigs@gmail.com<br>
         W: (940) 531-9944
      </p>
    </div>
  </div>
  <div class="row">  
  <div class="col-md-8">
      <ul class="nav nav-tabs nav-tabs-solid nav-tabs-rounded nav-justified mb-3">
        <li class="nav-item">
          <a class="nav-link active" href="#solid-rounded-justified-tab1" data-toggle="tab">Overview</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#solid-rounded-justified-tab2" data-toggle="tab">Qualifications</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#solid-rounded-justified-tab3" data-toggle="tab">Rating</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#solid-rounded-justified-tab4" data-toggle="tab">Media</a>
        </li>
      </ul>

      <div class="tab-content">
        <div class="tab-pane show active" id="solid-rounded-justified-tab1">
          <div class="userid">
            User ID: 98882311
          </div>
          <div class="profile-url">
            URL : https://www.workmarket.com/profile/98882311
          </div>
          <div class="labor">
            <h3 class="labor-header">Labor Clouds</h3>
            <p class="para">You are not a member of any Labor Clouds. Join Labor Clouds to be eligible for more assignments.</p>
          </div>
          <div class="labor-cloud">
            <a href="" class="btn btn-success">JOIN LABOR CLOUDS </a>
          </div>
          <br>
          <div class="test">
            <h3 class="test-head"> Tests</h3>
            <p class="test-para">No tests have been completed.</p>
          </div>
          <div class="labor-cloud">
            <a href="" class="btn btn-success">Take Test </a>
          </div>
          <br>
          <div class="labor">
            <h3 class="labor-header">Agreements</h3>
            <p class="para">No agreements have been signed.</p>
          </div>
        </div>
        <div class="tab-pane" id="solid-rounded-justified-tab2">
          Tab content 2
        </div>
        <div class="tab-pane" id="solid-rounded-justified-tab3">
          Tab content 3
        </div>
        <div class="tab-pane" id="solid-rounded-justified-tab4">
          Tab content 4
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="rating-box border p-3">
        <h6>
          <i class="fa fa-bar-chart"></i> Satisfaction 
          <span class="float-right text-warning">0%</span>
        </h6>
        <table class="table table-sm">
          <thead>
            <tr>
              <th></th>
              <th>3 Mo.</th>
              <th>All</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Paid Assign</td>
              <td>0</td>
              <td>0</td>
            </tr>
            <tr>
              <td>Cancelled</td>
              <td>0</td>
              <td>0</td>
            </tr>
            <tr>
              <td>Abandoned</td>
              <td>0</td>
              <td>0</td>
            </tr>
          </tbody>
        </table>

        <p>On-Time</p>
        <div class="rating-bar bg-light mb-2">
          <div class="rating-bar-fill bg-primary" style="width: 0%; height: 8px;"></div>
        </div>

        <p>Deliverables</p>
        <div class="rating-bar bg-light mb-3">
          <div class="rating-bar-fill bg-primary" style="width: 0%; height: 8px;"></div>
        </div>

        <button class="btn btn-primary btn-block">SEE RATINGS</button>
      </div>

      
  </div>
</div>
<div class="d-flex justify-content-end">
  <div class="col-12 col-md-6 col-lg-4 col-xl-4 ms-auto">
    <div class="card member-panel">
      <div class="card-header bg-white">
        <h4 class="card-title mb-0">Doctors</h4>
      </div>
        <div class="card-body">
            <ul class="contact-list">
                <li>
                    <div class="contact-cont">
                        <div class="float-left user-img m-r-10">
                            <a href="profile.html" title="John Doe"><img src="assets/img/user.jpg" alt="" class="w-40 rounded-circle"><span class="status online"></span></a>
                        </div>
                        <div class="contact-info">
                            <span class="contact-name text-ellipsis"><a href="">Add a profile photo</a></span>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="contact-cont">
                        <div class="float-left user-img m-r-10">
                            <a href="profile.html" title="Richard Miles"><img src="assets/img/user.jpg" alt="" class="w-40 rounded-circle"><span class="status offline"></span></a>
                        </div>
                        <div class="contact-info">
                            <span class="contact-name text-ellipsis"><a href="">Add a company logo</a></span>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="contact-cont">
                        <div class="float-left user-img m-r-10">
                            <a href="profile.html" title="John Doe"><img src="assets/img/user.jpg" alt="" class="w-40 rounded-circle"><span class="status away"></span></a>
                        </div>
                        <div class="contact-info">
                            <span class="contact-name text-ellipsis"><a href="">Add a company overview</a></span>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="contact-cont">
                        <div class="float-left user-img m-r-10">
                            <a href="profile.html" title="Richard Miles"><img src="assets/img/user.jpg" alt="" class="w-40 rounded-circle"><span class="status online"></span></a>
                        </div>
                        <div class="contact-info">
                            <span class="contact-name text-ellipsis"><a href="">Add professional certifications</a></span>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="contact-cont">
                        <div class="float-left user-img m-r-10">
                            <a href="profile.html" title="John Doe"><img src="assets/img/user.jpg" alt="" class="w-40 rounded-circle"><span class="status offline"></span></a>
                        </div>
                        <div class="contact-info">
                            <span class="contact-name text-ellipsis"><a href="">Upload your resume</a></span>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="contact-cont">
                        <div class="float-left user-img m-r-10">
                            <a href="profile.html" title="Richard Miles"><img src="assets/img/user.jpg" alt="" class="w-40 rounded-circle"><span class="status away"></span></a>
                        </div>
                        <div class="contact-info">
                            <span class="contact-name text-ellipsis"><a href="">Verify your bank account</a></span>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
        <div class="card-footer text-center bg-white">
            <a href="{{route('home')}}" class="text-muted">Home Dashboard</a>
        </div>
    </div>
  </div>
</div>

  

@endsection