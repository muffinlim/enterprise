<!-- admin_register_user.php -->
<?php
  $pageTitle = "Admin | Account";
  $customCssFile = '../Styles/admin_register_user.css';

  include('../Header/head.php');
  include('../Header/admin_navibar.html');
  include('../DatabaseConnection.php');

  $successMessage = isset($_GET['success']) ? $_GET['success'] : '';
  $errorMessage = isset($_GET['error']) ? $_GET['error'] : '';
  
  // Display success message if it exists
  if (!empty($successMessage)) {
      echo '<div class="alert alert-success">' . htmlspecialchars($successMessage) . '</div>';
  }
  
  // Display error message if it exists
  if (!empty($errorMessage)) {
      echo '<div class="alert alert-danger">' . htmlspecialchars($errorMessage) . '</div>';
  }
?>

<body>
<div class="admin-container mt-4">
<h2>Admin - Account Student / Lecturer</h2>
<br>
<table class="table table-striped">
  <thead>
    
  <div class="d-flex justify-content-between">
  <div>
    <select name="filter" id="filter"><i class="bi bi-filter"></i>
    <option value="All">All</option>
    <option value="Student">Student</option>
      <option value="Lecturer">Lecturer</option>
    </select>
  </div>
  <div>
    <div class="float-right">
      <a href="admin_register_user.php" class="btn btn-primary" style="font-size:15px">Register Account <i class="fa fa-plus-circle"></i></a>
    </div>
  </div>
</div>

   <br>
  <tr>
      <th scope="col">#</th>
      <th scope="col">Program</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">ID</th>
      <th  class="text-center" colspan="2">Operation</th>
    
    </tr>
  </thead>
  <tbody>
    <tr>
    <?php
$count = 0;

// Combine the two queries using UNION
$sql = "(SELECT student.Student_Id AS Id, student.Student_Name AS Name, student.Email, program.Program_name AS ProgramName,student.Student_Login_Id AS LoginId
         FROM student 
         JOIN program ON program.Program_Id = student.Program_Id)
         UNION
         (SELECT lecturer.Lecturer_Id AS Id, lecturer.Lecturer_Name AS Name, lecturer.Email, program.Program_name AS ProgramName,lecturer.Lecturer_Login_Id AS LoginId
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
        <td><?php echo $row['LoginId']; ?></td>
        <td><a href="admin_remove_account.php?LoginId=<?php echo $row['LoginId']; ?>" class="btn btn-danger">Remove <i class="fa fa-trash" aria-hidden="true"></i></a></td>
        <td><a href="admin_reset_password.php?LoginId=<?php echo $row['LoginId']; ?>" class="btn btn-primary">Reset <i class="fa fa-pencil" aria-hidden="true"></i></a></td>
        
    </tr>
<?php
    }
}
?>
   
      </tbody>
</table>

</div>
<script type="text/javascript">
$(document).ready(function() {
    $("#filter").on('change', function() {
        // This means the value of the filter
        var filter_value = $(this).val();

        $.ajax({
            url: "admin_account_ajax_request.php", 
            type: "POST",
            data: { request: filter_value }, 
            success: function(data) {
                $(".table tbody").html(data);
            }
        });
    });
});
</script>

</body>
</html>