<?php
  session_start();

  $pageTitle = "Lecturer Meeting Time Slot | Etutor";
  $customCssFile = '../Styles/lecture_meeting.css';

  include('../Header/head.php');
  include('../Header/Lecturer_navibar.html');

  include('../DatabaseConnection.php');
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
        <button type="submit" class="btn btn-primary" onclick="return validateTimeSlot()">Add Time Slot</button>
        </form>

        <h2 class="mt-5">Time Slots</h2>
            <table class="table mt-4">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Start Date and Time</th>
                        <th>End Date and Time</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $lecture_id = $_SESSION['Lecturer_Id'];
                    $sql = "SELECT * FROM time_slot WHERE lecture_id = $lecture_id";
                    $result = $conn->query($sql);

                    // Counter variable for numbering rows
                    $rowNumber = 1;

                    if ($result->num_rows > 0) {
                        // Output data of each row
                        while ($row = $result->fetch_assoc()) {
                    ?>
                    <tr>
                        <td><?php echo $rowNumber; ?></td>
                        <td><?php echo $row["start_time"]; ?></td>
                        <td><?php echo $row["end_time"]; ?></td>
                        <td><button class="btn btn-primary" onclick="editTimeSlot(<?php echo $row['time_slot_id']; ?>, '<?php echo $row['start_time']; ?>', '<?php echo $row['end_time']; ?>')">Edit</button></td>
                    </tr>
                    <?php
                        // Increment the row number for the next iteration
                        $rowNumber++;
                        }
                    } else {
                        echo "<tr><td colspan='3'>No time slots found</td></tr>";
                    }
                    // Close connection
                    $conn->close();
                    ?>

                </tbody>
            </table>




<!-- Modal for editing time slot -->
<div id="editModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <h2>Edit Time Slot</h2>
        <form id="editForm" action="lecturer_update_timeslot.php" method="post" onsubmit="return validateUpdateTimeSlot()">
            <div class="form-group">
                <label for="startDateTime">Start Date and Time:</label>
                <input type="datetime-local" id="editStartDateTime" name="startDateTime" class="form-control" min="<?php echo date('Y-m-d\TH:i'); ?>" required>
            </div>
            <div class="form-group">
                <label for="endDateTime">End Date and Time:</label>
                <input type="datetime-local" id="editEndDateTime" name="endDateTime" class="form-control" min="<?php echo date('Y-m-d\TH:i'); ?>" required>
            </div>
            <!-- You can include any other fields you want to edit -->
            <input type="hidden" id="editTimeSlotId" name="timeSlotId">
            <button type="submit" class="btn btn-primary">Update Time Slot</button>
        </form>
    </div>
</div>



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


function validateUpdateTimeSlot() {
    var startDateTime = new Date(document.getElementById("editStartDateTime").value);
    var endDateTime = new Date(document.getElementById("editEndDateTime").value);

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


// Get the modal
var modal = document.getElementById('editModal');

// Function to open the modal and populate form fields with time slot data
function editTimeSlot(timeSlotId, startDateTime, endDateTime) {
    document.getElementById('editStartDateTime').value = startDateTime;
    document.getElementById('editEndDateTime').value = endDateTime;
    document.getElementById('editTimeSlotId').value = timeSlotId;
    modal.style.display = "block";
}

// Function to close the modal
function closeModal() {
    modal.style.display = "none";
}

// Close the modal if the user clicks outside of it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>

</body>
</html>