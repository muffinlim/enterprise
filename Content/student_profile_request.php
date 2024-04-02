<?php
session_start();
include('../DatabaseConnection.php');
if($_SERVER["REQUEST_METHOD"]=="POST"){
   $Student_Id=$_SESSION['Student_Id'];
   $Name=$_POST['Name'];
   $Email=$_POST['Email'];
   $Password=$_POST['Password'];
   $Repeat_Password=$_POST['Repeat_Password'];
// SQL query to check if the email exists for other students
$sqlSelectEmail = "SELECT COUNT(*) AS emailCount FROM student WHERE Email = '$Email' AND Student_Id != '$Student_Id'";

// Execute the query
$result = mysqli_query($conn, $sqlSelectEmail);

// Check if the query was successful
if ($result) {
    // Fetch the result
    $row = mysqli_fetch_assoc($result);
    
    // Check if the email count is greater than or equal to 1
    if ($row['emailCount'] >= 1) {
        header("location:student_profile.php?error=Update Fail due to email have been used by other student!");
    exit;
    }
} 
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

?>