<?php
include('../DatabaseConnection.php');
if(isset($_GET['LoginId'])){
    // delete all from lecturer and student where the login_id is = LoginId
$Login_Id=$_GET['LoginId'];
    
        $sqlstudent="DELETE FROM student WHERE Student_Login_Id='$Login_Id'";
        $sqllecturer="DELETE FROM lecturer WHERE Lecturer_Login_Id='$Login_Id'";
    
        if(mysqli_query($conn,$sqlstudent) || mysqli_query($conn,$sqllecturer)){
            echo "<script>alert('Account remove successfull!');";
            // Redirect to admin_group.php using JavaScript
            echo "window.location.href = 'admin_account.php';";
            echo "</script>";;
        }else{
            echo "<script>alert('Account remove fail!');";
            // Redirect to admin_group.php using JavaScript
            echo "window.location.href = 'admin_account.php';";
            echo "</script>";;
        }
    
}
?>