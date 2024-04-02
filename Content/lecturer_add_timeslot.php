<!-- admin_register_user.php -->
<?php
  $pageTitle = "Lecturer Meeting Time Slot | Etutor";
  $customCssFile = '../Styles/student_meeting.css';

  include('../Header/head.php');
  include('../Header/Lecturer_navibar.html');
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
        <h2 class="mt-5">Lecturer - Add Meeting Time Slot</h2>
        <form action="lecturer_save_timeslot.php" method="post" class="mt-4">
        <div class="form-group">
            <label for="startDateTime">Start Date and Time:</label>
            <input type="datetime-local" id="startDateTime" name="startDateTime" class="form-control" min="<?php echo date('Y-m-d\TH:i'); ?>" required>
        </div>
        <div class="form-group">
            <label for="endDateTime">End Date and Time:</label>
            <input type="datetime-local" id="endDateTime" name="endDateTime" class="form-control" min="<?php echo date('Y-m-d\TH:i'); ?>" required>
        </div>
        <button type="submit" class="btn btn-primary" onclick="validateTimeSlot()">Add Time Slot</button>
        </form>
    </div>


</div>


<script>
function validateTimeSlot() {
    var startDateTime = new Date(document.getElementById("startDateTime").value);
    var endDateTime = new Date(document.getElementById("endDateTime").value);

    // Check if startDateTime is after endDateTime
    if (startDateTime >= endDateTime) {
        alert("End date and time must be after start date and time.");
        return false; // Prevent form submission
    }

    // Calculate the duration in minutes
    var durationInMinutes = (endDateTime - startDateTime) / (1000 * 60);

    // Check if duration is less than 30 minutes
    if (durationInMinutes < 30) {
        alert("Meeting duration must be at least 30 minutes.");
        return false; // Prevent form submission
    }

    // If validation passes, allow form submission
    return true;
}
</script>

</body>
</html>