<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_comment'])) {
    // Get the form data
    $blog_id = $_POST['blog_id'];
    $comment_detail = $_POST['comment'];

    // Database connection
    $host = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "etutoring";

    $conn = new mysqli($host, $dbusername, $dbpassword, $dbname);

    if ($conn->connect_error) {
        die("Connection Failed: " . $conn->connect_error);
    }

    // Insert the comment into the database
    session_start();
    $Lecturer_Id=$_SESSION['Lecturer_Id'];
    $sql = "INSERT INTO comment (Blog_Id, Lecturer_Id, Comment_Detail) VALUES ('$blog_id', '$Lecturer_Id', '$comment_detail')";

    if ($conn->query($sql) === TRUE) {
        echo "Comment submitted successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
