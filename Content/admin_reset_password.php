<?php

$pageTitle = "Admin | Reset Password";
$customCssFile = '../Styles/admin_register_user.css';
include('../Header/head.php');
include('../Header/admin_navibar.html');
include('../DatabaseConnection.php');
$LoginId=$_GET['LoginId'];
if(isset($_POST['submit']))
{
$password=$_POST['password'];
$password_repeat=$_POST['password_repeat'];
$LoginIdReset=$_POST['LoginIdReset'];
if($password!=$password_repeat){
    header("location:admin_account.php?error=The password and repeat passoword are not match!");
}else{

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $sqlUpdatestudent="UPDATE student
    SET Student_Password = '$hashed_password'
    WHERE Student_Login_Id='$LoginIdReset'";

    $sqlUpdatelecturer="UPDATE lecturer
    SET Lecturer_Password = '$hashed_password'
    WHERE  Lecturer_Login_Id='$LoginIdReset'";
    
    $conn->query($sqlUpdatestudent);
    $conn->query($sqlUpdatelecturer);
    header("location:admin_account.php?success=Reset password login id ".$LoginId." succeffull!");
}

}


?>

<body>
<div class="admin-container mt-4">
<h2>Admin - Reset Password</h2>
<br>
    <form method="post">
 
    <label for="login_id">Login Id: <?php echo $LoginId;?></label>

  <input type="hidden" name="LoginIdReset"value="<?php echo $LoginId;?>">
    <label for="password">Password</label>
    <input type="password" name="password" required>
    <label for="repeat_password">Repeat_Password</label>  
    <input type="password" name="password_repeat" required>
  
      
    <button type="submit" name="submit" id="submit">Reset Password</button>

    </form>

</div>


</body>
</html>