<!-- courses.php -->
<?php
  $pageTitle = "Program";
  $customCssFile = '../Styles/program.css';
  // For testing purposes, simulate a user role (replace with actual logic when backend is ready)
  $userRole = 'student';
  include('../Header/head.php');
  include('../Header/header.html');
?>

<body>
<div class="courses-container mt-4">
<?php
    // Check user role and display role-specific content
    if ($userRole === 'student') {
      include('student_program_content.php');
    } elseif ($userRole === 'teacher') {
      include('teacher_courses_content.php');
    }
?>
</div>
</body>
</html>