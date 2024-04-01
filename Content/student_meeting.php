<!-- meeting.php -->
<?php
  session_start();

  $pageTitle = "Student Meeting | Etutor";
  $customCssFile = '../Styles/student_meeting.css';

  include('../Header/head.php');
  include('../Header/student_navibar.html');
  include('../DatabaseConnection.php');

  $student_id = $_SESSION['Student_Id'];

  $sql = "SELECT l.Lecturer_Name 
          FROM group_student_lecturer gsl
          INNER JOIN lecturer l ON gsl.Lecturer_Id = l.Lecturer_Id
          WHERE gsl.student_id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $student_id);
  $stmt->execute();
  $result = $stmt->get_result();

  // Store fetched lecture ID in a variable
  if ($row = $result->fetch_assoc()) {
    $student_lecture_name = $row['Lecturer_Name'];
  } else {
    // If no lecture ID found for the student, handle the error accordingly
    echo "Error: Student does not belong to any lecture.";
    exit();
  }


  // Fetch time slots for the student's lecture from the database
  $sql = "SELECT * FROM time_slot WHERE lecture_id IN (SELECT gsl.Lecturer_Id FROM group_student_lecturer gsl WHERE gsl.student_id = ?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $student_id);
  $stmt->execute();
  $result = $stmt->get_result();

  // Store fetched time slots in an array
  $timeSlots = [];
  while ($row = $result->fetch_assoc()) {
      $timeSlots[$row['time_slot_id']] = $row['start_time'] . ' - ' . $row['end_time'];
  }


  // Fetch meetings for the student from the database
  $sql = "SELECT m.meeting_id, m.meeting_link, m.recorded_meeting_link, t.start_time, t.end_time
          FROM meeting m
          INNER JOIN time_slot t ON m.time_slot_id = t.time_slot_id
          WHERE m.student_id = ?
          ORDER BY m.created_at DESC";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $student_id);
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
  <h2 class="mt-5">Schedule Meeting with Lecture <?php echo $student_lecture_name; ?></h2>
  <form action="student_meeting_request.php" method="post" class="mt-4">
    <div class="form-group">
      <label for="timeSlot">Select Time Slot:</label>
      <select id="timeSlot" name="timeSlot" class="form-control">
        <?php
        // Display fetched time slots in the dropdown list
        foreach ($timeSlots as $timeSlotId => $timeSlot) {
            echo '<option value="' . $timeSlotId . '">' . htmlspecialchars($timeSlot) . '</option>';
        }
        ?>
      </select>
    </div>

    <div class="form-group">
      <label for="meetingLink">Provide Meeting Link:</label>
      <input type="text" id="meetingLink" name="meetingLink" class="form-control" placeholder="Enter meeting link" required>
    </div>
    
    <button type="submit" class="btn btn-primary">Schedule Meeting</button>
  </form>

<div class="meeting-list mt-5">
  <h2>Your Meetings List</h2>
  <?php
    // Check if any meetings are found
    if ($result->num_rows > 0) {
        // Display meetings
        echo '<ul class="meeting-ul">';
        while ($row = $result->fetch_assoc()) {
            echo '<li class="meeting-li">';
            echo 'Meeting ID: ' . $row['meeting_id'] . '<br>';
            echo isset($row['meeting_link']) ? '<a href="' . $row['meeting_link'] . '">Join Meeting</a><br>' : '';
            echo 'Recorded Meeting: ' . ($row['recorded_meeting_link'] ? '<a href="' . $row['recorded_meeting_link'] . '">Review Meeting</a><br>' : 'Not available <br>');
            echo 'Time Slot: ' . $row['start_time'] . ' - ' . $row['end_time'] . '<br>';
            echo '</li>';
        }
        echo '</ul>';
    } else {
        // No meetings found for the student
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