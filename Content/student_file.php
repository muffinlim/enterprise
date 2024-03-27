<!-- admin_register_user.php -->
<?php
  $pageTitle = "Student | File Management";
  $customCssFile = '../Styles/StudentProfile.css';
  session_start();
  $Student_Id=$_SESSION['Student_Id'];
  $Student_Login_Id=$_SESSION['Student_Login_Id'];
  include('../Header/head.php');
  include('../Header/Student_navibar.html');
  include('../DatabaseConnection.php');
//   get the receied name
//   $sqlSelectRceivedId="SELECT * FROM group_student_lecturer INNER JOIN lecturer ON group_student_lecturer.Lecturer_Id=lecturer.Lecturer_Id WHERE group_student_lecturer.Student_Id='$Student_Id'";

?>
<body>
<div class="container-md">
<h2>Student - File Management</h2>
<div class="float-right">
    <a href="student_upload_file.php" class="btn btn-primary" style="font-size:15px">Upload File <i class="fa fa-plus-circle"></i></a>
</div>
<br><br>
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">File Title</th>
      <th scope="col">File Name</th>
      <th scope="col">Uploaded Date</th>
      <th scope="col">Uploaded By</th>
      <th scope="col">Received By</th>
      <th scope="col">Operation</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $sqlSelectFileDetail = "SELECT * FROM file_management WHERE Upload_Id='$Student_Login_Id' OR Received_Id='$Student_Login_Id'";
    $resultSelectFileDetail = mysqli_query($conn, $sqlSelectFileDetail);
    $count = 0; // Counter variable for row numbering

    while ($row = mysqli_fetch_assoc($resultSelectFileDetail)) {
      $count++;
      ?>
      <tr>
        <td><?php echo $count; ?></td>
        <td><?php echo $row['File_Title']; ?></td>
        <td><?php echo $row['File_Link']; ?></td>
        <td><?php echo $row['Uploaded_Date']; ?></td>
        <td><?php echo $row['Upload_Id']; ?></td>
        <td><?php echo $row['Received_Id']; ?></td>
        <td><a href="student_dowload_file_request.php?File_Link=<?php echo $row['File_Link']; ?>" class="btn btn-primary" style="width:100%">Download <i class="fa fa-download"></i></a></td>
      </tr>
    <?php
    }
    ?>
  </tbody>
</table>

</div>


</body>
</html>