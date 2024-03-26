<!-- admin_register_user.php -->
<?php
  $pageTitle = "Admin | Account";
  $customCssFile = '../Styles/admin_register_user.css';

  include('../Header/head.php');
  include('../Header/admin_navibar.html');
  include('../DatabaseConnection.php');
?>

<body>
<div class="admin-container mt-4">
<h2>Admin - Account Student / Lecturer</h2>
<table class="table table-striped">
  <thead>
  <div class="float-right">
    <a href="admin_register_user.php" class="btn btn-primary" style="font-size:15px">Register Account <i class="fa fa-plus-circle"></i></a>
</div>
   <br><br>
  <tr>
      <th scope="col">#</th>
      <th scope="col">Program</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
    </tr>
  </thead>
  <tbody>
    <tr>
    <?php
$count = 0;

// Combine the two queries using UNION
$sql = "(SELECT student.Student_Id AS Id, student.Student_Name AS Name, student.Email, program.Program_name AS ProgramName
         FROM student 
         JOIN program ON program.Program_Id = student.Program_Id)
         UNION
         (SELECT lecturer.Lecturer_Id AS Id, lecturer.Lecturer_Name AS Name, lecturer.Email, program.Program_name AS ProgramName
         FROM lecturer 
         JOIN program ON program.Program_Id = lecturer.Program_Id)";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // Loop through each row in the result set
    while ($row = mysqli_fetch_assoc($result)) {
        $count++;
?>
    <tr>
        <th scope="row"><?php echo $count; ?></th>
        <td><?php echo $row['ProgramName']; ?></td>
        <td><?php echo $row['Name']; ?></td>
        <td><?php echo $row['Email']; ?></td>
    </tr>
<?php
    }
}
?>
   
      </tbody>
</table>

</div>


</body>
</html>