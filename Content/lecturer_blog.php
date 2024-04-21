<?php
$pageTitle = "Blog";

session_start();

$Lecturer_Id=$_SESSION['Lecturer_Id'];

include('../Header/head.php');
include('../Header/Lecturer_navibar.html');
include('../DatabaseConnection.php');

// Check if the student is logged in
if (!isset($_SESSION['Lecturer_Id'])) {
    // Redirect to login page if not logged in
    header("Location: lecturer_login.php");
    exit();
}




?>

<body>
<div class="container mt-5">
    <h1 class="mb-4">View Blog Post</h1>

    <?php
    // Display published blogs
    $host = "localhost";
   $dbusername = "root";
   $dbpassword = "";
   $dbname = "etutoring";

   $conn = new mysqli($host,$dbusername,$dbpassword,$dbname);

   if($conn -> connect_error){
       die("Connection Failed: ". $conn -> connect_error);
   }

    // Retrieve all published blogs
    $sql = "SELECT Blog_Id, Student_Id, Date, Blog_Post, Post_Image FROM blog ORDER BY Date DESC";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Output each published blog post
        while ($row = $result->fetch_assoc()) {
            echo "<div class='border border-secondary p-3 mb-3'>";
            echo "<p><strong>Blog Post:</strong> " . $row["Blog_Post"] . "</p>";
            echo "<div class='d-flex justify-content-center'>";
            echo '<img src="uploads/' . htmlentities($row['Blog_Id']) . '/' . htmlentities($row['Post_Image']) . '" class="img-fluid mb-3" style="max-width: 500px; height: 300px;" ><br/>';
            echo "</div>";
            echo "<p><strong>Date:</strong> " . $row["Date"] . "</p>";


             // Display comments for the blog post
             echo '<div class="border border-dark p-3 mb-3">';
        echo "<h3>Comments:</h3>";
        $blog_id = $row["Blog_Id"];
        $comment_sql = "SELECT lecturer.Lecturer_Name, comment.Comment_Detail FROM comment JOIN lecturer ON comment.Lecturer_Id = lecturer.Lecturer_Id WHERE comment.Blog_Id = $blog_id";
        $comment_result = $conn->query($comment_sql);
        if ($comment_result->num_rows > 0) {
            while ($comment_row = $comment_result->fetch_assoc()) {
                echo "<p><strong>" . $comment_row["Lecturer_Name"] . ":</strong> " . $comment_row["Comment_Detail"] . "</p>";
            }
        } else {
            echo "<p>No comments yet.</p>";
        }
        echo '</div>';
            

        echo "<form method='POST' action='submit_comment.php'>";
        echo "<input type='hidden' name='blog_id' value='" . $row["Blog_Id"] . "'>";
        echo "<textarea name='comment' placeholder='Enter your comment'></textarea><br>";
        echo "<button type='submit' class='btn btn-primary' name='submit_comment'>Submit Comment</button>";
        echo "</form>";

        
    
          

            echo "</div>";
        }
    } else {
        echo "No published blogs yet.";
    }

    $conn->close();
    ?>

</div>
</body>
</html>
