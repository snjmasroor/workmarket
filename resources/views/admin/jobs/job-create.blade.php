
@extends('layouts.backend.master') 
@push('styles')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/spinkit/spinkit.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/select2/select2.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/tagify/tagify.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/bootstrap-select/bootstrap-select.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/typeahead-js/typeahead.css')}}" />
@endpush 
@section('page-content') 


<div class="container py-5">
<div class="row justify-content-center">
                <div class="col">
                  <h6 class="mt-6">Form with Tabs</h6>
                  <div class="card mb-6">
                    <div class="card-header px-0 pt-0">
                      <div class="nav-align-top">
                        <ul class="nav nav-tabs" role="tablist">
                          <li class="nav-item">
                            <button
                              type="button"
                              class="nav-link active"
                              data-bs-toggle="tab"
                              data-bs-target="#form-tabs-personal"
                              aria-controls="form-tabs-personal"
                              role="tab"
                              aria-selected="true">
                              <span class="ti ti-user ti-lg d-sm-none"></span
                              ><span class="d-none d-sm-block">Personal Info</span>
                            </button>
                          </li>
                          <li class="nav-item">
                            <button
                              type="button"
                              class="nav-link"
                              data-bs-toggle="tab"
                              data-bs-target="#form-tabs-account"
                              aria-controls="form-tabs-account"
                              role="tab"
                              aria-selected="false">
                              <span class="ti ti-user-cog ti-lg d-sm-none"></span
                              ><span class="d-none d-sm-block">Account Details</span>
                            </button>
                          </li>
                          <li class="nav-item">
                            <button
                              type="button"
                              class="nav-link"
                              data-bs-toggle="tab"
                              data-bs-target="#form-tabs-social"
                              aria-controls="form-tabs-social"
                              role="tab"
                              aria-selected="false">
                              <span class="ti ti-link ti-lg d-sm-none"></span
                              ><span class="d-none d-sm-block">Social Links</span>
                            </button>
                          </li>
                        </ul>
                      </div>
                    </div>

                    <div class="card-body">
                      <div class="tab-content p-0">
                        <!-- Personal Info -->
                        <div class="tab-pane fade active show" id="form-tabs-personal" role="tabpanel">
                          <form>
                            <div class="row g-6">
                              <div class="col-md-6">
                                <div class="row">
                                  <label class="col-sm-3 col-form-label text-sm-end" for="formtabs-first-name"
                                    >First Name</label
                                  >
                                  <div class="col-sm-9">
                                    <input
                                      type="text"
                                      id="formtabs-first-name"
                                      class="form-control"
                                      placeholder="John" />
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="row">
                                  <label class="col-sm-3 col-form-label text-sm-end" for="formtabs-last-name"
                                    >Last Name</label
                                  >
                                  <div class="col-sm-9">
                                    <input type="text" id="formtabs-last-name" class="form-control" placeholder="Doe" />
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="row">
                                  <label class="col-sm-3 col-form-label text-sm-end" for="formtabs-country"
                                    >Country</label
                                  >
                                  <div class="col-sm-9">
                                    <select id="formtabs-country" class="select2 form-select" data-allow-clear="true">
                                      <option value="">Select</option>
                                      <option value="Australia">Australia</option>
                                      <option value="Bangladesh">Bangladesh</option>
                                      <option value="Belarus">Belarus</option>
                                      <option value="Brazil">Brazil</option>
                                      <option value="Canada">Canada</option>
                                      <option value="China">China</option>
                                      <option value="France">France</option>
                                      <option value="Germany">Germany</option>
                                      <option value="India">India</option>
                                      <option value="Indonesia">Indonesia</option>
                                      <option value="Israel">Israel</option>
                                      <option value="Italy">Italy</option>
                                      <option value="Japan">Japan</option>
                                      <option value="Korea">Korea, Republic of</option>
                                      <option value="Mexico">Mexico</option>
                                      <option value="Philippines">Philippines</option>
                                      <option value="Russia">Russian Federation</option>
                                      <option value="South Africa">South Africa</option>
                                      <option value="Thailand">Thailand</option>
                                      <option value="Turkey">Turkey</option>
                                      <option value="Ukraine">Ukraine</option>
                                      <option value="United Arab Emirates">United Arab Emirates</option>
                                      <option value="United Kingdom">United Kingdom</option>
                                      <option value="United States">United States</option>
                                    </select>
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-6 select2-primary">
                                <div class="row">
                                  <label class="col-sm-3 col-form-label text-sm-end" for="formtabs-language"
                                    >Language</label
                                  >
                                  <div class="col-sm-9">
                                    <select id="formtabs-language" class="select2 form-select" multiple>
                                      <option value="en" selected>English</option>
                                      <option value="fr" selected>French</option>
                                      <option value="de">German</option>
                                      <option value="pt">Portuguese</option>
                                    </select>
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="row">
                                  <label class="col-sm-3 col-form-label text-sm-end" for="formtabs-birthdate"
                                    >Birth Date</label
                                  >
                                  <div class="col-sm-9">
                                    <input
                                      type="text"
                                      id="formtabs-birthdate"
                                      class="form-control dob-picker"
                                      placeholder="YYYY-MM-DD" />
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="row">
                                  <label class="col-sm-3 col-form-label text-sm-end" for="formtabs-phone"
                                    >Phone No</label
                                  >
                                  <div class="col-sm-9">
                                    <input
                                      type="text"
                                      id="formtabs-phone"
                                      class="form-control phone-mask"
                                      placeholder="658 799 8941"
                                      aria-label="658 799 8941" />
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="row mt-6">
                              <div class="col-md-6">
                                <div class="row justify-content-end">
                                  <div class="col-sm-9">
                                    <button type="submit" class="btn btn-primary me-4">Submit</button>
                                    <button type="reset" class="btn btn-label-secondary">Cancel</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </form>
                        </div>
                        <!-- Account Details -->
                        <div class="tab-pane fade" id="form-tabs-account" role="tabpanel">
                          <form>
                            <div class="row g-6">
                              <div class="col-md-6">
                                <div class="row">
                                  <label class="col-sm-3 col-form-label text-sm-end" for="formtabs-username"
                                    >Username</label
                                  >
                                  <div class="col-sm-9">
                                    <input
                                      type="text"
                                      id="formtabs-username"
                                      class="form-control"
                                      placeholder="john.doe" />
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="row">
                                  <label class="col-sm-3 col-form-label text-sm-end" for="formtabs-email">Email</label>
                                  <div class="col-sm-9">
                                    <div class="input-group input-group-merge">
                                      <input
                                        type="text"
                                        id="formtabs-email"
                                        class="form-control"
                                        placeholder="john.doe"
                                        aria-label="john.doe"
                                        aria-describedby="formtabs-email2" />
                                      <span class="input-group-text" id="formtabs-email2">@example.com</span>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="row form-password-toggle">
                                  <label class="col-sm-3 col-form-label text-sm-end" for="formtabs-password"
                                    >Password</label
                                  >
                                  <div class="col-sm-9">
                                    <div class="input-group input-group-merge">
                                      <input
                                        type="password"
                                        id="formtabs-password"
                                        class="form-control"
                                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                        aria-describedby="formtabs-password2" />
                                      <span class="input-group-text cursor-pointer" id="formtabs-password2"
                                        ><i class="ti ti-eye-off"></i
                                      ></span>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="row form-password-toggle">
                                  <label class="col-sm-3 col-form-label text-sm-end" for="formtabs-confirm-password"
                                    >Confirm</label
                                  >
                                  <div class="col-sm-9">
                                    <div class="input-group input-group-merge">
                                      <input
                                        type="password"
                                        id="formtabs-confirm-password"
                                        class="form-control"
                                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                        aria-describedby="formtabs-confirm-password2" />
                                      <span class="input-group-text cursor-pointer" id="formtabs-confirm-password2"
                                        ><i class="ti ti-eye-off"></i
                                      ></span>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="row mt-6">
                              <div class="col-md-6">
                                <div class="row justify-content-end">
                                  <div class="col-sm-9">
                                    <button type="submit" class="btn btn-primary me-4">Submit</button>
                                    <button type="reset" class="btn btn-label-secondary">Cancel</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </form>
                        </div>
                        <!-- Social Links -->
                        <div class="tab-pane fade" id="form-tabs-social" role="tabpanel">
                          <form>
                            <div class="row g-6">
                              <div class="col-md-6">
                                <div class="row">
                                  <label class="col-sm-3 col-form-label text-sm-end" for="formtabs-twitter"
                                    >Twitter</label
                                  >
                                  <div class="col-sm-9">
                                    <input
                                      type="text"
                                      id="formtabs-twitter"
                                      class="form-control"
                                      placeholder="https://twitter.com/abc" />
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="row">
                                  <label class="col-sm-3 col-form-label text-sm-end" for="formtabs-facebook"
                                    >Facebook</label
                                  >
                                  <div class="col-sm-9">
                                    <input
                                      type="text"
                                      id="formtabs-facebook"
                                      class="form-control"
                                      placeholder="https://facebook.com/abc" />
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="row">
                                  <label class="col-sm-3 col-form-label text-sm-end" for="formtabs-google"
                                    >Google+</label
                                  >
                                  <div class="col-sm-9">
                                    <input
                                      type="text"
                                      id="formtabs-google"
                                      class="form-control"
                                      placeholder="https://plus.google.com/abc" />
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="row">
                                  <label class="col-sm-3 col-form-label text-sm-end" for="formtabs-linkedin"
                                    >Linkedin</label
                                  >
                                  <div class="col-sm-9">
                                    <input
                                      type="text"
                                      id="formtabs-linkedin"
                                      class="form-control"
                                      placeholder="https://linkedin.com/abc" />
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="row">
                                  <label class="col-sm-3 col-form-label text-sm-end" for="formtabs-instagram"
                                    >Instagram</label
                                  >
                                  <div class="col-sm-9">
                                    <input
                                      type="text"
                                      id="formtabs-instagram"
                                      class="form-control"
                                      placeholder="https://instagram.com/abc" />
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="row">
                                  <label class="col-sm-3 col-form-label text-sm-end" for="formtabs-quora">Quora</label>
                                  <div class="col-sm-9">
                                    <input
                                      type="text"
                                      id="formtabs-quora"
                                      class="form-control"
                                      placeholder="https://quora.com/abc" />
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="row mt-6">
                              <div class="col-md-6">
                                <div class="row justify-content-end">
                                  <div class="col-sm-9">
                                    <button type="submit" class="btn btn-primary me-4">Submit</button>
                                    <button type="reset" class="btn btn-label-secondary">Cancel</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
@endsection
@push('scripts') 
<script src="{{asset('assets/js/cards-actions.js')}}"></script>
    <script src="{{asset('assets/vendor/libs/block-ui/block-ui.js')}}"></script>
    <script src="{{asset('assets/vendor/libs/sortablejs/sortable.js')}}"></script>
    <script src="{{asset('assets/vendor/libs/select2/select2.js')}}"></script>
    <script src="{{asset('assets/vendor/libs/tagify/tagify.js')}}"></script>
    <script src="{{asset('assets/vendor/libs/bootstrap-select/bootstrap-select.js')}}"></script>
    <script src="{{asset('assets/vendor/libs/bloodhound/bloodhound.js')}}"></script>
    <script src="{{asset('assets/js/forms-selects.js')}}"></script>
    <script src="{{asset('assets/js/forms-tagify.js')}}"></script>
    <script src="{{asset('assets/js/forms-typeahead.js')}}"></script>
@endpush