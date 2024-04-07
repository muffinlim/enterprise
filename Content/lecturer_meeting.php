<?php
  session_start();

  $pageTitle = "Lecturer Meeting  | Etutor";
  $customCssFile = '../Styles/student_meeting.css';

  include('../Header/head.php');
  include('../Header/Lecturer_navibar.html');
  include('../DatabaseConnection.php');

  $lecturer_id = $_SESSION['Lecturer_Id'];

  // Fetch all student meetings for the lecturer from the database
  $sql = "SELECT m.meeting_id, m.meeting_link, m.recorded_meeting_link, t.start_time, t.end_time, s.Student_Name
          FROM meeting m
          INNER JOIN time_slot t ON m.time_slot_id = t.time_slot_id
          INNER JOIN student s ON m.student_id = s.student_id
          INNER JOIN group_student_lecturer gsl ON m.student_id = gsl.Student_Id
          WHERE gsl.Lecturer_Id = ?
          ORDER BY m.created_at DESC";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $lecturer_id);
  $stmt->execute();
  $result = $stmt->get_result();
?>

<?php
// Check for success or error messages in the URL
$successMessage = isset($_GET['success']) ? $_GET['success'] : '';
$errorMessage = isset($_GET['error']) ? $_GET['error'] : '';

// Display success message if it exists
if (!empty($successMessage)) {
    echo '<div class="alert alert-success">' . htmlspecialchars($successMessage) . '</div>';
}

// Display error message if it exists
if (!empty($errorMessage)) {
    echo '<div class="alert alert-danger">' . htmlspecialchars($errorMessage) . '</div>';
}
?>


<body>
<div class="meeting-container">
    <div class="container">
        <h2 class="mt-5">Lecturer - View All Student Meeting</h2>
        <div class="meeting-list mt-5">
          <h2>Student Meeting Lists</h2>
          <?php
          // Check if any meetings are found
          if ($result->num_rows > 0) {
              // Display meetings
              echo '<ul class="meeting-ul">';
              while ($row = $result->fetch_assoc()) {
                  echo '<li class="meeting-li">';
                  echo 'Student Name: ' . $row['Student_Name'] . '<br>';
                  echo isset($row['meeting_link']) ? '<a href="' . $row['meeting_link'] . '">Join Meeting</a><br>' : '';
                ?>
                <?php
                  $value = isset($row['recorded_meeting_link']) ? $row['recorded_meeting_link'] : '';
                  $placeholder = !empty($value) ? $value : 'Enter recorded meeting link';
                ?>
                  <!-- Form to upload recorded meeting link -->
                    <form action="lecturer_upload_recorded_meeting.php" method="post">
                        <input type="hidden" name="meeting_id" value="<?php echo $row['meeting_id']; ?>">
                        <div class="form-group">
                            <label for="recordedMeetingLink">Upload Recorded Meeting Link:</label>
                            <input type="text" id="recordedMeetingLink" name="recordedMeetingLink" class="form-control" value="<?php echo $value ?>" placeholder="<?php echo $placeholder; ?>" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Upload Recorded Meeting</button>
                    </form>
                <?php
                  echo 'Time Slot: ' . $row['start_time'] . ' - ' . $row['end_time'] . '<br>';
                  echo '</li>';
              }
              echo '</ul>';
          } else {
              // No meetings found for the lecturer
              echo '<div class="container mt-5">';
              echo '<h2>No Meetings Found</h2>';
              echo '</div>';
          }
          ?>
        </div>

    </div>

</div>



</body>
</html>