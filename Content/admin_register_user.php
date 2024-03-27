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
    
    // check email ensure not email repeat use
    $sqlCheckEmail="SELECT * FROM student WHERE Email ='$email'";
    $resultCheckEmail = mysqli_query($conn, $sqlCheckEmail);

// Check if the query returned more than one row
if (mysqli_num_rows($resultCheckEmail) >= 1) {
    echo "<script>alert('Register Fail due to email have been used for student');</script>";
    }else{
    // check the id ensure not repeat id can be use
    $sql2="SELECT * FROM student WHERE Student_Login_Id='$login_id'";
    $result2=mysqli_query($conn,$sql2);
    if($result2->num_rows>0){
      echo "<script>alert('Register Fail due to the login id have been used in other student account ');</script>";
    }else{

    

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
     
  $sql = "INSERT INTO student (Program_Id,Student_Login_Id,Student_Password,Student_Name,Email) VALUES ('$program','$login_id','$hashed_password','$name','$email')";
      mysqli_query($conn, $sql);
      echo "<script>alert('success');</script>";
      header("location:admin_account.php");
    }}

  }else{
        // check email ensure not email repeat use
        $sqlCheckEmail="SELECT * FROM lecturer WHERE Email ='$email'";
        $resultCheckEmail = mysqli_query($conn, $sqlCheckEmail);
    
    // Check if the query returned more than one row
    if (mysqli_num_rows($resultCheckEmail) >= 1) {
        echo "<script>alert('Register Fail due to email have been used for other lecturer');</script>";
        }else{
    
    // check the id ensure not repeat id can be use
    $sql2="SELECT * FROM lecturer WHERE Lecturer_Login_Id='$login_id'";
    $result2=mysqli_query($conn,$sql2);
    if($result2->num_rows>0){
      echo "<script>alert('Register Fail due to the login id have been used in student account ');</script>";
    }else{

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO lecturer (Program_Id,Lecturer_Login_Id,Lecturer_Password,Lecturer_Name,Email) VALUES ('$program','$login_id','$hashed_password','$name','$email')";
    mysqli_query($conn, $sql);
   
    echo "<script>alert('success');</script>";
    header("location:admin_account.php");
  }
        }
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
      <input type="text" pattern="[A-Za-z]{4}-\d{7}" placeholder="example XXXX-1900584" id="login_id" name="login_id" required>
      
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