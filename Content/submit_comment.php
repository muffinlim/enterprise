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
    $student_id = $_SESSION['Student_Id'];
    $sql = "INSERT INTO comment (Blog_Id, Student_Id, Comment_Detail) VALUES ('$blog_id', '$student_id', '$comment_detail')";

    if ($conn->query($sql) === TRUE) {
        echo "Comment submitted successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
