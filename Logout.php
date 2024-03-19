<!-- logout.php -->

<?php
  // Start the session
  session_start();

  // Unset all session variables
  $_SESSION = array();

  // Destroy the session
  session_destroy();

  // Redirect to the login page
  header("Location: student_login.php");
  exit();
?>
