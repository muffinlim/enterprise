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

?>

<div class="card bg-secondary text-white mb-4">
    <div class="card-body">
        <h1 class="card-title text-center">Student Dashboard</h1>
    </div>
</div>

<div class="container mt-4">
    <?php
    $sql = "SELECT program.Program_Id, program.Program_name FROM program INNER JOIN student ON program.Program_Id = student.Program_Id WHERE student.Student_Id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $Student_Id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    ?>
        <div class="card mt-3">
            <div class="card-body">
                <h5 class="card-title">Program Information</h5>
                <p class="card-text"><strong>Program ID:</strong> <?php echo $row["Program_Id"]; ?></p>
                <p class="card-text"><strong>Program Name:</strong> <?php echo $row["Program_name"]; ?></p>

                <?php
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
                    $row = $result->fetch_assoc();
                ?>
                    <p class="card-text"><strong>Grouped Lecturer Name:</strong> <?php echo $row["Lecturer_Name"]; ?></p>
                <?php
                } else {
                ?>
                    <p class="card-text">You are not assigned to any group with a lecturer.</p>
                <?php
                }
                ?>
            </div>
        </div>
    <?php
    } else {
        echo "<p>None program enrolled.</p>";
    }
    ?>

    <?php
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
    ?>
        <div class="card mt-4">
            <div class="card-body">
                <h5 class="card-title">Meetings Planned:</h5>
                <?php
                while ($row = $result->fetch_assoc()) {
                ?>
                    <div class="card mb-2">
                        <div class="card-body">
                            <p class="card-text"><strong>Meeting ID:</strong> <?php echo $row["meeting_id"]; ?></p>
                            <p class="card-text"><strong>Start Time:</strong> <?php echo $row["start_time"]; ?></p>
                            <p class="card-text"><strong>With Lecturer:</strong> <?php echo $row["Lecturer_Name"]; ?></p>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    <?php
    } else {
        echo "<p>No meetings planned.</p>";
    }
    ?>
</div>
