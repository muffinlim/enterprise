<?php
session_start();
include('DatabaseConnection.php');
if($_SERVER["REQUEST_METHOD"]=="POST"){
   
   
      $Student_Login_Id = $_POST["Student_Login_Id"];
      $Student_Password = $_POST["Student_Password"];
    $query=mysqli_query($conn,"SELECT * FROM student WHERE Student_Login_Id='$Student_Login_Id' and Student_Password='$Student_Password'");
  
    if($query)
    {
      $row = mysqli_fetch_assoc($query); // Fetch the result as an associative array
      if($row) {
        $_SESSION['Student_Id'] = $row['Student_Id']; 
        header("location:../enterprise/Content/student_profile.php");
   
        } else {
         echo "cannot get it";  
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