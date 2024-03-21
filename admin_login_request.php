<?php 
include('LoginHeader.php');
include('DatabaseConnection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $admin_login_id = $_POST['admin_login_id'];
    $admin_password = $_POST['admin_password'];
    
    // Query to select admin account based on provided login id and password
    $query = "SELECT * FROM admin_account WHERE Admin_Login_Id='$admin_login_id' AND Admin_Password='$admin_password'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $num_rows = mysqli_num_rows($result);
        if ($num_rows > 0) {
            // Redirect to admin dashboard if admin account is found
            header("Location: ../enterprise/Content/admin_dashboard_content.php");
            exit();
        } else {
            echo "cannot get it";
            exit();
        }
    } else {
        // Redirect back to login page if query execution fails
        header("Location: student_login.php?error=query_error");
        exit();
    }
} else {
    // Redirect back to login page if request method is not POST
    header("Location: student_login.php");
    exit();
}

// Close database connection
mysqli_close($conn);
?>
