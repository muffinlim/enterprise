<?php
session_start();
include('DatabaseConnection.php');
if($_SERVER["REQUEST_METHOD"]=="POST"){
   
   
      $Student_Login_Id = $_POST["Student_Login_Id"];
      $Student_Password = $_POST["Student_Password"];
    $query=mysqli_query($conn,"SELECT * FROM student WHERE Student_Login_Id='$Student_Login_Id'");
  
    if($query)
    {
      $row = mysqli_fetch_assoc($query); // Fetch the result as an associative array
      if($row) {
        $hashedPasswordFromDatabase = $row['Student_Password'];
                
        // Use password_verify to compare the entered password with the hashed password
        if (password_verify($Student_Password, $hashedPasswordFromDatabase)) {
        $_SESSION['Student_Id'] = $row['Student_Id']; 
        $_SESSION['Student_Login_Id']=$Student_Login_Id;
        
        header("location:../enterprise/Content/student_profile.php");
        }else{
          echo "<script>alert('Wrong ID or Password!');";
          echo "window.location.href = 'student_login.php';";
          echo "</script>";
        }
        } else{
          echo "<script>alert('Student not found in the system!');";
          echo "window.location.href = 'student_login.php';";
          echo "</script>";
        
        }

    
    exit();
    }else
    {
    
    header("location:student_login.php");
    
    exit();
    }
   
    $stmt->close();
    $conn->close();
}

?>