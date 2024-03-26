<!-- admin_register_user.php -->
<?php
  $pageTitle = "Student | File Management";
  $customCssFile = '../Styles/StudentProfile.css';
  session_start();
  $Student_Id=$_SESSION['Student_Id'];
  include('../Header/head.php');
  include('../Header/Student_navibar.html');
  include('../DatabaseConnection.php');
//   get the receied name
//   $sqlSelectRceivedId="SELECT * FROM group_student_lecturer INNER JOIN lecturer ON group_student_lecturer.Lecturer_Id=lecturer.Lecturer_Id WHERE group_student_lecturer.Student_Id='$Student_Id'";

?>

<body>
<div class="container-md">
<h2>Student - File Management</h2>
<table class="table table-striped">
  <thead>
  <div class="float-right">
    <a href="student_upload_file.php" class="btn btn-primary" style="font-size:15px">Upload File <i class="fa fa-plus-circle"></i></a>
</div>
   <br><br>
  <tr>
      <th scope="col">#</th>
      <th scope="col">File Titile</th>
      <th scope="col">File Link</th>
      <th scope="col">Uploaded Date</th>
      <th scope="col">Uploaded By</th>
      <th scope="col">Received By</th>
    </tr>
    
  </thead>
  <tbody>
  <tr></tr>   
  <tr></tr>   
  <tr></tr>   
  <tr></tr>   
  <tr></tr>   
  <tr></tr>   
      
</tbody>
</table>

</div>


</body>
</html>