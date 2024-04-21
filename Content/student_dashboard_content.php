<?php
$pageTitle = "Student | Dashboard";
$customCssFile = '../Styles/Studentprofile.css';
session_start();
$Student_Id=$_SESSION['Student_Id'];

include('../Header/head.php');
include('../Header/Student_navibar.html');
include('../DatabaseConnection.php');
$successMessage = isset($_GET['success']) ? $_GET['success'] : '';
$errorMessage = isset($_GET['error']) ? $_GET['error'] : '';





$sql = "SELECT program.Program_Id, program.Program_name FROM program INNER JOIN student ON program.Program_Id = student.Program_Id WHERE student.Student_Id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $Student_Id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo "<div class='card'>";
    echo "<div class='card-body'>";
    echo "<h5 class='card-title'>Program ID: " . $row["Program_Id"] . "</h5>";
    echo "<h5 class='card-text'>Program Name: " . $row["Program_name"] . "</h5>";

    // Fetch the grouped lecturer name for the logged-in student
    $sql = "SELECT lecturer.Lecturer_Name
            FROM group_student_lecturer
            INNER JOIN lecturer ON group_student_lecturer.Lecturer_Id = lecturer.Lecturer_Id
            WHERE group_student_lecturer.Student_Id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $Student_Id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Output the grouped lecturer name
        $row = $result->fetch_assoc();
        echo "<h5 class='card-title'>Grouped Lecturer Name: " . $row["Lecturer_Name"] . "</h5>";
    } else {
        echo "<p class='card-text'>You are not assigned to any group with a lecturer.</p>";
    }

    echo "</div>"; // Close card-body
    echo "</div>"; // Close card
} else {
    echo "None program enrolled.";
}

$sql2 = "SELECT m.meeting_id, t.start_time, l.Lecturer_Name
        FROM meeting m
        INNER JOIN time_slot t ON m.time_slot_id = t.time_slot_id
        INNER JOIN lecturer l ON t.lecture_id = l.Lecturer_Id
        WHERE m.student_id = ?";
$stmt = $conn->prepare($sql2);
$stmt->bind_param("i", $Student_Id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Output the meetings
    echo "<h5 class='card-title'>Meetings Planned:</h5>";
    while ($row = $result->fetch_assoc()) {
        echo "<p class='card-text'>Meeting ID: " . $row["meeting_id"] . "<br>";
        echo "Start Time: " . $row["start_time"] . "<br>";
        echo "With Lecturer: " . $row["Lecturer_Name"] . "</p>";
    }
} else {
    echo "<p class='card-text'>No meetings planned.</p>";
}
?>


