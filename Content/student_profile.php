<!-- profile.php -->
<?php
  session_start();
  $pageTitle = "Profile";
  $customCssFile = '../Styles/Studentprofile.css';
  include('../DatabaseConnection.php');
  include('../Header/head.php');
  include('../Header/student_navibar.html');

  $Student_Id=$_SESSION['Student_Id'];
  $sqlStudentInformation="SELECT * FROM student WHERE Student_Id='$Student_Id'";
  $result = mysqli_query($conn, $sqlStudentInformation);
  if ($result) {
    // Check if any rows were returned
    if (mysqli_num_rows($result) > 0) {
      $studentData = mysqli_fetch_assoc($result);

?>
<body>
<div class="container-md">
<h2>Student - Profile Management</h2>
<br>
<form action="student_profile_request.php" method="POST" class="form_profile">
<div class="form-group row">
    <label class="col-sm-2 col-form-label">Name</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" value="<?php echo $studentData['Student_Name']?>" name="Name" placeholder="Name">
    </div>
  </div>

  <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
    <div class="col-sm-10">
      <input type="email" class="form-control" value="<?php echo $studentData['Email']?>" name="Email" id="inputEmail3" placeholder="Email">
    </div>
  </div>
  
  <?php
      }
    }
  
  ?>
  
  <div class="form-group row">
    <label class="col-sm-2 col-form-label">Password</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" name="Password" id="inputPassword3" placeholder="Password">
    </div>
  </div>
  <!-- <div class="form-group row">
    <label class="col-sm-2 col-form-label">Reapeat Password</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" name="Password" id="inputPassword3" placeholder="Password">
    </div>
  </div> -->
  
  <div class="form-group row">
    <div class="col-sm-10">
      <button type="submit" class="btn btn-primary">Update</button>
    </div>

</form>
</div>
</div>
</body>
</html>