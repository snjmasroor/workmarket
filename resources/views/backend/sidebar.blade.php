<div class="sidebar" id="sidebar">
            <div class="sidebar-inner slimscroll">
                <div id="sidebar-menu" class="sidebar-menu">
                    <ul>
                        <li class="menu-title">Talent Profile</li>
                        @auth
                        @if(auth()->user()->type === 'superadmin')
                            <!-- Show all links for super admin -->
                            <li class="submenu">
                           <a href="#"><i class="fa fa-user"></i> <span> Industry </span> <span class="menu-arrow"></span></a>
                            <ul style="display: none;">
								<li><a href="{{route('show.industry')}}">Show Industries</a></li>
								<li><a href="{{route('show.skills')}}">Skills</a></li>
								<li><a href="{{route('show.industry-skills')}}">Industry Skill</a></li>
							</ul>
                        </li>
                        <li class="submenu">
                           <a href="#"><i class="fa fa-user"></i> <span> Jobs </span> <span class="menu-arrow"></span></a>
                            <ul style="display: none;">
								<li><a href="{{route('show.jobs')}}">Show Jobs</a></li>
								<li><a href="{{route('show.skills')}}">Skills</a></li>
								<li><a href="{{route('show.industry-skills')}}">Industry Skill</a></li>
							</ul>
                        </li>
                        @elseif(auth()->user()->type === 'admin')
                            <!-- Show admin-specific links -->
                          <li class="submenu">
                           <a href="#"><i class="fa fa-user"></i> <span> Industry </span> <span class="menu-arrow"></span></a>
                            <ul style="display: none;">
								<li><a href="{{route('show.industry')}}">Show Industries</a></li>
								<li><a href="{{route('show.skills')}}">Skills</a></li>
								<li><a href="{{route('show.industry-skills')}}">Industry Skill</a></li>
							</ul>
                        </li>
                        <li class="submenu">
                           <a href="#"><i class="fa fa-user"></i> <span> Jobs </span> <span class="menu-arrow"></span></a>
                            <ul style="display: none;">
								<li><a href="{{route('show.jobs')}}">Show Jobs</a></li>
								<li><a href="{{route('show.skills')}}">Skills</a></li>
								<li><a href="{{route('show.industry-skills')}}">Industry Skill</a></li>
							</ul>
                        </li>
                        @else
                            <!-- Regular user links -->
                        <li class="active">
                            <a href="{{route('user.viewProfile')}}"><i class="fa fa-dashboard"></i> <span>My Profile {{ auth()->user()->type }}</span></a>
                        </li>
						<li>
                            <a href="doctors.html"><i class="fa fa-clipboard"></i> <span>Tests</span></a>
                        </li>
                        <li>
                            <a href="patients.html"><i class="fa fa-cloud"></i> <span>Labor Clouds</span></a>
                        </li>
                        <li class="menu-title">Work</li>
                        
                        <li>
                            <a href="calendar.html"><i class="fa fa-briefcase"></i> <span>My Work</span></a>
                        </li>
                        <li>
                            <a href="calendar.html"><i class="fa fa-wrench"></i> <span>Find Work</span></a>
                        </li>
                        <li>
                            <a href="calendar.html"><i class="fa fa-calendar"></i> <span>Calendar</span></a>
                        </li>
                        <li>
                            <a href="calendar.html"><i class="fa fa-star"></i> <span>Ratings</span></a>
                        </li>

                        <li class="menu-title">Payments</li>
                        <li>
                            <a href="calendar.html"><i class="fa fa-pie-chart"></i> <span>Overview</span></a>
                        </li>
                        <li>
                            <a href="calendar.html"><i class="fa fa-user"></i> <span>Accounts</span></a>
                        </li>
                        @endif
                    @endauth
                       
                    </ul>
                </div>
            </div>
        </div>