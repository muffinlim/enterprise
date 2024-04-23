<?php
$pageTitle = "Lecturer | Notification";

session_start();

$Lecturer_Id=$_SESSION['Lecturer_Id'];

include('../Header/head.php');
include('../Header/Lecturer_navibar.html');
include('../DatabaseConnection.php');

if (!isset($_SESSION['Lecturer_Id'])) {
    // Redirect to login page if not logged in
    header("Location: lecturer_login.php");
    exit();
}

// Query to retrieve blog posts
$blogQuery = "SELECT Student_Name, Date FROM blog
              INNER JOIN student ON blog.Student_Id = student.Student_Id
              ORDER BY Date DESC";
$blogResult = $conn->query($blogQuery);

// Query to retrieve comments
$commentQuery = "SELECT Lecturer_Name FROM comment
                 INNER JOIN lecturer ON comment.Lecturer_Id = lecturer.Lecturer_Id";
$commentResult = $conn->query($commentQuery);

// Query to retrieve group change notifications for the specific student
$groupQuery = "SELECT Student_Name, Lecturer_Name FROM group_student_lecturer
               INNER JOIN student ON group_student_lecturer.Student_Id = student.Student_Id
               INNER JOIN lecturer ON group_student_lecturer.Lecturer_Id = lecturer.Lecturer_Id
               WHERE lecturer.Lecturer_Id = ?";
$groupStmt = $conn->prepare($groupQuery);
$groupStmt->bind_param("i", $Lecturer_Id);
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
        <div class="col-md-12">
            <div class="card bg-danger">
                <div class="card-header text-white">
                    <h3 class="mb-0">Grouping Notifications</h3>
                </div>
                <ul class="list-group list-group-flush">
                    <?php if ($groupResult->num_rows > 0) : ?>
                        <?php while ($row = $groupResult->fetch_assoc()) : ?>
                            <li class="list-group-item">Admin change grouping of lecturer and students: You '<?php echo $row['Lecturer_Name']; ?>' are now grouped with '<?php echo $row['Student_Name']; ?>'.</li>
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

