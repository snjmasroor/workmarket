@extends('layouts.backend.master')
@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<style>
  .container {
    display: flex;
    width: 100%;
    max-width: 1200px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
    overflow: hidden; /* For rounded corners */
}

/* Sidebar Styling */
.sidebar {
    width: 300px;
    padding: 30px;
    border-right: 1px solid #eee;
}

.sidebar h3 {
    margin-top: 0;
    margin-bottom: 15px;
    color: #333;
    font-size: 1.1em;
}

.sidebar .input-group {
    position: relative;
    margin-bottom: 20px;
}

.sidebar .input-group input {
    width: calc(100% - 40px); /* Adjust for icon padding */
    padding: 10px 10px 10px 35px;
    border: 1px solid #ddd;
    border-radius: 5px;
    font-size: 0.9em;
}

.sidebar .input-group i {
    position: absolute;
    left: 10px;
    top: 50%;
    transform: translateY(-50%);
    color: #888;
}

.sidebar .radius-slider p {
    font-size: 0.9em;
    color: #555;
    margin-bottom: 10px;
}

.sidebar .slider {
    width: 100%;
    -webkit-appearance: none;
    height: 8px;
    border-radius: 5px;
    background: #d3d3d3;
    outline: none;
    opacity: 0.7;
    -webkit-transition: .2s;
    transition: opacity .2s;
}

.sidebar .slider::-webkit-slider-thumb {
    -webkit-appearance: none;
    appearance: none;
    width: 20px;
    height: 20px;
    border-radius: 50%;
    background: #007bff; /* Blue color for thumb */
    cursor: pointer;
}

.sidebar .slider::-moz-range-thumb {
    width: 20px;
    height: 20px;
    border-radius: 50%;
    background: #007bff;
    cursor: pointer;
}

.sidebar .range-value {
    display: block;
    text-align: center;
    margin-top: 10px;
    font-weight: bold;
    color: #007bff;
}

.sidebar .select-group {
    position: relative;
    margin-bottom: 20px;
}

.sidebar .select-group select {
    width: 100%;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 5px;
    background-color: #fff;
    appearance: none; /* Remove default arrow */
    -webkit-appearance: none;
    -moz-appearance: none;
    font-size: 0.9em;
    cursor: pointer;
}

.sidebar .select-group i {
    position: absolute;
    right: 15px;
    top: 50%;
    transform: translateY(-50%);
    color: #888;
    pointer-events: none; /* Make icon unclickable */
}

.sidebar .job-type-section label {
    display: block;
    margin-bottom: 10px;
    cursor: pointer;
    font-size: 0.9em;
    color: #555;
}

/* Custom Radio Buttons */
.radio-container {
    display: block;
    position: relative;
    padding-left: 25px;
    margin-bottom: 12px;
    cursor: pointer;
    font-size: 1em;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}

.radio-container input {
    position: absolute;
    opacity: 0;
    cursor: pointer;
    height: 0;
    width: 0;
}

.checkmark {
    position: absolute;
    top: 0;
    left: 0;
    height: 18px;
    width: 18px;
    background-color: #eee;
    border-radius: 50%;
}

.radio-container:hover input ~ .checkmark {
    background-color: #ccc;
}

.radio-container input:checked ~ .checkmark {
    background-color: #007bff;
}

.checkmark:after {
    content: "";
    position: absolute;
    display: none;
}

.radio-container input:checked ~ .checkmark:after {
    display: block;
}

.radio-container .checkmark:after {
    top: 6px;
    left: 6px;
    width: 6px;
    height: 6px;
    border-radius: 50%;
    background: white;
}


/* Main Content Styling */
.main-content {
    flex-grow: 1;
    padding: 30px;
}

.main-content .top-bar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
    padding-bottom: 15px;
    border-bottom: 1px solid #eee;
}

.main-content .show-jobs {
    font-size: 1em;
    color: #555;
}

.main-content .show-jobs strong {
    color: #333;
}

.main-content .sort-filter-group {
    display: flex;
    gap: 15px;
}

.dropdown {
    position: relative;
    display: inline-block;
}

.dropbtn {
    background-color: #f0f0f0;
    color: #333;
    padding: 10px 15px;
    border: 1px solid #ddd;
    border-radius: 5px;
    cursor: pointer;
    font-size: 0.9em;
    display: flex;
    align-items: center;
    gap: 5px;
}

.dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
    border-radius: 5px;
    overflow: hidden;
    margin-top: 5px;
}

.dropdown-content a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
    font-size: 0.9em;
}

.dropdown-content a:hover {
    background-color: #f1f1f1;
}

.dropdown:hover .dropdown-content {
    display: block;
}


/* Job Card Styling */
.job-card {
    background-color: #fff;
    border: 1px solid #eee;
    border-radius: 8px;
    padding: 20px;
    margin-bottom: 20px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
}

.job-card .job-header {
    display: flex;
    align-items: center;
    margin-bottom: 15px;
}

.job-card .company-logo {
    width: 50px;
    height: 50px;
    border-radius: 8px;
    overflow: hidden;
    margin-right: 15px;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #f0f0f0; /* Placeholder background */
}

.job-card .company-logo img {
    max-width: 100%;
    max-height: 100%;
    display: block;
}

.job-card .job-title-info {
    flex-grow: 1;
}

.job-card .job-title-info h4 {
    margin: 0 0 5px 0;
    font-size: 1.1em;
    color: #333;
}
.job-card .job-title-info a:hover{
    margin: 0 0 5px 0;
    font-size: 1.1em;
    color: #6215f1;
}

.job-card .job-meta {
    display: flex;
    gap: 15px;
    font-size: 0.85em;
    color: #777;
}

.job-card .job-meta i {
    margin-right: 5px;
}

.job-card .job-salary {
    display: flex;
    align-items: center;
    gap: 10px;
    font-weight: bold;
    color: #007bff;
    font-size: 1em;
}

.job-card .bookmark-icon {
    font-size: 1.2em;
    color: #ccc;
    cursor: pointer;
}

.job-card .bookmark-icon:hover {
    color: #007bff;
}

.job-card .job-tags {
    display: flex;
    gap: 10px;
}

.job-card .tag {
    padding: 5px 12px;
    border-radius: 20px;
    font-size: 0.8em;
    font-weight: bold;
    text-transform: capitalize;
}

.job-card .tag.full-time {
    background-color: #e6f7ff;
    color: #007bff;
}

.job-card .tag.freelancer {
    background-color: #e6f7ff;
    color: #007bff;
}

.job-card .tag.temporary {
    background-color: #e6f7ff;
    color: #007bff;
}

.job-card .tag.private {
    background-color: #f0f8f3;
    color: #4CAF50; /* Green */
}

.job-card .tag.urgent {
    background-color: #fff0e6;
    color: #ff9800; /* Orange */
}

/* Responsive Design (Basic) */
@media (max-width: 992px) {
    .container {
        flex-direction: column;
        padding: 0;
    }

    .sidebar {
        width: 100%;
        border-right: none;
        border-bottom: 1px solid #eee;
    }
}

@media (max-width: 768px) {
    .main-content .top-bar {
        flex-direction: column;
        align-items: flex-start;
        gap: 10px;
    }

    .main-content .sort-filter-group {
        width: 100%;
        justify-content: space-around;
    }

    .job-card .job-header {
        flex-wrap: wrap;
        gap: 10px;
    }

    .job-card .job-salary {
        margin-left: auto; /* Push salary to the right */
    }
}

