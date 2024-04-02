<?php
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the meeting ID and recorded meeting link are provided
    if (isset($_POST["meeting_id"]) && isset($_POST["recordedMeetingLink"])) {
        // Include the database connection
        include('../DatabaseConnection.php');

        // Sanitize input data
        $meeting_id = mysqli_real_escape_string($conn, $_POST["meeting_id"]);
        $recordedMeetingLink = mysqli_real_escape_string($conn, $_POST["recordedMeetingLink"]);

        // Update the recorded meeting link in the database
        $sql = "UPDATE meeting SET recorded_meeting_link = ? WHERE meeting_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $recordedMeetingLink, $meeting_id);
        
        if ($stmt->execute()) {
            // Redirect back to the lecturer meeting page with success message
            header("Location: lecturer_meeting.php?success=Recorded meeting link uploaded successfully");
            exit();
        } else {
            // Redirect back to the lecturer meeting page with error message
            header("Location: lecturer_meeting.php?error=Failed to upload recorded meeting link");
            exit();
        }
    } else {
        // Redirect back to the lecturer meeting page with error message if data is missing
        header("Location: lecturer_meeting.php?error=Meeting ID or recorded meeting link is missing");
        exit();
    }
} else {
    // Redirect back to the lecturer meeting page if the form is not submitted
    header("Location: lecturer_meeting.php");
    exit();
}
?>

