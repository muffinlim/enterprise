<!-- profile.php -->
<?php
  $pageTitle = "Profile";
  $customCssFile = '../Styles/profile.css';
  // For testing purposes, simulate a user role (replace with actual logic when backend is ready)
  $userRole = 'student';
  include('../Header/head.php');
  include('../Header/header.html');
?>
<body>
<div class="profile-container mt-4">
<?php
    // Check user role and display role-specific content
    if ($userRole === 'student') {
      include('student_profile_content.php');
    } elseif ($userRole === 'teacher') {
      include('teacher_profile_content.php');
    }elseif ($userRole === 'admin') {
        include('admin_profile_content.php');
      }
?>
</div>
</body>
</html>