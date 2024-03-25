<!-- admin_register_user.php -->
<?php
  $pageTitle = "Admin | RegisterUser";
  $customCssFile = '../Styles/admin_register_user.css';

  include('../Header/head.php');
  include('../Header/admin_navibar.html');
  include('../DatabaseConnection.php');

  if(isset($_POST['submit']))
{
  
  $login_id=$_POST['login_id'];
  $name=$_POST['username'];
  $email=$_POST['email'];
  $password=$_POST['password'];
  $usertype=$_POST['usertype'];
  $program=$_POST['program'];
  if($usertype=="student"){
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
     
  $sql = "INSERT INTO student (Program_Id,Student_Login_Id,Student_Password,Student_Name,Email) VALUES ('$program','$login_id','$hashed_password','$name','$email')";
      mysqli_query($conn, $sql);
      echo "<script>alert('success');</script>";
      header("location:admin_account.php");
 
  }else{
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO lecturer (Program_Id,Lecturer_Login_Id,Lecturer_Password,Lecturer_Name,Email) VALUES ('$program','$login_id','$hashed_password','$name','$email')";
    mysqli_query($conn, $sql);
   
    echo "<script>alert('success');</script>";
    header("location:admin_account.php");
  }
  
 

  
}
?>

<body>
<div class="admin-container mt-4">
<h2>Admin - Register User</h2>

    <form id="registrationForm" method="post">
 
    <label for="program">Program:</label>
      <select id="program" name="program" required>
        <option value="1">Business</option>
        <option value="2">Computing</option>
        <option value="3">Accounting </option>
        <!-- Add more user types as needed -->
      </select>
    <label for="usertype">User Type:</label>
      <select id="usertype" name="usertype" required>
        <option value="student">Student</option>
        <option value="lecturer">Lecturer</option>
        <!-- Add more user types as needed -->
      </select>

      <label for="username">Login Id:</label>
      <input type="text" id="login_id" name="login_id" required>
      
      <label for="password">Password:</label>
      <input type="password" id="password" name="password" required>

      <label for="username">Username:</label>
      <input type="text" id="username" name="username" required>

      <label for="email">Email:</label>
      <input type="email" id="email" name="email" required>

      

      <button type="submit" name="submit" id="submit">Register</button>
    </form>

</div>


</body>
</html>