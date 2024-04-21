<?php
$pageTitle = "Lectrurer | Dashboard";
$customCssFile = '../Styles/Studentprofile.css';
session_start();
$Lecturer_Id=$_SESSION['Lecturer_Id'];

include('../Header/head.php');
include('../Header/lecturer_navibar.html');
include('../DatabaseConnection.php');
$successMessage = isset($_GET['success']) ? $_GET['success'] : '';
$errorMessage = isset($_GET['error']) ? $_GET['error'] : '';





$sql = "SELECT program.Program_Id, program.Program_name FROM program INNER JOIN lecturer ON program.Program_Id = lecturer.Program_Id WHERE lecturer.Lecturer_Id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $Lecturer_Id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo "<div class='card'>";
    echo "<div class='card-body'>";
    echo "<h5 class='card-title'>Program ID: " . $row["Program_Id"] . "</h5>";
    echo "<h5 class='card-text'>Program Name: " . $row["Program_name"] . "</h5>";

    // Fetch the grouped student name
    $sql = "SELECT student.Student_Name
        FROM group_student_lecturer
        INNER JOIN student ON group_student_lecturer.Student_Id = student.Student_Id
        WHERE group_student_lecturer.Lecturer_Id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $Lecturer_Id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Output the grouped student names
    echo "<h5 class='card-title'>Grouped Student Names:</h5>";
    while ($row = $result->fetch_assoc()) {
        echo "<p class='card-text'>" . $row["Student_Name"] . "</p>";
    }
} else {
    echo "<p class='card-text'>You are not assigned to any students.</p>";
}


    echo "</div>"; // Close card-body
    echo "</div>"; // Close card
} else {
    echo "None program enrolled.";
}

$sql = "SELECT m.meeting_id, t.start_time, s.Student_Name
        FROM meeting m
        INNER JOIN time_slot t ON m.time_slot_id = t.time_slot_id
        INNER JOIN student s ON m.student_id = s.Student_Id
        WHERE t.lecture_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $Lecturer_Id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Output the meetings
    echo "<h5 class='card-title'>Meetings Planned:</h5>";
    while ($row = $result->fetch_assoc()) {
        echo "<p class='card-text'>Meeting ID: " . $row["meeting_id"] . "<br>";
        echo "Start Time: " . $row["start_time"] . "<br>";
        echo "With Student: " . $row["Student_Name"] . "</p>";
    }
} else {
    echo "<p class='card-text'>No meetings planned.</p>";
}
?>


