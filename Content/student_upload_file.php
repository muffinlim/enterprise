<!-- admin_register_user.php -->
<?php
  $pageTitle = "Student | Upload File";
  $customCssFile = '../Styles/admin_register_user.css';
  session_start();
  $Student_Id=$_SESSION['Student_Id'];
  include('../Header/head.php');
  include('../Header/admin_navibar.html');
  include('../DatabaseConnection.php');
  date_default_timezone_set('Asia/Kuala_Lumpur');
  $currentDateTime = date("Y-m-d H:i:s");
  $lecturer_received=$_POST['lecturer_received'];


    //   add a check for ensure the student have been grouped if no grouped prompt message ask for admin group first.
    $sqlSelectStudentGroup="";
    
    if(isset($_POST['Upload'])){
        $date_upload=$_POST['date_upload'];
        $file_title=$_POST['file_title'];

        // get file name uploaded
        $file_upload=$_FILES['file_upload']['name'];
        //tempe file
        $file_upload_tmp=$_FILES['file_upload']['tmp_name'];
        //the part you store the upload file must in your code file
        $path_store="C:/xampp/htdocs/GitHub/enterprise/download_upload_file/".$file_upload;
        $sqlInsertFile="INSERT INTO file_management(File_Link,File_Title,Uploaded_Date,Upload_Id ,Received_Id) VALUES ('$file_upload','$file_title','$date_upload','$Student_Id','$lecturer_received')";
        $runsqlInsertFile=mysqli_query($conn,$sqlInsertFile);
if($runsqlInsertFile){
    // if can insert upload file into the part we store
    move_uploaded_file($file_upload_tmp,$path_store);
echo "upload successfull";
}else{
    echo "error".mysqli_error($conn);
}

    }
 
?>

<body>
<div class="admin-container mt-4">
<h2>Student - Upload File</h2>

    <form id="UploadFileForm" method="post" enctype="multipart/form-data">
 
    <label for="file_title">File Title:</label>
    <input type="text" id="file_title" name="file_title" required>
      
    <label for="file_upload">File Upload:</label>
    <input type="file" name="file_upload" id="file_upload" required>
    
    <!--value is current date  -->
    <input type="hidden" name="date_upload" value="<?php echo $currentDateTime;?>">
    
    <!--value is student_id for store in student_id-->
    <input type="hidden" name="student_upload" value="<?php echo $Student_Id;?>">
    <!-- select the student belong to which lecturer using group table -->
    <?php 
    // SQL query to select data from group_student_lecturer based on Student_Id
    $sqlSelectGroup = "SELECT * FROM group_student_lecturer WHERE Student_Id='$Student_Id'";
    
    // Execute the query
    $result = mysqli_query($conn, $sqlSelectGroup);

    // Check if the query was successful
    if ($result) {
        // Fetch the row as an associative array
        $row = mysqli_fetch_assoc($result);

        // Check if a row was fetched
        if ($row) {
            // Output the value of Lecturer_Id
            echo '<input type="hidden" name="lecturer_received" value="' . $row['Lecturer_Id'] . '">';
        } else {
            // the student not group yet
            echo "<script>alert('Please ask admin to group you to lecturer');";
            // Redirect to admin_group.php using JavaScript
            echo "window.location.href = 'student_file.php';";
            echo "</script>";
            
        }
    } else {
        echo "Error executing query: " . mysqli_error($conn);
    }
?>


      <button type="submit" name="Upload" id="submit">Upload</button>
    </form>

</div>


</body>
</html>