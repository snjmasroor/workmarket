            @if(auth()->user()->type === 'admin')
            <aside id="layout-menu" class="layout-menu-horizontal menu-horizontal menu bg-menu-theme flex-grow-0">
              <div class="container-xxl d-flex h-100">
                <ul class="menu-inner pb-2 pb-xl-0">
                  <li class="menu-item {{ request()->routeIs(['superadmin.home', 'admin.home']) ? 'active' : '' }}">
                    <a href="" class="menu-link menu-toggle">
                      <i class="menu-icon tf-icons ti ti-dashboard"></i>
                      <div data-i18n="Dashboards">Dashboards</div>
                    </a>
                    <ul class="menu-sub">
                      <li class="menu-item active">
                        <a href="index.html" class="menu-link">
                          <i class="menu-icon tf-icons ti ti-chart-bar"></i>
                          <div data-i18n="Job stats">Job stats</div>
                        </a>
                      </li>
                      <li class="menu-item">
                        <a href="dashboards-crm.html" class="menu-link">
                          <i class="menu-icon tf-icons ti ti-users"></i>
                          <div data-i18n="Contractor engagement">Contractor engagement</div>
                        </a>
                      </li>
                      <li class="menu-item">
                        <a href="app-ecommerce-dashboard.html" class="menu-link">
                          <i class="menu-icon tf-icons ti ti-wallet"></i>
                          <div data-i18n="Budget spent">Budget spent</div>
                        </a>
                      </li>
                    </ul>
                  </li>

                  <li class="menu-item {{ request()->routeIs('admin.jobs*') ? 'active' : '' }}">
                    <a href="javascript:void(0)" class="menu-link menu-toggle">
                      <i class="menu-icon tf-icons ti ti-clipboard-text"></i>
                      <div data-i18n="Post Jobs">Post Jobs</div>
                    </a>
                    <ul class="menu-sub">
                      <li class="menu-item {{ request()->routeIs('admin.jobs.create') ? 'active' : '' }}">
                        <a href="{{route('admin.jobs.create')}}" class="menu-link">
                          <i class="menu-icon tf-icons ti ti-pencil-plus"></i>
                          <div data-i18n="Create/Edit jobs">Create/Edit jobs</div>
                        </a>
                        <a href="{{route('admin.jobs.show')}}" class="menu-link">
                          <i class="menu-icon tf-icons ti ti-list-details"></i>
                          <div data-i18n="View all jobs">View all jobs</div>
                        </a>
                        {{-- <a href="{{route('admin.jobs.show')}}" class="menu-link">
                          <i class="menu-icon tf-icons ti ti-file-invoice"></i>
                          <div data-i18n="Set requirements">Set requirements</div>
                        </a> --}}
                        <a href="{{route('admin.jobs.show')}}" class="menu-link">
                          <i class="menu-icon tf-icons ti ti-currency-dollar"></i>
                          <div data-i18n="Set pricing (fixed/hourly)">Set pricing (fixed/hourly)</div>
                        </a>
                      </li>
                    </ul>
                  </li>

                  <li class="menu-item {{ request()->routeIs('admin.user*') ? 'active' : '' }}">
                    <a href="javascript:void(0)" class="menu-link menu-toggle">
                      <i class="menu-icon tf-icons ti ti-users"></i>
                      <div data-i18n="Manage Contractors">Manage Contractors</div>
                    </a>

                    <ul class="menu-sub">
                      <li class="menu-item {{ request()->routeIs('admin.user.index') ? 'active' : '' }}">
                        <a href="{{route('admin.user.index')}}" class="menu-link">
                          <i class="menu-icon tf-icons ti ti-user-plus"></i>
                          <div data-i18n="Invite contractors">Invite contractors</div>
                        </a>
                      </li>
                      <li class="menu-item">
                        <a href="{{route('admin.user.index')}}" class="menu-link" target="_blank">
                          <i class="menu-icon tf-icons ti ti-clipboard-list"></i>
                          <div data-i18n="View contractor profiles">View contractor profiles</div>
                        </a>
                      </li>
                      <li class="menu-item">
                        <a href="../vertical-menu-template/" class="menu-link" target="_blank">
                          <i class="menu-icon tf-icons ti ti-user-check"></i>
                          <div data-i18n="Assign contractors to jobs">Assign contractors to jobs</div>
                        </a>
                      </li>
                      <li class="menu-item">
                        <a href="../vertical-menu-template/" class="menu-link" target="_blank">
                          <i class="menu-icon tf-icons ti ti-star"></i>
                          <div data-i18n="Rate & review">Rate & reviews</div>
                        </a>
                      </li>
                    </ul>
                  </li>

                  <li class="menu-item {{ request()->routeIs('admin.jobs.contract*') ? 'active' : '' }}">
                    <a href="javascript:void(0)" class="menu-link menu-toggle">
                      <i class="menu-icon tf-icons ti ti-file-signature"></i>
                      <div data-i18n="Contracts">Contracts</div>
                    </a>

                    <ul class="menu-sub">
                      <li class="menu-item {{ request()->routeIs('admin.jobs.contract') ? 'active' : '' }}">
                        <a href="{{route('admin.user.index')}}" class="menu-link">
                          <i class="menu-icon tf-icons ti ti-file-pencil"></i>
                          <div data-i18n="Create contract templates">Create contract templates</div>
                        </a>
                      </li>
                      <li class="menu-item">
                        <a href="{{route('admin.user.index')}}" class="menu-link" target="_blank">
                          <i class="menu-icon tf-icons ti ti-signature"></i>
                          <div data-i18n="Sign contracts with contractors">Sign contracts with contractors</div>
                        </a>
                      </li>
                      <li class="menu-item">
                        <a href="../vertical-menu-template/" class="menu-link" target="_blank">
                          <i class="menu-icon tf-icons ti ti-progress-check"></i>
                          <div data-i18n="Track contract status">Track contract status</div>
                        </a>
                      </li>
                    </ul>
                  </li>

                  <li class="menu-item {{ request()->routeIs('admin.jobs.contract*') ? 'active' : '' }}">
                    <a href="javascript:void(0)" class="menu-link menu-toggle">
                      <i class="menu-icon tf-icons ti ti-messages"></i>
                      <div data-i18n="Messaging / Communication">Messaging / Communication</div>
                    </a>

                    <ul class="menu-sub">
                      <li class="menu-item {{ request()->routeIs('admin.jobs.contract') ? 'active' : '' }}">
                        <a href="{{route('admin.user.index')}}" class="menu-link">
                          <i class="menu-icon tf-icons ti ti-file-text"></i>
                          <div data-i18n="Create contract templates">Create contract templates</div>
                        </a>
                      </li>
                      <li class="menu-item">
                        <a href="{{route('admin.user.index')}}" class="menu-link" target="_blank">
                          <i class="menu-icon tf-icons ti ti-message-circle"></i>
                          <div data-i18n="Chat with contractors">Chat with contractors</div>
                        </a>
                      </li>
                      <li class="menu-item">
                        <a href="../vertical-menu-template/" class="menu-link" target="_blank">
                          <i class="menu-icon tf-icons ti ti-files"></i>
                          <div data-i18n="Share documents">Share documents</div>
                        </a>
                      </li>
                      <li class="menu-item">
                        <a href="../vertical-menu-template/" class="menu-link" target="_blank">
                          <i class="menu-icon tf-icons ti ti-bell"></i>
                          <div data-i18n="Notifications center">Notifications center</div>
                        </a>
                      </li>
                    </ul>
                  </li>
                  <li class="menu-item {{ request()->routeIs('admin.jobs.contract*') ? 'active' : '' }}">
                    <a href="javascript:void(0)" class="menu-link menu-toggle">
                      <i class="menu-icon tf-icons ti ti-currency-dollar"></i>
                      <div data-i18n="Payments">Payments</div>
                    </a>
                    <ul class="menu-sub">

                      <li class="menu-item">
                        <a href="{{route('admin.user.index')}}" class="menu-link" target="_blank">
                          <i class="menu-icon tf-icons ti ti-cash"></i>
                          <div data-i18n="Job payments">Job payments</div>
                        </a>
                      </li>
                      <li class="menu-item">
                        <a href="../vertical-menu-template/" class="menu-link" target="_blank">
                          <i class="menu-icon tf-icons ti ti-receipt"></i>
                          <div data-i18n="View transaction history">View transaction history</div>
                        </a>
                      </li>
                      <li class="menu-item">
                        <a href="../vertical-menu-template/" class="menu-link" target="_blank">
                          <i class="menu-icon tf-icons ti ti-credit-card"></i>
                          <div data-i18n="Initiate/track contractor payments">Initiate/track contractor payments</div>
                        </a>
                      </li>
                    </ul>
                  </li>

                  <li class="menu-item {{ request()->routeIs(['admin.industries*', 'admin.skills*', 'industry-skills*']) ? 'active' : '' }}">
                    <a href="javascript:void(0)" class="menu-link menu-toggle">
                      <i class="menu-icon tf-icons ti ti-users-group"></i>
                      <div data-i18n="Teams & Roles">Teams & Roles</div>
                    </a>
                    <ul class="menu-sub">
                      <li class="menu-item {{ request()->routeIs('admin.industries.show') ? 'active' : '' }}">
                        <a href="{{route('admin.industries.show')}}" class="menu-link">
                          <i class="menu-icon tf-icons ti ti-user-plus"></i>
                          <div data-i18n="Invite internal team members">Invite internal team members</div>
                        </a>
                      </li>
                      <li class="menu-item {{ request()->routeIs('admin.skills.show') ? 'active' : '' }} ">
                        <a href="{{route('admin.skills.show')}}" class="menu-link">
                          <i class="menu-icon tf-icons ti ti-clipboard-list"></i>
                          <div data-i18n="Assign roles">Assign roles</div>
                        </a>
                      </li>
                    </ul>
                  </li>

                  <li class="menu-item {{ request()->routeIs(['admin.company*']) ? 'active' : '' }}">
                    <a href="javascript:void(0)" class="menu-link menu-toggle">
                      <i class="menu-icon tf-icons ti ti-building-community"></i>
                      <div data-i18n="Company Profile">Company Profile</div>
                    </a>
                    <ul class="menu-sub">
                      <li class="menu-item {{ request()->routeIs('admin.company.create') ? 'active' : '' }}">
                        <a href="{{route('admin.company.create')}}" class="menu-link">
                          <i class="menu-icon tf-icons ti ti-user-circle"></i>
                          <div data-i18n="Profile">Profile</div>
                        </a>
                      </li>
                      <li class="menu-item {{ request()->routeIs('admin.skills.show') ? 'active' : '' }} ">
                        <a href="{{route('admin.skills.show')}}" class="menu-link">
                          <i class="menu-icon tf-icons ti ti-settings"></i>
                          <div data-i18n="Company settings">Company settings</div>
                        </a>
                      </li>
                      <li class="menu-item {{ request()->routeIs('admin.skills.show') ? 'active' : '' }} ">
                        <a href="{{route('admin.skills.show')}}" class="menu-link">
                          <i class="menu-icon tf-icons ti ti-credit-card"></i>
                          <div data-i18n="Billing details">Billing details</div>
                        </a>
                      </li>
                    </ul>
                  </li>

                  <li class="menu-item {{ request()->routeIs(['admin.industries*', 'admin.skills*', 'industry-skills*']) ? 'active' : '' }}">
                    <a href="javascript:void(0)" class="menu-link menu-toggle">
                      <i class="menu-icon tf-icons ti ti-tool"></i>
                      <div data-i18n="Tools Required">Tools Required</div>
                    </a>
                    <ul class="menu-sub">
                      <li class="menu-item {{ request()->routeIs('admin.industries.show') ? 'active' : '' }}">
                        <a href="{{route('admin.industries.show')}}" class="menu-link">
                          <i class="menu-icon tf-icons ti ti-hammer"></i>
                          <div data-i18n="Assign required tools per job">Assign required tools per job</div>
                        </a>
                      </li>
                      <li class="menu-item {{ request()->routeIs('admin.skills.show') ? 'active' : '' }} ">
                        <a href="{{route('admin.skills.show')}}" class="menu-link">
                          <i class="menu-icon tf-icons ti ti-award"></i>
                          <div data-i18n="Certifications & tests setup">Certifications & tests setup</div>
                        </a>
                      </li>

                    </ul>
                  </li>

                  <li class="menu-item {{ request()->routeIs(['admin.industries*', 'admin.skills*', 'industry-skills*']) ? 'active' : '' }}">
                    <a href="javascript:void(0)" class="menu-link menu-toggle">
                      <i class="menu-icon tf-icons ti ti-report-analytics"></i>
                      <div data-i18n="Reports">Reports</div>
                    </a>
                    <ul class="menu-sub">
                      <li class="menu-item {{ request()->routeIs('admin.industries.show') ? 'active' : '' }}">
                        <a href="{{route('admin.industries.show')}}" class="menu-link">
                          <i class="menu-icon tf-icons ti ti-checks"></i>
                          <div data-i18n="Job completion report">Job completion report</div>
                        </a>
                      </li>
                      <li class="menu-item {{ request()->routeIs('admin.skills.show') ? 'active' : '' }} ">
                        <a href="{{route('admin.skills.show')}}" class="menu-link">
                          <i class="menu-icon tf-icons ti ti-currency-dollar-off"></i>
                          <div data-i18n="Payment report">Payment report</div>
                        </a>
                      </li>
                      <li class="menu-item {{ request()->routeIs('admin.skills.show') ? 'active' : '' }} ">
                        <a href="{{route('admin.skills.show')}}" class="menu-link">
                          <i class="menu-icon tf-icons ti ti-users-plus"></i>
                          <div data-i18n="Contractor performance">Contractor performance</div>
                        </a>
                      </li>

                    </ul>
                  </li>
                </ul>
              </div>
            </aside>
            @elseif(auth()->user()->type === 'superadmin') 
            <aside id="layout-menu" class="layout-menu-horizontal menu-horizontal menu bg-menu-theme flex-grow-0">
              <div class="container-xxl d-flex h-100">
                <ul class="menu-inner pb-2 pb-xl-0">
                  <li class="menu-item {{ request()->routeIs(['superadmin.home', 'admin.home']) ? 'active' : '' }}">
                    <a href="{{ route('superadmin.home') }}" class="menu-link menu-toggle">
                      <i class="menu-icon tf-icons ti ti-dashboard"></i>
                      <div data-i18n="Dashboards">Dashboards</div>
                    </a>
                    <ul class="menu-sub">
                      <li class="menu-item active">
                        <a href="index.html" class="menu-link">
                          <i class="menu-icon tf-icons ti ti-chart-bar"></i>
                          <div data-i18n="Job stats">Job stats</div>
                        </a>
                      </li>
                      <li class="menu-item">
                        <a href="dashboards-crm.html" class="menu-link">
                          <i class="menu-icon tf-icons ti ti-user-check"></i>
                          <div data-i18n="User signups & engagement">User signups & engagement</div>
                        </a>
                      </li>
                      <li class="menu-item">
                        <a href="app-ecommerce-dashboard.html" class="menu-link">
                          <i class="menu-icon tf-icons ti ti-wallet"></i>
                          <div data-i18n="Budget spent">Budget spent</div>
                        </a>
                      </li>
                    </ul>
                  </li>

                  <li class="menu-item {{ request()->routeIs(['admin.industries*', 'admin.skills*']) ? 'active' : '' }} ">
                    <a href="javascript:void(0)" class="menu-link menu-toggle">
                      <i class="menu-icon tf-icons ti ti-category"></i>
                      <div data-i18n="Manage Industries & Skills">Manage Industries & Skills</div>
                    </a>
                    <ul class="menu-sub">
                      <li class="menu-item {{ request()->routeIs('admin.industries.show') ? 'active' : '' }}">
                        <a href="{{route('admin.industries.show')}}" class="menu-link">
                          <i class="menu-icon tf-icons ti ti-building-warehouse"></i>
                          <div data-i18n="Add/Edit/Delete Industries">Add/Edit/Delete Industries</div>
                        </a>
                        <a href="{{route('admin.skills.show')}}" class="menu-link">
                          <i class="menu-icon tf-icons ti ti-tools"></i>
                          <div data-i18n="Add/Edit/Delete Skills">Add/Edit/Delete Skills</div>
                        </a>
                        <a href="{{route('industry-skill.create')}}" class="menu-link">
                          <i class="menu-icon tf-icons ti ti-link"></i>
                          <div data-i18n="Assign Skills to Industries">Assign Skills to Industries</div>
                        </a>
                      </li>
                    </ul>
                  </li>

                  <li class="menu-item {{ request()->routeIs(['admin.certificates*', 'admin.tests*']) ? 'active' : '' }}">
                    <a href="javascript:void(0)" class="menu-link menu-toggle">
                      <i class="menu-icon tf-icons ti ti-award"></i>
                      <div data-i18n="Manage Certifications/Tools/Tests">Manage Certifications/Tools/Tests</div>
                    </a>
                    <ul class="menu-sub">
                      <li class="menu-item {{ request()->routeIs('admin.certificates.index') ? 'active' : '' }}">
                        <a href="{{route('admin.certificates.index')}}" class="menu-link">
                          <i class="menu-icon tf-icons ti ti-certificate"></i>
                          <div data-i18n="Add/Edit/Delete Certifications">Add/Edit/Delete Certifications</div>
                        </a>
                      </li>
                      <li class="menu-item {{ request()->routeIs('admin.tools.index') ? 'active' : '' }}">
                        <a href="{{route('admin.tools.index')}}" class="menu-link">
                          <i class="menu-icon tf-icons ti ti-tool"></i>
                          <div data-i18n="Add/Edit/Delete Tools">Add/Edit/Delete Tools</div>
                        </a>
                      </li>
                      <li class="menu-item {{ request()->routeIs('admin.tests.show') ? 'active' : '' }}">
                        <a href="{{ route('admin.tests.show') }}" class="menu-link" >
                          <i class="menu-icon tf-icons ti ti-clipboard-text"></i>
                          <div data-i18n="Add/Edit/Delete Tests">Add/Edit/Delete Tests</div>
                        </a>
                      </li>
                      <li class="menu-item {{ request()->routeIs('admin.questions.all') ? 'active' : '' }}">
                        <a href="{{ route('admin.questions.all') }}" class="menu-link" >
                          <i class="menu-icon tf-icons ti ti-help-circle"></i>
                          <div data-i18n="Manage Test Questions">Manage Test Questions</div>
                        </a>
                      </li>
                    </ul>
                  </li>

                  <li class="menu-item {{ request()->routeIs('admin.jobs*') ? 'active' : '' }}">
                    <a href="javascript:void(0)" class="menu-link menu-toggle">
                      <i class="menu-icon tf-icons ti ti-briefcase"></i>
                      <div data-i18n="Jobs Management">Jobs Management</div>
                    </a>
                    <ul class="menu-sub">
                      <li class="menu-item {{ request()->routeIs('admin.jobs.show') ? 'active' : '' }}">
                        <a href="{{route('admin.jobs.show')}}" class="menu-link">
                          <i class="menu-icon tf-icons ti ti-clipboard-list"></i>
                          <div data-i18n="View all jobs">View all jobs</div>
                        </a>
                      </li>
                      <li class="menu-item">
                        <a href="" class="menu-link">
                          <i class="menu-icon tf-icons ti ti-checks"></i>
                          <div data-i18n="Approve/Reject admin job posts">Approve/Reject admin job posts</div>
                        </a>
                      </li>
                      <li class="menu-item">
                        <a href="../vertical-menu-template/" class="menu-link" target="_blank">
                          <i class="menu-icon tf-icons ti ti-file-invoice"></i>
                          <div data-i18n="Set global job requirements">Set global job requirements</div>
                        </a>
                      </li>
                      <li class="menu-item">
                        <a href="../vertical-menu-template/" class="menu-link" target="_blank">
                          <i class="menu-icon tf-icons ti ti-moneybag"></i>
                          <div data-i18n="Monitor job budgets">Monitor job budgets</div>
                        </a>
                      </li>
                      <li class="menu-item {{ request()->routeIs('admin.jobs.application.process') ? 'active' : '' }}">
                        <a href="{{ route('admin.jobs.application.process') }}" class="menu-link">
                          <i class="menu-icon tf-icons ti ti-certificate"></i>
                          <div data-i18n="Job Applications"> User Applied For Job Application</div>
                        </a>
                      </li>
                    </ul>
                  </li>

                  <li class="menu-item">
                    <a href="javascript:void(0)" class="menu-link menu-toggle">
                      <i class="menu-icon tf-icons ti ti-messages"></i>
                      <div data-i18n="Messaging / Communication">Messaging / Communication</div>
                    </a>
                    <ul class="menu-sub">
                      <li class="menu-item">
                        <a href="" class="menu-link">
                          <i class="menu-icon tf-icons ti ti-file-text"></i>
                          <div data-i18n="Create contract templates">Create contract templates</div>
                        </a>
                      </li>
                      <li class="menu-item">
                        <a href="" class="menu-link" target="_blank">
                          <i class="menu-icon tf-icons ti ti-message-circle"></i>
                          <div data-i18n="Chat with contractors">Chat with contractors</div>
                        </a>
                      </li>
                      <li class="menu-item">
                        <a href="../vertical-menu-template/" class="menu-link" target="_blank">
                          <i class="menu-icon tf-icons ti ti-files"></i>
                          <div data-i18n="Share documents">Share documents</div>
                        </a>
                      </li>
                      <li class="menu-item">
                        <a href="../vertical-menu-template/" class="menu-link" target="_blank">
                          <i class="menu-icon tf-icons ti ti-bell"></i>
                          <div data-i18n="Notifications center">Notifications center</div>
                        </a>
                      </li>
                    </ul>
                  </li>

                  <li class="menu-item {{ request()->routeIs('admin.user*') ? 'active' : '' }}">
                    <a href="javascript:void(0)" class="menu-link menu-toggle">
                      <i class="menu-icon tf-icons ti ti-users"></i>
                      <div data-i18n="User Management">User Management</div>
                    </a>
                    <ul class="menu-sub">
                      <li class="menu-item {{ request()->routeIs('admin.user.index') ? 'active' : '' }}">
                        <a href="{{route('admin.user.index')}}" class="menu-link">
                          <i class="menu-icon tf-icons ti ti-users-group"></i>
                          <div data-i18n="View all Admins & Users">View all Admins & Users</div>
                        </a>
                      </li>
                      <li class="menu-item ">
                        <a href="../vertical-menu-template/" class="menu-link" target="_blank">
                          <i class="menu-icon tf-icons ti ti-user-x"></i>
                          <div data-i18n="Approve/Block accounts">Approve/Block accounts</div>
                        </a>
                      </li>
                      <li class="menu-item">
                        <a href="../vertical-menu-template/" class="menu-link" target="_blank">
                          <i class="menu-icon tf-icons ti ti-user-shield"></i>
                          <div data-i18n="Assign roles (Admin/User)">Assign roles (Admin/User)</div>
                        </a>
                      </li>
                      <li class="menu-item">
                        <a href="../vertical-menu-template/" class="menu-link" target="_blank">
                          <i class="menu-icon tf-icons ti ti-user-plus"></i>
                          <div data-i18n="Invite Admins">Invite Admins</div>
                        </a>
                      </li>
                    </ul>
                  </li>

                  <li class="menu-item">
                    <a href="javascript:void(0)" class="menu-link menu-toggle">
                      <i class="menu-icon tf-icons ti ti-id-badge"></i>
                      <div data-i18n="Contractor Management">Contractor Management</div>
                    </a>
                    <ul class="menu-sub">
                      <li class="menu-item">
                        <a href="../vertical-menu-template/" class="menu-link">
                          <i class="menu-icon tf-icons ti ti-users"></i>
                          <div data-i18n="View all contractors">View all contractors</div>
                        </a>
                      </li>
                      <li class="menu-item">
                        <a href="../vertical-menu-template/" class="menu-link" target="_blank">
                          <i class="menu-icon tf-icons ti ti-file-certificate"></i>
                          <div data-i18n="Verify documents/certifications">Verify documents/certifications</div>
                        </a>
                      </li>
                      <li class="menu-item">
                        <a href="" class="menu-link" target="_blank">
                          <i class="menu-icon tf-icons ti ti-star-half"></i>
                          <div data-i18n="Monitor ratings & performance">Monitor ratings & performance</div>
                        </a>
                      </li>
                    </ul>
                  </li>

                  <li class="menu-item">
                    <a href="javascript:void(0)" class="menu-link menu-toggle">
                      <i class="menu-icon tf-icons ti ti-receipt-2"></i>
                      <div data-i18n="Payments & Invoicing">Payments & Invoicing</div>
                    </a>
                    <ul class="menu-sub">
                      <li class="menu-item">
                        <a href="" class="menu-link">
                          <i class="menu-icon tf-icons ti ti-send"></i>
                          <div data-i18n="Contractor payouts">Contractor payouts</div>
                        </a>
                      </li>
                      <li class="menu-item ">
                        <a href="" class="menu-link">
                          <i class="menu-icon tf-icons ti ti-history"></i>
                          <div data-i18n="Admin payment history">Admin payment history</div>
                        </a>
                      </li>
                      <li class="menu-item">
                        <a href="" class="menu-link">
                          <i class="menu-icon tf-icons ti ti-percent"></i>
                          <div data-i18n="Commission settings">Commission settings</div>
                        </a>
                      </li>
                      <li class="menu-item" class="menu-link">
                          <i class="menu-icon tf-icons ti ti-report-money"></i>
                          <div data-i18n="Revenue reports">Revenue reports</div>
                        </a>
                      </li>
                    </ul>
                  </li>

                  <li class="menu-item">
                    <a href="javascript:void(0)" class="menu-link menu-toggle">
                      <i class="menu-icon tf-icons ti ti-settings"></i>
                      <div data-i18n="Site Settings">Site Settings</div>
                    </a>
                    <ul class="menu-sub">
                      <li class="menu-item">
                        <a href="" class="menu-link">
                          <i class="menu-icon tf-icons ti ti-paint"></i>
                          <div data-i18n="Platform branding">Platform branding</div>
                        </a>
                      </li>
                      <li class="menu-item">
                        <a href="" class="menu-link">
                          <i class="menu-icon tf-icons ti ti-bell-ringing"></i>
                          <div data-i18n="Global notification settings">Global notification settings</div>
                        </a>
                      </li>
                      <li class="menu-item ">
                        <a href="" class="menu-link">
                          <i class="menu-icon tf-icons ti ti-mail"></i>
                          <div data-i18n="System emails/SMS">System emails/SMS</div>
                        </a>
                      </li>
                    </ul>
                  </li>

                  <li class="menu-item">
                    <a href="javascript:void(0)" class="menu-link menu-toggle">
                      <i class="menu-icon tf-icons ti ti-chart-pie"></i>
                      <div data-i18n="Reports">Reports</div>
                    </a>
                    <ul class="menu-sub">
                      <li class="menu-item">
                        <a href="" class="menu-link">
                          <i class="menu-icon tf-icons ti ti-clipboard-check"></i>
                          <div data-i18n="Job completion report">Job completion report</div>
                        </a>
                      </li>
                      <li class="menu-item">
                        <a href="" class="menu-link">
                          <i class="menu-icon tf-icons ti ti-wallet"></i>
                          <div data-i18n="Payment report">Payment report</div>
                        </a>
                      </li>
                      <li class="menu-item">
                        <a href="" class="menu-link">
                          <i class="menu-icon tf-icons ti ti-users-group"></i>
                          <div data-i18n="Contractor performance">Contractor performance</div>
                        </a>
                      </li>
                      <li class="menu-item">
                        <a href="" class="menu-link">
                          <i class="menu-icon tf-icons ti ti-clipboard-list"></i>
                          <div data-i18n="Platform usage logs">Platform usage logs</div>
                        </a>
                      </li>
                    </ul>
                  </li>
                </ul>
              </div>
            </aside>
            @else
             <aside id="layout-menu" class="layout-menu-horizontal menu-horizontal menu bg-menu-theme flex-grow-0">
              <div class="container-xxl d-flex h-100">
                <ul class="menu-inner pb-2 pb-xl-0">
                  <!-- Dashboards -->
                  <li class="menu-item active">
                    <a href="javascript:void(0)" class="menu-link">
                      <i class="menu-icon tf-icons ti ti-smart-home"></i>
                      <div data-i18n="Work">Work</div>
                    </a>
                  </li>

                  <!-- Layouts -->
                  <li class="menu-item {{ request()->routeIs('user.recuitments.view') ? 'active' : '' }}">
                    <a href="{{ route('user.recuitments.view') }}" class="menu-link">
                      <i class="menu-icon tf-icons ti ti-user"></i>
                      <div data-i18n="Recruitment">Recruitments</div>
                    </a>
                  </li>

                  <!-- Apps -->
                  <li class="menu-item">
                    <a href="javascript:void(0)" class="menu-link menu-toggle">
                      <i class="menu-icon tf-icons ti ti-layout-grid-add"></i>
                      <div data-i18n="Insight">Insights</div>
                    </a>
                    <ul class="menu-sub">
                      <li class="menu-item">
                        <a href="app-email.html" class="menu-link">
                          <i class="menu-icon tf-icons ti ti-mail"></i>
                          <div data-i18n="Work Order Report">Work Order Report</div>
                        </a>
                      </li>
                      <li class="menu-item">
                        <a href="app-chat.html" class="menu-link">
                          <i class="menu-icon tf-icons ti ti-messages"></i>
                          <div data-i18n="Additional Charge Report">Additional Charge Report</div>
                        </a>
                      </li>
                    </ul>
                  </li>
                 
                </ul>
              </div>
            </aside>
            @endif