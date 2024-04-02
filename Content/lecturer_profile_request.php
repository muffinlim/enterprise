<?php
session_start();
include('../DatabaseConnection.php');
if($_SERVER["REQUEST_METHOD"]=="POST"){
   $Lecturer_Id=$_SESSION['Lecturer_Id'];
   $Name=$_POST['Name'];
   $Email=$_POST['Email'];
   $Password=$_POST['Password'];
   $Repeat_Password=$_POST['Repeat_Password'];
// SQL query to check if the email exists for other lecturers
$sqlSelectEmail = "SELECT COUNT(*) AS emailCount FROM lecturer WHERE Email = '$Email' AND Lecturer_Id != '$Lecturer_Id'";

// Execute the query
$result = mysqli_query($conn, $sqlSelectEmail);

// Check if the query was successful
if ($result) {
    // Fetch the result
    $row = mysqli_fetch_assoc($result);
    // here need to check the email for both
    
    // Check if the email count is greater than or equal to 1
    if ($row['emailCount'] >= 1) {
        header("location:lecturer_profile.php?error=Update Fail due to email have been used by other lecturer!");
    exit;
    }
} 
   if(empty($Password)&&empty($Repeat_Password)){
    
    $sqlUpdatelecturerInformation="UPDATE lecturer
   SET Lecturer_Name = '$Name', Email = '$Email'
   WHERE Lecturer_Id='$Lecturer_Id'";
    
    $conn->query($sqlUpdatelecturerInformation);
    
    header("location:student_profile.php?success=Updated lecturer profile successfull!");

   }else{
            if($Password==$Repeat_Password) {
    $Password = password_hash($Password, PASSWORD_DEFAULT);
   $sqlUpdatelecturerInformation="UPDATE lecturer
   SET Lecturer_Name = '$Name', Email = '$Email',Lecturer_Password='$Password'
   WHERE Lecturer_Id='$Lecturer_Id'";
    
    $conn->query($sqlUpdatelecturerInformation);
    header("location:lecturer_profile.php?success=Updated lecturer profile successfull!");

// $stmt->close();
    $conn->close();
            }else{
                header("location:lecturer_profile.php?error=Updated lecturer profile fail due to the password and repeat does not match!");
            }
        }
}

?>