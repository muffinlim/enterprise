<?php
$pageTitle = "Lectrurer | Dashboard";
$customCssFile = '../Styles/Studentprofile.css';
session_start();
$Lecturer_Id=$_SESSION['Lecturer_Id'];

include('../Header/head.php');
include('../Header/Student_navibar.html');
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
        // Output the grouped lecturer name
        $row = $result->fetch_assoc();
        echo "<h5 class='card-title'>Grouped Student Name: " . $row["Student_Name"] . "</h5>";
    } else {
        echo "<p class='card-text'>You are not assigned to any student.</p>";
    }

    echo "</div>"; // Close card-body
    echo "</div>"; // Close card
} else {
    echo "None program enrolled.";
}

?>


