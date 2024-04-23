<?php
$pageTitle = "Student | Notification";

session_start();

include('../Header/head.php');
include('../Header/Student_navibar.html');
include('../DatabaseConnection.php');

if (!isset($_SESSION['Student_Id'])) {
    // Redirect to login page if not logged in
    header("Location: student_login.php");
    exit();
}

// Get the student ID from the session
$studentId = $_SESSION['Student_Id'];

// Query to retrieve blog posts
$blogQuery = "SELECT Student_Name, Date FROM blog
              INNER JOIN student ON blog.Student_Id = student.Student_Id
              ORDER BY Date DESC";
$blogResult = $conn->query($blogQuery);

// Query to retrieve comments
$commentQuery = "SELECT Lecturer_Name FROM comment
                 INNER JOIN lecturer ON comment.Lecturer_Id = lecturer.Lecturer_Id";
$commentResult = $conn->query($commentQuery);

// Query to retrieve time slot notifications for the specific student
$timeSlotQuery = "SELECT ts.start_time, l.Lecturer_Name
                  FROM time_slot ts
                  INNER JOIN lecturer l ON ts.lecture_id = l.Lecturer_Id
                  WHERE ts.time_slot_id IN (SELECT time_slot_id FROM meeting WHERE student_id = ?)";
$timeSlotStmt = $conn->prepare($timeSlotQuery);
$timeSlotStmt->bind_param("i", $studentId);
$timeSlotStmt->execute();
$timeSlotResult = $timeSlotStmt->get_result();

// Query to retrieve group change notifications for the specific student
$groupQuery = "SELECT Student_Name, Lecturer_Name FROM group_student_lecturer
               INNER JOIN student ON group_student_lecturer.Student_Id = student.Student_Id
               INNER JOIN lecturer ON group_student_lecturer.Lecturer_Id = lecturer.Lecturer_Id
               WHERE student.Student_Id = ?";
$groupStmt = $conn->prepare($groupQuery);
$groupStmt->bind_param("i", $studentId);
$groupStmt->execute();
$groupResult = $groupStmt->get_result();

// Display notifications
?>

<body>
<div class="container mt-4">
    <div class="row">
        <div class="col-md-6">
            <div class="card bg-info">
                <div class="card-header text-white">
                    <h3 class="mb-0">Blog Notifications</h3>
                </div>
                <ul class="list-group list-group-flush">
                    <?php if ($blogResult->num_rows > 0) : ?>
                        <?php while ($row = $blogResult->fetch_assoc()) : ?>
                            <li class="list-group-item">Student post blog: '<?php echo $row['Student_Name']; ?>' posted a new blog.</li>
                        <?php endwhile; ?>
                    <?php else : ?>
                        <li class="list-group-item">No new blog posts.</li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card bg-warning">
                <div class="card-header text-white">
                    <h3 class="mb-0">Comment Notifications</h3>
                </div>
                <ul class="list-group list-group-flush">
                    <?php if ($commentResult->num_rows > 0) : ?>
                        <?php while ($row = $commentResult->fetch_assoc()) : ?>
                            <li class="list-group-item">Lecturer post comment: '<?php echo $row['Lecturer_Name']; ?>' replied in the comments.</li>
                        <?php endwhile; ?>
                    <?php else : ?>
                        <li class="list-group-item">No new comments.</li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card bg-success">
                <div class="card-header text-white">
                    <h3 class="mb-0">Time Slot Notifications</h3>
                </div>
                <ul class="list-group list-group-flush">
                    <?php if ($timeSlotResult->num_rows > 0) : ?>
                        <?php while ($row = $timeSlotResult->fetch_assoc()) : ?>
                            <li class="list-group-item">Lecturer add time slot: '<?php echo $row['Lecturer_Name']; ?>' added a time slot at '<?php echo $row['start_time']; ?>'.</li>
                        <?php endwhile; ?>
                    <?php else : ?>
                        <li class="list-group-item">No new time slots.</li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card bg-danger">
                <div class="card-header text-white">
                    <h3 class="mb-0">Grouping Notifications</h3>
                </div>
                <ul class="list-group list-group-flush">
                    <?php if ($groupResult->num_rows > 0) : ?>
                        <?php while ($row = $groupResult->fetch_assoc()) : ?>
                            <li class="list-group-item">Admin change grouping of lecturer and students: You '<?php echo $row['Student_Name']; ?>' are now grouped with '<?php echo $row['Lecturer_Name']; ?>'.</li>
                        <?php endwhile; ?>
                    <?php else : ?>
                        <li class="list-group-item">No grouping changes.</li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>
</div>
                    </body>
