<?php
session_start();
include('../DatabaseConnection.php');
if($_SERVER["REQUEST_METHOD"]=="POST"){
   $Lecturer_Id=$_SESSION['Lecturer_Id'];
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
   WHERE Email='$Email' AND Id!='$Lecturer_Id'";
   

if(mysqli_num_rows(mysqli_query($conn,$sqlCheckEmail))>=1){
// the id or the email have been used
header("location:lecturer_profile.php?error=Register fail due to the the email have been used.");

}else{

    if(empty($Password)&&empty($Repeat_Password)){
    
        $sqlUpdatelecturerInformation="UPDATE lecturer
       SET Lecturer_Name = '$Name', Email = '$Email'
       WHERE Lecturer_Id='$Lecturer_Id'";
        
        $conn->query($sqlUpdatelecturerInformation);
        
        header("location:lecturer_profile.php?success=Updated lecturer profile successfull!");
    
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
   
}

?>