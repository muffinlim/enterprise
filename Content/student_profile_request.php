<?php
session_start();
include('../DatabaseConnection.php');
if($_SERVER["REQUEST_METHOD"]=="POST"){
   $Student_Id=$_SESSION['Student_Id'];
   $Name=$_POST['Name'];
   $Email=$_POST['Email'];
   $Password=$_POST['Password'];
   $Repeat_Password=$_POST['Repeat_Password'];


   $sqlCheckEmail = "SELECT Id, Email, LoginId
   FROM (
       (SELECT student.Student_Id AS Id, student.Email, student.Student_Login_Id AS LoginId
       FROM student 
       JOIN program ON program.Program_Id = student.Program_Id)
       UNION ALL
       (SELECT lecturer.Lecturer_Id AS Id, lecturer.Email, lecturer.Lecturer_Login_Id AS LoginId
       FROM lecturer)
   ) AS combined_data
   WHERE Email='$Email' AND Id!='$Student_Id'";
   

if(mysqli_num_rows(mysqli_query($conn,$sqlCheckEmail))>=1){
// the id or the email have been used
header("location:student_profile.php?error=Register fail due to the the email have been used.");

}else{

   if(empty($Password)&&empty($Repeat_Password)){
    
    $sqlUpdateStudentInformation="UPDATE student
   SET Student_Name = '$Name', Email = '$Email'
   WHERE Student_Id='$Student_Id'";
    
    $conn->query($sqlUpdateStudentInformation);
    
    header("location:student_profile.php?success=Updated student profile successfull!");

   }else{
    //  password match update the password 
    if($Password==$Repeat_Password){
    $Password = password_hash($Password, PASSWORD_DEFAULT);
   $sqlUpdateStudentInformation="UPDATE student
   SET Student_Name = '$Name', Email = '$Email',Student_Password='$Password'
   WHERE Student_Id='$Student_Id'";
    
    $conn->query($sqlUpdateStudentInformation);
    header("location:student_profile.php?success=Updated student profile successfull!");

// $stmt->close();
    $conn->close();
    }else{
        // not update the password
         
        header("location:student_profile.php?error=Updated student profile fail due to the password and repeat does not match!");
    
    }
}

}
}

?>