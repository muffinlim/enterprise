<?php
$pageTitle = "Lecturer | Dashboard";
$customCssFile = '../Styles/Studentprofile.css';
session_start();
$Lecturer_Id=$_SESSION['Lecturer_Id'];

include('../Header/head.php');
include('../Header/lecturer_navibar.html');
include('../DatabaseConnection.php');
$successMessage = isset($_GET['success']) ? $_GET['success'] : '';
$errorMessage = isset($_GET['error']) ? $_GET['error'] : '';
?>

<div class="card bg-secondary text-white mb-4">
    <div class="card-body">
        <h1 class="card-title text-center">Lecturer Dashboard</h1>
    </div>
</div>

<div class="container mt-4">

    <?php
    $sql = "SELECT program.Program_Id, program.Program_name FROM program INNER JOIN lecturer ON program.Program_Id = lecturer.Program_Id WHERE lecturer.Lecturer_Id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $Lecturer_Id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    ?>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Program Information</h5>
                <p class="card-text"><strong>Program ID:</strong> <?php echo $row["Program_Id"]; ?></p>
                <p class="card-text"><strong>Program Name:</strong> <?php echo $row["Program_name"]; ?></p>

                <?php
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
                ?>
                    <h5 class='card-title'>Grouped Student Names:</h5>
                    <?php
                    while ($row = $result->fetch_assoc()) {
                    ?>
                        <p class='card-text'><?php echo $row["Student_Name"]; ?></p>
                    <?php
                    }
                } else {
                    echo "<p class='card-text'>You are not assigned to any students.</p>";
                }
                ?>
            </div>
        </div>
    <?php
    } else {
        echo "None program enrolled.";
    }
    ?>

    <?php
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
    ?>
        <div class="card mt-4">
            <div class="card-body">
                <h5 class="card-title">Meetings Planned:</h5>
                <?php
                while ($row = $result->fetch_assoc()) {
                ?>
                    <div class="border p-3 mb-3">
                    <p class="card-text"><strong>Meeting ID:</strong> <?php echo $row["meeting_id"]; ?><br>
                    <strong>Start Time:</strong> <?php echo $row["start_time"]; ?><br>
                    <strong>With Student:</strong> <?php echo $row["Student_Name"]; ?></p>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    <?php
    } else {
        echo "<div class='card mt-4'><div class='card-body'><p class='card-text'>No meetings planned.</p></div></div>";
    }
    ?>
</div>
