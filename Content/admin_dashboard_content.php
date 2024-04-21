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

?>
<h2>Admin Dashboard</h2>
<div class="row">
<div class="col-md-4">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">All Programmes</h5>
          <p class="card-text">Total programme existing: <?php echo $total_programs; ?></p>
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
    <div class="col-md-4">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">All Lecturers meeting total</h5>
            <table class="table">
                <thead>
                    <tr>
                        <th>Lecturer Name</th>
                        <th>Total Meetings have made</th>
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

<?php
// Include your database connection here
$host = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "etutoring";

$conn = new mysqli($host,$dbusername,$dbpassword,$dbname);

if($conn -> connect_error){
    die("Connection Failed: ". $conn -> connect_error);
}
// Fetch the grouping of students and lecturers
$sql = "SELECT gsl.Group_Id, s.Student_Name AS StudentName, l.Lecturer_Name AS LecturerName
        FROM group_student_lecturer gsl
        INNER JOIN student s ON gsl.Student_Id = s.Student_Id
        INNER JOIN lecturer l ON gsl.Lecturer_Id = l.Lecturer_Id";
$result = mysqli_query($conn, $sql);
?>

<table border="1">
  <tr>
    <th>Group ID</th>
    <th>Student Name</th>
    <th>Lecturer Name</th>
  </tr>
  <?php
  if (mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)) {
          echo "<tr>";
          echo "<td>" . $row["Group_Id"] . "</td>";
          echo "<td>" . $row["StudentName"] . "</td>";
          echo "<td>" . $row["LecturerName"] . "</td>";
          echo "</tr>";
      }
  } else {
      echo "<tr><td colspan='3'>No data available</td></tr>";
  }
  ?>
</table>
  <!-- More dashboard content can be added here -->