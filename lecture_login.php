<?php 
    include('LoginHeader.php');
    include('DatabaseConnection.php');
    if(isset($_POST['login']))
{
   $lecture_login_id=$_POST['lecture_login_id'];
   $password=$_POST['password'];
$query=mysqli_query($con,"SELECT * FROM lecturer WHERE Lecturer_Login_Id='$lecture_login_id' and Lecturer_Password='$password'");
$num=mysqli_fetch_array($query);
if($num>0)
{

header("location:dashboard.php");
exit();
}
else
{

header("location:lecture_login.php");

exit();
}
}
  ?>

  <div class="login-container">
    <h2 class="text-center">Lecture Login</h2>
    <form id="loginForm" action="Login.php" method="POST">
      <div class="form-group">
        <label for="username">Lecture Code:</label>
        <input type="text" class="form-control" id="lecture_login_id" name="lecture_login_id" placeholder="LectureCode">
      </div>
      <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" class="form-control" id="password" name="password" required>
      </div>
      
      <button type="submit" name="submit" class="btn btn-primary btn-block" name="login">log in</button>
    </form>
  </div>
</body>
</html>
