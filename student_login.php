  <?php 
    include('LoginHeader.php');

    if(isset($_POST['login']))
{
   $student_login_id=$_POST['student_login_id'];
   $password=$_POST['password'];
$query=mysqli_query($con,"SELECT * FROM student WHERE Student_Login_Id='$student_login_id' and Student_Password='$password'");
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
    <h2 class="text-center">Login</h2>
    <form id="loginForm" action="Login.php" method="POST">
      <div class="form-group">
        <label for="username">Student Id:</label>
        <input type="text" class="form-control" id="student_login_id" name="student_login_id" placeholder="StudentCode">
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
