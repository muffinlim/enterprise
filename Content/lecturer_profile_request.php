<?php
session_start();
include('../DatabaseConnection.php');
if($_SERVER["REQUEST_METHOD"]=="POST"){
   $Lecturer_Id=$_SESSION['Lecturer_Id'];
   $Name=$_POST['Name'];
   $Email=$_POST['Email'];
   $Password=$_POST['Password'];
 
// SQL query to check if the email exists for other lecturers
$sqlSelectEmail = "SELECT COUNT(*) AS emailCount FROM lecturer WHERE Email = '$Email' AND Lecturer_Id != '$Lecturer_Id'";

// Execute the query
$result = mysqli_query($conn, $sqlSelectEmail);

// Check if the query was successful
if ($result) {
    // Fetch the result
    $row = mysqli_fetch_assoc($result);
    
    // Check if the email count is greater than or equal to 1
    if ($row['emailCount'] >= 1) {
        // Display alert message
        echo "<script>alert('Update Fail due to email have been used by other lecturer!');";
    echo "window.location.href = 'lecturer_profile.php';";
    echo "</script>";
    exit;
    }
} 
   if(empty($Password)){
    
    $sqlUpdatelecturerInformation="UPDATE lecturer
   SET Lecturer_Name = '$Name', Email = '$Email'
   WHERE Lecturer_Id='$Lecturer_Id'";
    
    $conn->query($sqlUpdatelecturerInformation);
    
    echo "<script>alert('Updated lecturer profile successfull!');";
    echo "window.location.href = 'lecturer_profile.php';";
    echo "</script>";;

   }else{
    $Password = password_hash($Password, PASSWORD_DEFAULT);
   $sqlUpdatelecturerInformation="UPDATE lecturer
   SET Lecturer_Name = '$Name', Email = '$Email',Lecturer_Password='$Password'
   WHERE Lecturer_Id='$Lecturer_Id'";
    
    $conn->query($sqlUpdatelecturerInformation);
    echo "<script>alert('Updated lecturer profile successfull!');";
    // Redirect to admin_group.php using JavaScript
    echo "window.location.href = 'lecturer_profile.php';";
    echo "</script>";;

// $stmt->close();
    $conn->close();
}
}

?>