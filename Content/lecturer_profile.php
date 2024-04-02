<!-- profile.php -->
<?php
  session_start();
  $pageTitle = "Profile";
  $customCssFile = '../Styles/Lecturerprofile.css';
  include('../DatabaseConnection.php');
  include('../Header/head.php');
  include('../Header/lecturer_navibar.html');
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
  $Lecturer_Id=$_SESSION['Lecturer_Id'];
  $sqlLecturerInformation="SELECT * FROM lecturer WHERE Lecturer_Id='$Lecturer_Id'";
  $result = mysqli_query($conn, $sqlLecturerInformation);
  if ($result) {
    // Check if any rows were returned
    if (mysqli_num_rows($result) > 0) {
      $LecturerData = mysqli_fetch_assoc($result);

?>
<body>
<div class="container-md">
<h2>Lecturer - Profile Management</h2>
<br>
<form action="lecturer_profile_request.php" method="POST" class="form_profile">
<div class="form-group row">
    <label class="col-sm-2 col-form-label">Name</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" value="<?php echo $LecturerData['Lecturer_Name']?>" name="Name" placeholder="Name">
    </div>
  </div>

  <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
    <div class="col-sm-10">
      <input type="email" class="form-control" value="<?php echo $LecturerData['Email']?>" name="Email" id="inputEmail3" placeholder="Email">
    </div>
  </div>
  
  <?php
      }
    }
  
  ?>
  
  <div class="form-group row">
    <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" name="Password" id="inputPassword3" placeholder="Password">
    </div>
  </div>
  <div class="form-group row">
    <label class="col-sm-2 col-form-label">Reapeat Password</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" name="Repeat_Password" id="inputPassword3" placeholder="Password">
    </div>
  </div>

  <div class="form-group row">
    <div class="col-sm-10">
      <button type="submit" class="btn btn-primary">Update</button>
    </div>

</form>
</div>
</div>
</body>
</html>