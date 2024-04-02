<?php
session_start();
include('../DatabaseConnection.php');


$lecture_id = $_SESSION['Lecturer_Id'];
$startDateTime = $_POST['startDateTime'];
$endDateTime = $_POST['endDateTime'];

// Prepare SQL statement for insertion
$sql = "INSERT INTO time_slot (lecture_id, start_time, end_time) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);

// Bind parameters
$stmt->bind_param("sss", $lecture_id, $startDateTime, $endDateTime);

// Execute the statement
if ($stmt->execute()) {
    // Redirect with success message
    header("Location: lecturer_add_timeslot.php?success=Time slot added successfully.");
    exit();
} else {
    // Redirect with error message
    header("Location: lecturer_add_timeslot.php?error=Database error occurred.");
    exit();
}

// Close the connection
$conn->close();

?>