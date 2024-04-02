<?php

  $pageTitle = "Admin | Dashboard";
  $customCssFile = '../Styles/student_dashboard.css';

  include('../Header/head.php');
  include('../Header/admin_navibar.html');
  
?>
<h2>Admin Dashboard</h2>
<div class="row">
    <div class="col-md-4">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Total Courses</h5>
          <p class="card-text">10</p>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Total Students</h5>
          <p class="card-text">150</p>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Recent Notifications</h5>
          <ul>
            <li>New course added.</li>
            <li>Upcoming event on...</li>
          </ul>
        </div>
      </div>
    </div>
  </div>

  <!-- More dashboard content can be added here -->