@media (max-width: 480px) {
    .sidebar, .main-content {
        padding: 20px;
    }

    .job-card .job-meta {
        flex-direction: column;
        gap: 5px;
    }

    .job-card .job-tags {
        flex-wrap: wrap;
    }
}
</style>
@endpush
@section('page-content')
<div class="container">
  <aside class="sidebar">
      <section class="search-by-keywords">
          <h3>Search by Keywords</h3>
          <div class="input-group">
              <i class="fas fa-search"></i>
              <input type="text" placeholder="Job title, keywords, or company">
          </div>
      </section>

      <section class="location-filter">
          <h3>Location</h3>
          <div class="input-group">
              <i class="fas fa-map-marker-alt"></i>
              <input type="text" placeholder="City or postcode">
          </div>
          <div class="radius-slider">
              <p>Radius around selected destination</p>
              <input type="range" min="0" max="200" value="100" class="slider" id="myRange">
              <span class="range-value" id="rangeValue">100km</span>
          </div>
      </section>

      <section class="category-filter">
          <h3>Category</h3>
          <div class="select-group">
              <select>
                  <option>Choose a category</option>
                  <option>Software Development</option>
                  <option>Design</option>
                  <option>Marketing</option>
              </select>
              <i class="fas fa-chevron-down"></i>
          </div>
      </section>

      <section class="job-type-filter">
          <h3>Job type</h3>
          <label class="radio-container">Freelancer
              <input type="radio" checked="checked" name="jobtype">
              <span class="checkmark"></span>
          </label>
          <label class="radio-container">Full Time
              <input type="radio" name="jobtype">
              <span class="checkmark"></span>
          </label>
          <label class="radio-container">Part Time
              <input type="radio" name="jobtype">
              <span class="checkmark"></span>
          </label>
          <label class="radio-container">Temporary
              <input type="radio" name="jobtype">
              <span class="checkmark"></span>
          </label>
      </section>
    </aside>

  <main class="main-content">
      <section class="job-listing-header">
          <div class="top-bar">
              <span class="show-jobs">Show <strong>10</strong> jobs</span>
              <div class="sort-filter-group">
                  <div class="dropdown">
                      <button class="dropbtn">Sort by (default) <i class="fas fa-chevron-down"></i></button>
                      <div class="dropdown-content">
                          <a href="#">Date posted</a>
                          <a href="#">Relevance</a>
                      </div>
                  </div>
                  <div class="dropdown">
                      <button class="dropbtn">All <i class="fas fa-chevron-down"></i></button>
                      <div class="dropdown-content">
                          <a href="#">Full Time</a>
                          <a href="#">Freelancer</a>
                      </div>
                  </div>
              </div>
          </div>
      </section>

      <section class="job-listings-results">
         

          </section>
  </main>
</div>
@endsection
@push('scripts')
<script>
  let currentPage = 1;
  const allJobsUrl = "{{ route('user.data.all.jobs') }}";
document.addEventListener("DOMContentLoaded", function () {
    fetchJobs();

    function fetchJobs() {
      fetch(`${allJobsUrl}`)
      .then(res => res.json())
            .then(response => {
                const jobs = response.data; // Extract jobs from 'data' key
                const container = document.querySelector('.job-listings-results');
                container.innerHTML = ''; // Clear old content
                var jobLocation;
                var salary;
                
                jobs.forEach(job => {
                  if(job.onsite == true) {
                    jobLocation = job.city;
                  }
                  if(job.fixed == true)
                    salary = job.fixed_rate;
                  else
                  salary = job.rate_per_hour;
                  const jobRouteBase = "{{ url('/user/view-jobs') }}";
                  var jobSingleURL = `${jobRouteBase}/${job.id}`;
                    const jobCard = `
                        <article class="job-card">
                            <div class="job-header">
                                <div class="job-title-info">
                                  
                                    <a href = "${jobSingleURL}"><h4>${job.title}</h4></a>
                                    <div class="job-meta">
                                        <span><i class="fas fa-building"></i> ${job.industry.name ?? 'N/A'}</span>
                                        <span><i class="fas fa-map-marker-alt"></i> ${jobLocation ?? 'Remote'}</span>
                                        <span><i class="fas fa-clock"></i> ${formatTimeAgo(job.created_at)}</span>
                                        <span><i class="fas fa-sack-dollar"></i> ${salary}</span>
                                    </div>
                                  
                                </div>
                            </div>
                            <div class="job-tags">
                                <span class="tag bg-primary">${job.job_type ?? 'Other'}</span>
                                <span class="tag private">Private</span>
                                ${job.flags === 4 ? '<span class="tag urgent">Urgent</span>' : ''}
                            </div>
                        </article>
                    `;
                    container.insertAdjacentHTML('beforeend', jobCard);
                });
            })
            .catch(error => {
                console.error("Error fetching jobs:", error);
            });
    }

    function formatTimeAgo(dateString) {
        const postedDate = new Date(dateString);
        const now = new Date();
        const diffMs = now - postedDate;
        const hours = Math.floor(diffMs / 1000 / 60 / 60);
        if (hours < 24) return `${hours} hours ago`;
        const days = Math.floor(hours / 24);
        return `${days} day${days > 1 ? 's' : ''} ago`;
    }
});
</script>
@endpush