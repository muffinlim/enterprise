<?php
session_start();

// Include Database Connection
include('../DatabaseConnection.php');

// Process Form Submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $startDateTime = $_POST['startDateTime'];
    $endDateTime = $_POST['endDateTime'];
    $timeSlotId = $_POST['timeSlotId'];

    // Update the time slot record
    $sql = "UPDATE time_slot SET start_time='$startDateTime', end_time='$endDateTime' WHERE time_slot_id='$timeSlotId'";

    if ($conn->query($sql) === TRUE) {
        // Redirect back to the original page with success message
        header("Location: lecturer_add_timeslot.php?success=Time slot updated successfully");
        exit();
    } else {
        // Redirect back to the original page with error message
        header("Location: lecturer_add_timeslot.php?error=Error updating time slot: " . $conn->error);
        exit();
    }
} else {
    // Redirect back to the original page if accessed directly
    header("Location: lecturer_add_timeslot.php");
    exit();
}

// Close database connection
$conn->close();
?>