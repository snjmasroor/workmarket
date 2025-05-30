@extends('layouts.backend.master')

@section('page-content')
<style>
    .workfeed-brand {
      font-size: 1.8rem;
      font-weight: bold;
    }
    .brand-highlight {
      color: orange;
    }
    .search-filters {
      margin-top: 10px;
    }
    .search-message {
      color: red;
      font-size: 0.9rem;
      margin-top: 10px;
    }
    .search-box .btn {
      background-color: #f7941d;
    }
   .calendar-icon {
  width: 50px; /* Example: Small size for the icon */
  border-radius: 6px;
  overflow: hidden;
  box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
  flex-shrink: 0; /* Prevents the calendar from shrinking */
  margin-right: 15px; /* Space between calendar and job details */
}

.calendar-month {
  background-color: #007bff; /* Blue color */
  color: white;
  text-align: center;
  padding: 5px 0;
  font-size: 10px;
  font-weight: bold;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}

.calendar-day {
  background-color: #ffffff;
  color: #333;
  text-align: center;
  padding: 6px 0;
  font-size: 20px;
  font-weight: bold;
}

/* --- Main Container for the entire job listing row --- */
.job-listing-container {
  display: flex; /* Enables Flexbox for horizontal layout */
  align-items: center; /* Vertically centers items in the row */
  background-color: white;
  padding: 15px 20px;
  border-bottom: 1px solid #eee; /* Light separator line at the bottom */
  box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05); /* Subtle shadow for the whole row */
  font-family: Arial, sans-serif; /* Common font for consistency */
}

/* --- Job Details (Title and Meta) --- */
.job-details {
  flex-grow: 1; /* Allows this section to take up available space */
  display: flex;
  flex-direction: column; /* Stacks title and meta vertically */
  margin-right: 20px; /* Space between job details and actions */
}

.job-title {
  color: #007bff; /* Blue color for the heading */
  font-size: 18px; /* Adjust font size as needed */
  font-weight: bold;
  margin-bottom: 5px; /* Space between title and meta */
  white-space: nowrap; /* Prevent text from wrapping */
  overflow: hidden; /* Hide overflow if text is too long */
  text-overflow: ellipsis; /* Add ellipsis for overflowed text */
}

.job-meta {
  font-size: 12px;
  color: #666;
}

.job-meta span:not(:last-child) {
  margin-right: 15px; /* Space between individual meta items */
}

/* --- Job Actions (Social Icons and Apply Button) --- */
.job-actions {
  display: flex;
  align-items: center; /* Vertically aligns social icons and button */
  flex-shrink: 0; /* Prevents this section from shrinking */
}

.social-icons {
  display: flex;
  margin-right: 15px; /* Space between social icons and the Apply button */
}

.social-icon {
  display: inline-flex; /* Allows custom sizing and centering of content */
  align-items: center;
  justify-content: center;
  width: 28px; /* Size of the icon container */
  height: 28px;
  border: 1px solid #ddd; /* Light grey border */
  border-radius: 4px; /* Slightly rounded corners for the icon containers */
  margin-right: 5px; /* Space between individual social icons */
  text-decoration: none; /* Removes underline from links */
  transition: background-color 0.2s ease, border-color 0.2s ease;
}

.social-icon:last-child {
  margin-right: 0; /* No margin after the last social icon */
}

.social-icon img {
  width: 16px; /* Size of the actual icon image inside the container */
  height: 16px;
  display: block; /* Removes any default extra space below the image */
}

.social-icon.email-icon {
  border: 1px solid #007bff; /* Specific blue border for the email icon */
}

.social-icon:hover {
  background-color: #f0f2f5;
  border-color: #c9c9c9;
}

/* --- Apply Button --- */
.apply-button {
  background-color: #007bff; /* Blue background */
  color: white;
  padding: 10px 20px;
  border: none;
  border-radius: 4px; /* Rounded corners */
  font-size: 14px;
  font-weight: bold;
  cursor: pointer; /* Indicates it's clickable */
  text-transform: uppercase;
  transition: background-color 0.2s ease; /* Smooth hover effect */
}

.apply-button:hover {
  background-color: #0056b3; /* Darker blue on hover */
}
  </style>
<div class="container mt-5">
  <div class="search-box shadow-sm">
    <div class="mb-3">
      <span class="workfeed-brand">
        <span class="brand-highlight">Work</span>Feed<sup>™</sup>
      </span>
      <span class="ms-2">- Find Great Work Near You</span>
    </div>

    <div class="row g-2">
      <div class="col-md-3">
        <input type="text" class="form-control" placeholder="Title, Keyword, or Company">
      </div>
      <div class="col-md-3 d-flex">
        <button class="btn btn-outline-secondary" type="button">📍</button>
        <input type="text" class="form-control" placeholder="Virtual Location">
      </div>
      <div class="col-md-2 d-flex">
        <input type="text" class="form-control" value="60.00">
        <span class="input-group-text">mi</span>
      </div>
      <div class="col-md-3">
        <select class="form-select form-control">
          <option selected>Technology and Communications</option>
          <!-- Add more categories here -->
        </select>
      </div>
      <div class="col-md-1">
        <button class="btn btn-primary ">SEARCH</button>
      </div>
    </div>

    <div class="search-filters mt-2">
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="dateFilter" id="all" checked>
        <label class="form-check-label" for="all">All</label>
      </div>
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="dateFilter" id="today">
        <label class="form-check-label" for="today">Today</label>
      </div>
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="dateFilter" id="tomorrow">
        <label class="form-check-label" for="tomorrow">Tomorrow</label>
      </div>
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="dateFilter" id="next7">
        <label class="form-check-label" for="next7">Next 7 days</label>
      </div>
    </div>

    <div class="search-message">
     
      <div class="container">
        <div class="rows">
          <div class="col-md-6">
              <ul class="media-list">
                <hr>
                <li>
                  <div class="job-listing-container">
                    <div class="calendar-icon">
                      <div class="calendar-month">JUN</div>
                      <div class="calendar-day">2</div>
                    </div>

                    <div class="job-details">
                      <div class="job-title">
                        23053221436 - Xerox - Norwalk Boardroom - Noise Suppression Issue
                      </div>
                      <div class="job-meta">
                        <span>Norwalk, CT</span>
                        <span>$300.00</span>
                        <span>Posted moments ago</span>
                      </div>
                    </div>

                    <div class="job-actions">
                      <div class="social-icons">
                        <a href="#" class="social-icon">
                          <img src="https://img.icons8.com/ios-filled/24/000000/linkedin.png" alt="LinkedIn">
                        </a>
                        <a href="#" class="social-icon">
                          <img src="https://img.icons8.com/ios-filled/24/000000/facebook-new.png" alt="Facebook">
                        </a>
                        <a href="#" class="social-icon">
                          <img src="https://img.icons8.com/ios-filled/24/000000/twitter--v1.png" alt="Twitter">
                        </a>
                        <a href="#" class="social-icon email-icon">
                          <img src="https://img.icons8.com/ios-filled/24/000000/email-open.png" alt="Email">
                        </a>
                      </div>
                      <button class="apply-button">APPLY</button>
                    </div>
                  </div>
                  <hr>
                </li>
              </ul>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>
@endsection