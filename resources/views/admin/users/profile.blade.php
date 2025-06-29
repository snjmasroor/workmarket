@extends('layouts.backend.master') 

@push('styles')
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-profile.css')}}" />
@endpush

@section('page-content')
            <div class="row">
                <div class="col-12">
                  <div class="card mb-6">
                    <div class="user-profile-header-banner">
                      <img src="{{asset('assets/img/pages/profile-banner.png')}}" alt="Banner image" class="rounded-top" />
                    </div>
                    <div class="user-profile-header d-flex flex-column flex-lg-row text-sm-start text-center mb-5">
                      <div class="flex-shrink-0 mt-n2 mx-sm-0 mx-auto">
                        <img
                          src="{{ $user->user_image_url }}"
                          alt="user image"
                          class="d-block h-auto ms-0 ms-sm-6 rounded user-profile-img" />
                      </div>
                      <div class="flex-grow-1 mt-3 mt-lg-5"> 
                        <div
                          class="d-flex align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start mx-5 flex-md-row flex-column gap-4">
                          <div class="user-profile-info">
                            <h4 class="mb-2 mt-lg-6">{{$user->name ?? ''}}</h4>
                            <ul
                              class="list-inline mb-0 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-4 my-2">
                              <li class="list-inline-item d-flex gap-2 align-items-center">
                                <i class="ti ti-palette ti-lg"></i><span class="fw-medium">{{$user->industry->name ?? ''}}</span>
                              </li>
                              <li class="list-inline-item d-flex gap-2 align-items-center">
                                <i class="ti ti-map-pin ti-lg"></i><span class="fw-medium">{{$user->latestAddress->city ?? ''}}</span>
                              </li>
                              <li class="list-inline-item d-flex gap-2 align-items-center">
                                <i class="ti ti-calendar ti-lg"></i><span class="fw-medium"> Joined {{$user->latestAddress->created_at ?? ''}}</span>
                              </li>
                            </ul>
                          </div>
                          <a href="javascript:void(0)" class="btn btn-primary mb-1">
                            <i class="ti ti-user-check ti-xs me-2"></i>Connected
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!--/ Header -->

              <!-- Navbar pills -->
              <div class="row">
                <div class="col-md-12">
                  <div class="nav-align-top">
                    <ul class="nav nav-pills flex-column flex-sm-row mb-6 gap-2 gap-lg-0">
                      <li class="nav-item">
                        <a class="nav-link active" href="javascript:void(0);"
                          ><i class="ti-sm ti ti-user-check me-1_5"></i> Profile</a
                        >
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="pages-profile-teams.html"
                          ><i class="ti-sm ti ti-users me-1_5"></i> Qualification</a
                        >
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="pages-profile-projects.html"
                          ><i class="ti-sm ti ti-layout-grid me-1_5"></i> Jobs</a
                        >
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="pages-profile-connections.html"
                          ><i class="ti-sm ti ti-link me-1_5"></i> Contracts</a
                        >
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
              <!--/ Navbar pills -->

              <!-- User Profile Content -->
              <div class="row">
                <div class="col-xl-4 col-lg-5 col-md-5">
                  <!-- About User -->
                  <div class="card mb-6">
                    <div class="card-body">
                      <small class="card-text text-uppercase text-muted small">About</small>
                      <ul class="list-unstyled my-3 py-1">
                        <li class="d-flex align-items-center mb-4">
                          <i class="ti ti-user ti-lg"></i><span class="fw-medium mx-2">Full Name:</span>
                          <span>{{$user->name ?? ''}}</span>
                        </li>
                        <li class="d-flex align-items-center mb-4">
                          <i class="ti ti-check ti-lg"></i><span class="fw-medium mx-2">Status:</span>
                          <span>{{ $user->active ? 'Active' : 'Inactive' }}</span>
                        </li>
                        <li class="d-flex align-items-center mb-4">
                          <i class="ti ti-crown ti-lg"></i><span class="fw-medium mx-2">Industry:</span>
                          <span>{{ $user->industry->name ?? ''}}</span>
                        </li>
                        <li class="d-flex align-items-center mb-4">
                          <i class="ti ti-flag ti-lg"></i><span class="fw-medium mx-2">Country:</span> <span>{{ $user->latestAddress->country ?? '' }}</span>
                        </li>
                        <li class="d-flex align-items-center mb-2">
                          <i class="ti ti-language ti-lg"></i><span class="fw-medium mx-2">Languages:</span>
                          <span>English</span>
                        </li>
                      </ul>
                      <small class="card-text text-uppercase text-muted small">Contacts</small>
                      <ul class="list-unstyled my-3 py-1">
                        <li class="d-flex align-items-center mb-4">
                          <i class="ti ti-phone-call ti-lg"></i><span class="fw-medium mx-2">Contact:</span>
                          <span>{{ $user->phone }}</span>
                        </li>
                        <li class="d-flex align-items-center mb-4">
                          <i class="ti ti-mail ti-lg"></i><span class="fw-medium mx-2">Email:</span>
                          <span>{{ $user->email }}</span>
                        </li>
                      </ul>
                      <small class="card-text text-uppercase text-muted small">Skills</small>
                      <ul class="list-unstyled mb-0 mt-3 pt-1">
                         @forelse ($user->skills as $skill)
                        <li class="d-flex flex-wrap mb-4">
                          <span class="fw-medium me-2">{{ $skill->name }}</span>
                        </li>
                          @empty
                          <li class="d-flex flex-wrap">
                          <span class="fw-medium me-2">No skills added.</span>
                        </li>
                          @endforelse
                        
                      </ul>
                    </div>
                  </div>
                  <!--/ About User -->
                  <!-- Profile Overview -->
                  <div class="card mb-6">
                    <div class="card-body">
                      <small class="card-text text-uppercase text-muted small">Overview</small>
                      <ul class="list-unstyled mb-0 mt-3 pt-1">
                        <li class="d-flex align-items-end mb-4">
                          <i class="ti ti-check ti-lg"></i><span class="fw-medium mx-2">Task Compiled:</span>
                          <span>13.5k</span>
                        </li>
                        <li class="d-flex align-items-end mb-4">
                          <i class="ti ti-layout-grid ti-lg"></i><span class="fw-medium mx-2">Projects Compiled:</span>
                          <span>146</span>
                        </li>
                        <li class="d-flex align-items-end">
                          <i class="ti ti-users ti-lg"></i><span class="fw-medium mx-2">Connections:</span>
                          <span>897</span>
                        </li>
                      </ul>
                    </div>
                  </div>
                  <!--/ Profile Overview -->
                </div>
                <div class="col-xl-8 col-lg-7 col-md-7">
                  <!-- Activity Timeline -->
                  {{-- <div class="card card-action mb-6">
                    <div class="card-header align-items-center">
                      <h5 class="card-action-title mb-0">
                        <i class="ti ti-chart-bar ti-lg text-body me-4"></i>Activity Timeline
                      </h5>
                    </div>
                    <div class="card-body pt-3">
                      <ul class="timeline mb-0">
                        <li class="timeline-item timeline-item-transparent">
                          <span class="timeline-point timeline-point-primary"></span>
                          <div class="timeline-event">
                            <div class="timeline-header mb-3">
                              <h6 class="mb-0">12 Invoices have been paid</h6>
                              <small class="text-muted">12 min ago</small>
                            </div>
                            <p class="mb-2">Invoices have been paid to the company</p>
                            <div class="d-flex align-items-center mb-2">
                              <div class="badge bg-lighter rounded d-flex align-items-center">
                                <img src="../../assets//img/icons/misc/pdf.png" alt="img" width="15" class="me-2" />
                                <span class="h6 mb-0 text-body">invoices.pdf</span>
                              </div>
                            </div>
                          </div>
                        </li>
                        <li class="timeline-item timeline-item-transparent">
                          <span class="timeline-point timeline-point-success"></span>
                          <div class="timeline-event">
                            <div class="timeline-header mb-3">
                              <h6 class="mb-0">Client Meeting</h6>
                              <small class="text-muted">45 min ago</small>
                            </div>
                            <p class="mb-2">Project meeting with john @10:15am</p>
                            <div class="d-flex justify-content-between flex-wrap gap-2 mb-2">
                              <div class="d-flex flex-wrap align-items-center mb-50">
                                <div class="avatar avatar-sm me-3">
                                  <img src="../../assets/img/avatars/1.png" alt="Avatar" class="rounded-circle" />
                                </div>
                                <div>
                                  <p class="mb-0 small fw-medium">Lester McCarthy (Client)</p>
                                  <small>CEO of Pixinvent</small>
                                </div>
                              </div>
                            </div>
                          </div>
                        </li>
                        <li class="timeline-item timeline-item-transparent">
                          <span class="timeline-point timeline-point-info"></span>
                          <div class="timeline-event">
                            <div class="timeline-header mb-3">
                              <h6 class="mb-0">Create a new project for client</h6>
                              <small class="text-muted">2 Day Ago</small>
                            </div>
                            <p class="mb-2">6 team members in a project</p>
                            <ul class="list-group list-group-flush">
                              <li
                                class="list-group-item d-flex justify-content-between align-items-center flex-wrap border-top-0 p-0">
                                <div class="d-flex flex-wrap align-items-center">
                                  <ul class="list-unstyled users-list d-flex align-items-center avatar-group m-0 me-2">
                                    <li
                                      data-bs-toggle="tooltip"
                                      data-popup="tooltip-custom"
                                      data-bs-placement="top"
                                      title="Vinnie Mostowy"
                                      class="avatar pull-up">
                                      <img class="rounded-circle" src="../../assets/img/avatars/1.png" alt="Avatar" />
                                    </li>
                                    <li
                                      data-bs-toggle="tooltip"
                                      data-popup="tooltip-custom"
                                      data-bs-placement="top"
                                      title="Allen Rieske"
                                      class="avatar pull-up">
                                      <img class="rounded-circle" src="../../assets/img/avatars/4.png" alt="Avatar" />
                                    </li>
                                    <li
                                      data-bs-toggle="tooltip"
                                      data-popup="tooltip-custom"
                                      data-bs-placement="top"
                                      title="Julee Rossignol"
                                      class="avatar pull-up">
                                      <img class="rounded-circle" src="../../assets/img/avatars/2.png" alt="Avatar" />
                                    </li>
                                    <li class="avatar">
                                      <span
                                        class="avatar-initial rounded-circle pull-up text-heading"
                                        data-bs-toggle="tooltip"
                                        data-bs-placement="bottom"
                                        title="3 more"
                                        >+3</span
                                      >
                                    </li>
                                  </ul>
                                </div>
                              </li>
                            </ul>
                          </div>
                        </li>
                      </ul>
                    </div>
                  </div> --}}
                  <!--/ Activity Timeline -->
                  <div class="row">
                    <!-- Connections -->
                    {{-- <div class="col-lg-12 col-xl-6">
                      <div class="card card-action mb-6">
                        <div class="card-header align-items-center">
                          <h5 class="card-action-title mb-0">Connections</h5>
                          <div class="card-action-element">
                            <div class="dropdown">
                              <button
                                type="button"
                                class="btn btn-icon btn-text-secondary rounded-pill dropdown-toggle hide-arrow p-0 text-muted"
                                data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <i class="ti ti-dots-vertical ti-md text-muted"></i>
                              </button>
                              <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="javascript:void(0);">Share connections</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);">Suggest edits</a></li>
                                <li>
                                  <hr class="dropdown-divider" />
                                </li>
                                <li><a class="dropdown-item" href="javascript:void(0);">Report bug</a></li>
                              </ul>
                            </div>
                          </div>
                        </div>
                        <div class="card-body">
                          <ul class="list-unstyled mb-0">
                            <li class="mb-4">
                              <div class="d-flex align-items-center">
                                <div class="d-flex align-items-center">
                                  <div class="avatar me-2">
                                    <img src="../../assets/img/avatars/2.png" alt="Avatar" class="rounded-circle" />
                                  </div>
                                  <div class="me-2">
                                    <h6 class="mb-0">Cecilia Payne</h6>
                                    <small>45 Connections</small>
                                  </div>
                                </div>
                                <div class="ms-auto">
                                  <button class="btn btn-label-primary btn-icon">
                                    <i class="ti ti-user-check ti-md"></i>
                                  </button>
                                </div>
                              </div>
                            </li>
                            <li class="mb-4">
                              <div class="d-flex align-items-center">
                                <div class="d-flex align-items-center">
                                  <div class="avatar me-2">
                                    <img src="../../assets/img/avatars/3.png" alt="Avatar" class="rounded-circle" />
                                  </div>
                                  <div class="me-2">
                                    <h6 class="mb-0">Curtis Fletcher</h6>
                                    <small>1.32k Connections</small>
                                  </div>
                                </div>
                                <div class="ms-auto">
                                  <button class="btn btn-primary btn-icon"><i class="ti ti-user-x ti-md"></i></button>
                                </div>
                              </div>
                            </li>
                            <li class="mb-4">
                              <div class="d-flex align-items-center">
                                <div class="d-flex align-items-center">
                                  <div class="avatar me-2">
                                    <img src="../../assets/img/avatars/10.png" alt="Avatar" class="rounded-circle" />
                                  </div>
                                  <div class="me-2">
                                    <h6 class="mb-0">Alice Stone</h6>
                                    <small>125 Connections</small>
                                  </div>
                                </div>
                                <div class="ms-auto">
                                  <button class="btn btn-primary btn-icon"><i class="ti ti-user-x ti-md"></i></button>
                                </div>
                              </div>
                            </li>
                            <li class="mb-4">
                              <div class="d-flex align-items-center">
                                <div class="d-flex align-items-center">
                                  <div class="avatar me-2">
                                    <img src="../../assets/img/avatars/7.png" alt="Avatar" class="rounded-circle" />
                                  </div>
                                  <div class="me-2">
                                    <h6 class="mb-0">Darrell Barnes</h6>
                                    <small>456 Connections</small>
                                  </div>
                                </div>
                                <div class="ms-auto">
                                  <button class="btn btn-label-primary btn-icon">
                                    <i class="ti ti-user-check ti-md"></i>
                                  </button>
                                </div>
                              </div>
                            </li>

                            <li class="mb-6">
                              <div class="d-flex align-items-center">
                                <div class="d-flex align-items-center">
                                  <div class="avatar me-2">
                                    <img src="../../assets/img/avatars/12.png" alt="Avatar" class="rounded-circle" />
                                  </div>
                                  <div class="me-2">
                                    <h6 class="mb-0">Eugenia Moore</h6>
                                    <small>1.2k Connections</small>
                                  </div>
                                </div>
                                <div class="ms-auto">
                                  <button class="btn btn-label-primary btn-icon">
                                    <i class="ti ti-user-check ti-md"></i>
                                  </button>
                                </div>
                              </div>
                            </li>
                            <li class="text-center">
                              <a href="javascript:;">View all connections</a>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </div> --}}
                    <!--/ Connections -->
                    <!-- Teams -->
                    {{-- <div class="col-lg-12 col-xl-6">
                      <div class="card card-action mb-6">
                        <div class="card-header align-items-center">
                          <h5 class="card-action-title mb-0">Teams</h5>
                          <div class="card-action-element">
                            <div class="dropdown">
                              <button
                                type="button"
                                class="btn btn-icon btn-text-secondary dropdown-toggle hide-arrow p-0"
                                data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <i class="ti ti-dots-vertical text-muted"></i>
                              </button>
                              <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="javascript:void(0);">Share teams</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);">Suggest edits</a></li>
                                <li>
                                  <hr class="dropdown-divider" />
                                </li>
                                <li><a class="dropdown-item" href="javascript:void(0);">Report bug</a></li>
                              </ul>
                            </div>
                          </div>
                        </div>
                        <div class="card-body">
                          <ul class="list-unstyled mb-0">
                            <li class="mb-4">
                              <div class="d-flex align-items-center">
                                <div class="d-flex align-items-center">
                                  <div class="avatar me-2">
                                    <img
                                      src="../../assets/img/icons/brands/react-label.png"
                                      alt="Avatar"
                                      class="rounded-circle" />
                                  </div>
                                  <div class="me-2">
                                    <h6 class="mb-0">React Developers</h6>
                                    <small>72 Members</small>
                                  </div>
                                </div>
                                <div class="ms-auto">
                                  <a href="javascript:;"><span class="badge bg-label-danger">Developer</span></a>
                                </div>
                              </div>
                            </li>
                            <li class="mb-4">
                              <div class="d-flex align-items-center">
                                <div class="d-flex align-items-center">
                                  <div class="avatar me-2">
                                    <img
                                      src="../../assets/img/icons/brands/support-label.png"
                                      alt="Avatar"
                                      class="rounded-circle" />
                                  </div>
                                  <div class="me-2">
                                    <h6 class="mb-0">Support Team</h6>
                                    <small>122 Members</small>
                                  </div>
                                </div>
                                <div class="ms-auto">
                                  <a href="javascript:;"><span class="badge bg-label-primary">Support</span></a>
                                </div>
                              </div>
                            </li>
                            <li class="mb-4">
                              <div class="d-flex align-items-center">
                                <div class="d-flex align-items-center">
                                  <div class="avatar me-2">
                                    <img
                                      src="../../assets/img/icons/brands/figma-label.png"
                                      alt="Avatar"
                                      class="rounded-circle" />
                                  </div>
                                  <div class="me-2">
                                    <h6 class="mb-0">UI Designers</h6>
                                    <small>7 Members</small>
                                  </div>
                                </div>
                                <div class="ms-auto">
                                  <a href="javascript:;"><span class="badge bg-label-info">Designer</span></a>
                                </div>
                              </div>
                            </li>
                            <li class="mb-4">
                              <div class="d-flex align-items-center">
                                <div class="d-flex align-items-center">
                                  <div class="avatar me-2">
                                    <img
                                      src="../../assets/img/icons/brands/vue-label.png"
                                      alt="Avatar"
                                      class="rounded-circle" />
                                  </div>
                                  <div class="me-2">
                                    <h6 class="mb-0">Vue.js Developers</h6>
                                    <small>289 Members</small>
                                  </div>
                                </div>
                                <div class="ms-auto">
                                  <a href="javascript:;"><span class="badge bg-label-danger">Developer</span></a>
                                </div>
                              </div>
                            </li>
                            <li class="mb-6">
                              <div class="d-flex align-items-center">
                                <div class="d-flex align-items-center">
                                  <div class="avatar me-2">
                                    <img
                                      src="../../assets/img/icons/brands/twitter-label.png"
                                      alt="Avatar"
                                      class="rounded-circle" />
                                  </div>
                                  <div class="me-w">
                                    <h6 class="mb-0">Digital Marketing</h6>
                                    <small>24 Members</small>
                                  </div>
                                </div>
                                <div class="ms-auto">
                                  <a href="javascript:;"><span class="badge bg-label-secondary">Marketing</span></a>
                                </div>
                              </div>
                            </li>
                            <li class="text-center">
                              <a href="javascript:;">View all teams</a>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </div> --}}
                    <!--/ Teams -->
                  </div>
                  <!-- Projects table -->
                  {{-- <div class="card mb-4">
                    <div class="card-datatable table-responsive">
                      <table class="datatables-projects table border-top">
                        <thead>
                          <tr>
                            <th></th>
                            <th></th>
                            <th>Project</th>
                            <th>Leader</th>
                            <th>Team</th>
                            <th class="w-px-200">Progress</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                      </table>
                    </div>
                  </div> --}}
                  <!--/ Projects table -->
                </div>
              </div>
@endsection

@push('scripts')
<script src="{{asset('assets/js/pages-profile.js')}}"></script>
@endpush
