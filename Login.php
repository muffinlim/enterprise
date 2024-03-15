<?php
session_start();
if($_SERVER["REQUEST_METHOD"]=="POST"){
<<<<<<< Updated upstream
    $username = $_POST["username"];
    $password = $_POST["password"];
    $user_type_id = $_POST["usertype"];

    $host = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "etutor_database";

    $conn = new mysqli($host,$dbusername,$dbpassword,$dbname);

    if($conn -> connect_error){
        die("Connection Failed: ". $conn -> connect_error);
=======
   
   
      $Student_Login_Id = $_POST["Student_Login_Id"];
      $Student_Password = $_POST["Student_Password"];
    $query=mysqli_query($conn,"SELECT * FROM student WHERE Student_Login_Id='$Student_Login_Id' and Student_Password='$Student_Password'");
    $num=mysqli_fetch_array($query);
    if($num>0)
    {
    echo "Student Dashboard";
    // header("location:student_dashboard_content.php");
    exit();
>>>>>>> Stashed changes
    }

    $query = "SELECT * FROM users WHERE username = ? AND password = ? AND user_type_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssi", $username, $password, $user_type_id); // "ssi" indicates two string parameters and one integer
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
    // Set user role for future use
    $_SESSION['userRole'] = $user['user_type_id'];
    $_SESSION['userId'] = $user['id'];

        header("Location: ../enterprise/Content/dashboard.php");
        exit(); // Stop further execution
    } else {
        echo '<script>
                alert("Invalid credentials. Please try again.");
                window.location.href = "Login.html"; // Replace with the actual path to your login page
              </script>';
    }

    $stmt->close();
    $conn->close();
}

?>