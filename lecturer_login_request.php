<?php
session_start();
include('DatabaseConnection.php');
if($_SERVER["REQUEST_METHOD"]=="POST"){
   
   
      $Lecturer_Login_Id = $_POST["Lecturer_Login_Id"];
      $Lecturer_Password = $_POST["Lecturer_Password"];
    //   echo $Lecturer_Login_Id;
    //   echo $Lecturer_Password;
    $query=mysqli_query($conn,"SELECT * FROM lecturer WHERE Lecturer_Login_Id='$Lecturer_Login_Id'");
  
    if($query)
    {
      $row = mysqli_fetch_assoc($query); // Fetch the result as an associative array
      if($row) {
        $hashedPasswordFromDatabase = $row['Lecturer_Password'];
                
        // Use password_verify to compare the entered password with the hashed password
        if (password_verify($Lecturer_Password, $hashedPasswordFromDatabase)) {
        $_SESSION['Lecturer_Id'] = $row['Lecturer_Id']; 
        $_SESSION['Lecturer_Login_Id']=$Lecturer_Login_Id;
        
        header("location:../enterprise/Content/lecturer_dashboard_content.php");
        }else{
            echo "<script>alert('Wrong ID or Password');";
            echo "window.location.href = 'lecturer_login.php';";
            echo "</script>";
        }
        } else{
          echo "<script>alert('Lecturer not found in the system!');";
          echo "window.location.href = 'lecturer_login.php';";
          echo "</script>";
        }

    
    exit();
    }else
    {
    
    header("location:Lecturer_login.php");
    
    exit();
    }
   
    $stmt->close();
    $conn->close();
}

?>