<?php
session_start();
include('DatabaseConnection.php');
if($_SERVER["REQUEST_METHOD"]=="POST"){
   
   
      $Student_Login_Id = $_POST["Student_Login_Id"];
      $Student_Password = $_POST["Student_Password"];
    $query=mysqli_query($conn,"SELECT * FROM student WHERE Student_Login_Id='$Student_Login_Id' and Student_Password='$Student_Password'");
    $num=mysqli_fetch_array($query);
    if($num>0)
    {
    echo "Student Dashboard";
<<<<<<< Updated upstream
    // header("location:student_dashboard_content.php");
=======
    header("location:student_dashboard_content.php");
>>>>>>> Stashed changes
    exit();
    }
    else
    {
    
    header("location:student_login.php");
    
    exit();
    }
   
    $stmt->close();
    $conn->close();
}

?>