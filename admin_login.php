<?php 
    include('LoginHeader.php');

    if(isset($_POST['login']))
{
   $admin_login_id=$_POST['admin_login_id'];
   $password=$_POST['password'];
$query=mysqli_query($con,"SELECT * FROM admin WHERE Admin_Login_Id='$admin_login_id' and Admin_Password='$password'");
$num=mysqli_fetch_array($query);
if($num>0)
{

header("location:admin_register_user.php");
exit();
}
else
{

header("location:admin_login.php");

exit();
}
}
  ?>

  <div class="login-container">
    <h2 class="text-center">Admin Login</h2>
    <form id="loginForm" action="Login.php" method="POST">
      <div class="form-group">
        <label for="username">Admin ID:</label>
        <input type="text" class="form-control" id="admin_login_id" name="admin_login_id" placeholder="AdminCode">
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
