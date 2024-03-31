<?php

session_start();
include('../DatabaseConnection.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve student ID from session
    $student_id = $_SESSION['Student_Id'];
    
    // Retrieve selected time slot ID from the form
    $time_slot_id = $_POST['timeSlot'];

    // Insert the meeting request into the database
    $sql = "INSERT INTO meeting (student_id, time_slot_id) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $student_id, $time_slot_id);

    if ($stmt->execute()) {
        // Meeting request successfully saved
        $successMessage = "Meeting request submitted successfully.";
    } else {
        // Error occurred while saving meeting request
        $errorMessage = "Error: Failed to submit meeting request.";
    }

    // Close the database connection
    $conn->close();
}


// Redirect back to the meeting page with appropriate message
if (isset($successMessage)) {
    header("Location: student_meeting.php?success=" . urlencode($successMessage));
    exit();
} elseif (isset($errorMessage)) {
    header("Location: student_meeting.php?error=" . urlencode($errorMessage));
    exit();
} else {
    // No success or error message, redirect to meeting page
    header("Location: student_meeting.php");
    exit();
}


?>