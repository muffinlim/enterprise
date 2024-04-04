<!-- admin_register_user.php -->
<?php
  $pageTitle = "Lecturer | File Management";
  $customCssFile = '../Styles/Lecturerprofile.css';
  session_start();
  $Lecturer_Id=$_SESSION['Lecturer_Id'];
  $Lecturer_Login_Id=$_SESSION['Lecturer_Login_Id'];
  include('../Header/head.php');
  include('../Header/Lecturer_navibar.html');
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
<div class="container-md">
<h2>Lecturer- File Management</h2>
<div class="float-right">
    <a href="lecturer_upload_file.php" class="btn btn-primary" style="font-size:15px">Upload File <i class="fa fa-plus-circle"></i></a>
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
    $sqlSelectFileDetail = "SELECT * FROM file_management WHERE Upload_Id='$Lecturer_Login_Id' OR Received_Id='$Lecturer_Login_Id'";
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
        <td>
     
        <a href="lecturer_dowload_file_request.php?File_Link=<?php echo $row['File_Link']; ?>" class="btn btn-primary">Download <i class="fa fa-download"></i></a>
       
        <?php
        // Check if the file belongs to the current user before showing the delete button
        if ($row['Upload_Id'] == $Lecturer_Login_Id) {
    ?>
                    <a href="lecturer_remove_file_request.php?File_Id=<?php echo $row['File_Id']; ?>" class="btn btn-danger">Remove <i class="fa fa-trash" aria-hidden="true"></i></a>
    <?php } ?>
      </td>
        
      </tr>
    <?php
    }
    ?>
  </tbody>
</table>

</div>


</body>
</html>