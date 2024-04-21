<?php

$pageTitle = "Admin | Dashboard";
$customCssFile = '../Styles/student_dashboard.css';

session_start();
include('../Header/head.php');
include('../Header/admin_navibar.html');
include('../DatabaseConnection.php');


$sql = "SELECT COUNT(*) AS total_programs FROM program";
$result = mysqli_query($conn, $sql);
$row_programs = mysqli_fetch_assoc($result);
$total_programs = $row_programs['total_programs'];

// Fetch total number of students
$sql = "SELECT COUNT(*) AS total_students FROM student";
$result = mysqli_query($conn, $sql);
$row_students = mysqli_fetch_assoc($result);
$total_students = $row_students['total_students'];

// Fetch total number of lecturers
$sql = "SELECT COUNT(*) AS total_lecturers FROM lecturer";
$result = mysqli_query($conn, $sql);
$row_lecturers = mysqli_fetch_assoc($result);
$total_lecturers = $row_lecturers['total_lecturers'];

$sql = "SELECT l.Lecturer_Id, l.Lecturer_Name, COUNT(m.meeting_id) AS total_meetings
        FROM lecturer l
        LEFT JOIN time_slot t ON l.Lecturer_Id = t.lecture_id
        LEFT JOIN meeting m ON t.time_slot_id = m.time_slot_id
        GROUP BY l.Lecturer_Id, l.Lecturer_Name";
$result = mysqli_query($conn, $sql);

// Fetch the grouping of students and lecturers
$sql = "SELECT gsl.Group_Id, s.Student_Name AS StudentName, l.Lecturer_Name AS LecturerName
        FROM group_student_lecturer gsl
        INNER JOIN student s ON gsl.Student_Id = s.Student_Id
        INNER JOIN lecturer l ON gsl.Lecturer_Id = l.Lecturer_Id";
$result_group = mysqli_query($conn, $sql);

?>

<div class="card bg-secondary text-white mb-4">
    <div class="card-body">
        <h1 class="card-title text-center">Admin Dashboard</h1>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">All Programs</h5>
                    <p class="card-text">Total programs existing: <?php echo $total_programs; ?></p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">All Students</h5>
                    <p class="card-text">Total students enrolling: <?php echo $total_students; ?></p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">All Lecturers</h5>
                    <p class="card-text">All current lecturers: <?php echo $total_lecturers; ?></p>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Meetings by Lecturer</h5>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Lecturer Name</th>
                                <th>Total Meetings</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<tr>";
                                    echo "<td>" . $row["Lecturer_Name"] . "</td>";
                                    echo "<td>" . $row["total_meetings"] . "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='2'>No data available</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Grouped Students and Lecturers</h5>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Student Name</th>
                                <th>Lecturer Name</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $count = 1;
                            if (mysqli_num_rows($result_group) > 0) {
                                while ($row = mysqli_fetch_assoc($result_group)) {
                                    echo "<tr>";
                                    echo "<td>" . $count . "</td>";
                                    echo "<td>" . $row["StudentName"] . "</td>";
                                    echo "<td>" . $row["LecturerName"] . "</td>";
                                    echo "</tr>";
                                    $count++;
                                }
                            } else {
                                echo "<tr><td colspan='3'>No data available</td></tr>";
                            }
