<?php
include('../DatabaseConnection.php');
if(isset($_GET['LoginId'])){
    // delete all from lecturer and student where the login_id is = LoginId
$Login_Id=$_GET['LoginId'];
    
        $sqlstudent="DELETE FROM student WHERE Student_Login_Id='$Login_Id'";
        $sqllecturer="DELETE FROM lecturer WHERE Lecturer_Login_Id='$Login_Id'";
    
        if(mysqli_query($conn,$sqlstudent) ){
           header("location:admin_account.php?success=student account removed successfull!");
          
        }
        
        if(mysqli_query($conn,$sqllecturer)){
               header("location:admin_account.php?success=student account removed successfull!");
             
            }
            
    
}
?>