<!-- admin_register_user.php -->
<?php
  $pageTitle = "Admin | Group";
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
<h2>Admin - Group Student / Lecturer</h2>
<table class="table table-striped">
  <thead>
  
  <!-- <div class="float-right">
    <a href="admin_add_group.php" class="btn btn-primary" style="font-size:10px">New Group <i class="fa fa-plus-circle"></i></a>
</div> -->
  
<br><br>
  <tr>
      <th scope="col">#</th>
      <th scope="col">Program</th>
      <th scope="col">Lecturer</th>
      <th scope="col">Option</th>
    </tr>
  </thead>
  <tbody>
    <tr>
        <?php
         $count=0;
        $sql="SELECT * FROM lecturer JOIN program WHERE lecturer.Program_Id=program.Program_Id";
        $result=mysqli_query($conn,$sql);
       
        if (mysqli_num_rows($result) > 0) {
           
            // Loop through each row in the result set
            while ($row = mysqli_fetch_assoc($result)) {
                $count++;
        ?>
      <th scope="row"><?php echo $count;?></th>
      <td><?php echo $row['Program_name'];?></td>
      <td><?php echo $row['Lecturer_Name'];?></td>
      <td><a   class="btn btn-primary" style="font-size:10px" href="admin_edit_group.php?lecturer_id=<?php echo $row['Lecturer_Id'];?>
                   &lecturer_name=<?php echo $row['Lecturer_Name'];?>
                   &program_id=<?php echo $row['Program_Id']; ?>
                   &program_name=<?php echo $row['Program_name'];?>" style="font-size:15px">Manage <i class="fa fa-pencil-square-o"></i></a>
                  
                  </td>
      </tr>
  <?php 
     }
    } else {
        echo "No rows found";
    }
   ?>
   
      </tbody>
</table>

</div>


</body>
</html>