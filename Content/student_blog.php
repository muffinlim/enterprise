<?php
$pageTitle = "Blog";

session_start();

$Student_Id=$_SESSION['Student_Id'];

include('../Header/head.php');
include('../Header/Student_navibar.html');
include('../DatabaseConnection.php');

// Check if the student is logged in
if (!isset($_SESSION['Student_Id'])) {
    // Redirect to login page if not logged in
    header("Location: student_login.php");
    exit();
}

// Check if the form is submitted to create a new blog post
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    // Connect to the database
    $host = "localhost";
   $dbusername = "root";
   $dbpassword = "";
   $dbname = "etutoring";

   $conn = new mysqli($host,$dbusername,$dbpassword,$dbname);

   if($conn -> connect_error){
       die("Connection Failed: ". $conn -> connect_error);
   }

    // Get form data
    $student_id = $_SESSION['Student_Id'];
    $lecturer_id = 1; // Assuming lecturer_id is fixed for all students
    $blog_post = $_POST['blog_post'];
    $post_image = $_FILES['post_image']["name"];
  

    $query=mysqli_query($conn,"select max(Blog_Id) as bid from blog");
	$result=mysqli_fetch_array($query);
	 $blogid=$result['bid']+1;
	$dir="uploads/$blogid";
if(!is_dir($dir)){
		mkdir("uploads/".$blogid);
	}

    move_uploaded_file($_FILES["post_image"]["tmp_name"],"uploads/$blogid/$post_image");

    $sql = mysqli_query($conn, "INSERT INTO blog (Student_Id, Lecturer_Id, Date, Blog_Post, Post_Image) VALUES ('$student_id', '$lecturer_id', NOW() , '$blog_post', '$post_image')");

    $_SESSION['msg']="Blog upload Successfully !!";

}

// Check if the student wants to delete a blog
if (isset($_POST['delete']) && isset($_POST['blog_id'])) {
    // Connect to the database
    $host = "localhost";
   $dbusername = "root";
   $dbpassword = "";
   $dbname = "etutoring";

   $conn = new mysqli($host,$dbusername,$dbpassword,$dbname);

   if($conn -> connect_error){
       die("Connection Failed: ". $conn -> connect_error);
   }

    // Get blog id and student id
    $blog_id = $_POST['blog_id'];
    $student_id = $_SESSION['Student_Id'];

    // Delete the blog if the student is the owner
    $sql = "DELETE FROM blog WHERE Blog_Id = ? AND Student_Id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $blog_id, $student_id);
    $stmt->execute();

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Page</title>
</head>
<body>
    <h1>Create Blog Post</h1>
    <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>" enctype="multipart/form-data">
        <textarea name="blog_post" rows="5" cols="50" required></textarea><br>
        <input type="file" name="post_image" id="post_image" required><br>
        <button type="submit" name="submit">Publish</button>
    </form>

    <hr>

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
            echo "<div>";
            echo "<p><strong>Date:</strong> " . $row["Date"] . "</p>";
            echo "<p><strong>Blog Post:</strong> " . $row["Blog_Post"] . "</p>";
            echo '<img src="uploads/' . htmlentities($row['Blog_Id']) . '/' . htmlentities($row['Post_Image']) . '" 
     width="180" height="300" alt=""><br/>';

             // Display comments for the blog post
        echo "<h3>Comments:</h3>";
        $blog_id = $row["Blog_Id"];
        $comment_sql = "SELECT student.Student_Name, comment.Comment_Detail FROM comment JOIN student ON comment.Student_Id = student.Student_Id WHERE comment.Blog_Id = $blog_id";
        $comment_result = $conn->query($comment_sql);
        if ($comment_result->num_rows > 0) {
            while ($comment_row = $comment_result->fetch_assoc()) {
                echo "<p><strong>" . $comment_row["Student_Name"] . ":</strong> " . $comment_row["Comment_Detail"] . "</p>";
            }
        } else {
            echo "<p>No comments yet.</p>";
        }
            

        echo "<form method='POST' action='submit_comment.php'>";
        echo "<input type='hidden' name='blog_id' value='" . $row["Blog_Id"] . "'>";
        echo "<textarea name='comment' placeholder='Enter your comment'></textarea><br>";
        echo "<button type='submit' name='submit_comment'>Submit Comment</button>";
        echo "</form>";

        
            // Display delete button for the student's own blogs
            if ($row["Student_Id"] == $_SESSION['Student_Id']) {
                echo "<form method='POST' action='" . $_SERVER["PHP_SELF"] . "'>";
                echo "<input type='hidden' name='blog_id' value='" . $row["Blog_Id"] . "'>";
                echo "<button type='submit' name='delete'>Delete</button>";
                echo "</form>";
            }

            echo "<hr>";
            echo "</div>";
        }
    } else {
        echo "No published blogs yet.";
    }

    $conn->close();
    ?>
</body>
</html>
