<?php
session_start();
include('../DatabaseConnection.php');
if($_SERVER["REQUEST_METHOD"]=="POST"){
   $Student_Id=$_SESSION['Student_Id'];
   $Name=$_POST['Name'];
   $Email=$_POST['Email'];
   $Password=$_POST['Password'];

   if(empty($Password)){
    
    $sqlUpdateStudentInformation="UPDATE student
   SET Student_Name = '$Name', Email = '$Email'
   WHERE Student_Id='$Student_Id'";
    
    $conn->query($sqlUpdateStudentInformation);
    
    header("location:student_profile.php");

   }else{
    $Password = password_hash($Password, PASSWORD_DEFAULT);
   $sqlUpdateStudentInformation="UPDATE student
   SET Student_Name = '$Name', Email = '$Email',Student_Password='$Password'
   WHERE Student_Id='$Student_Id'";
    
    $conn->query($sqlUpdateStudentInformation);
    
    header("location:student_profile.php");
   

// $stmt->close();
    $conn->close();
}
}

?>