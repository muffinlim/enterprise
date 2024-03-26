<?php
session_start();
include('../DatabaseConnection.php');
if($_SERVER["REQUEST_METHOD"]=="POST"){
   $Student_Id=$_SESSION['Student_Id'];
   $Name=$_POST['Name'];
   $Email=$_POST['Email'];
   $Password=$_POST['Password'];
 
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
        // Display alert message
        echo "<script>alert('Update Fail due to email have been used by other student!');";
    // Redirect to admin_group.php using JavaScript
    echo "window.location.href = 'student_profile.php';";
    echo "</script>";
    exit;
    }
} 
   if(empty($Password)){
    
    $sqlUpdateStudentInformation="UPDATE student
   SET Student_Name = '$Name', Email = '$Email'
   WHERE Student_Id='$Student_Id'";
    
    $conn->query($sqlUpdateStudentInformation);
    
    echo "<script>alert('Updated student profile successfull!');";
    // Redirect to admin_group.php using JavaScript
    echo "window.location.href = 'student_profile.php';";
    echo "</script>";;

   }else{
    $Password = password_hash($Password, PASSWORD_DEFAULT);
   $sqlUpdateStudentInformation="UPDATE student
   SET Student_Name = '$Name', Email = '$Email',Student_Password='$Password'
   WHERE Student_Id='$Student_Id'";
    
    $conn->query($sqlUpdateStudentInformation);
    echo "<script>alert('Updated student profile successfull!');";
    // Redirect to admin_group.php using JavaScript
    echo "window.location.href = 'student_profile.php';";
    echo "</script>";;

// $stmt->close();
    $conn->close();
}
}

?>