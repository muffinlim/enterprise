<!-- admin_register_user.php -->
<?php
  $pageTitle = "Student | Upload File";
  $customCssFile = '../Styles/admin_register_user.css';
  session_start();
  $Student_Id=$_SESSION['Student_Id'];
  $Student_Login_Id=$_SESSION['Student_Login_Id'];
  include('../Header/head.php');
  include('../Header/student_navibar.html');
  include('../DatabaseConnection.php');
  date_default_timezone_set('Asia/Kuala_Lumpur');
  $currentDateTime = date("Y-m-d H:i:s");
  


    //   add a check for ensure the student have been grouped if no grouped prompt message ask for admin group first.
    $sqlSelectStudentGroup="";
    
    if(isset($_POST['Upload'])){
     
        $date_upload=$_POST['date_upload'];
        $file_title=$_POST['file_title'];
        $Lecturer_Login_Id=$_POST['Lecturer_Login_Id'];
        // get file name uploaded
        $file_upload=$_FILES['file_upload']['name'];
        //tempe file
        $file_upload_tmp=$_FILES['file_upload']['tmp_name'];
        //the part you store the upload file must in your code file
        // $path_store="C:/xampp/htdocs/GitHub/enterprise/download_upload_file/".$file_upload;
        $path_store="C:/xampp/htdocs/GitHub/enterprise/download_upload_file/".$file_upload;

          // block if the file name have been use same name
          $sqlSelectFileName="SELECT * FROM file_management WHERE File_Link='$file_upload'";
          $resultSelectFileName = mysqli_query($conn, $sqlSelectFileName);
          if ($resultSelectFileName->num_rows > 1) {
            echo "<script>alert('Upload file fail please rename the file the file name have been used');</script>";
          }else{        
        
        $sqlInsertFile="INSERT INTO file_management(File_Link,File_Title,Uploaded_Date,Upload_Id ,Received_Id) VALUES ('$file_upload','$file_title','$date_upload','$Student_Login_Id','$Lecturer_Login_Id')";
        $runsqlInsertFile=mysqli_query($conn,$sqlInsertFile);
        if($runsqlInsertFile){
            // if can insert upload file into the part we store
            move_uploaded_file($file_upload_tmp,$path_store);
            header("location:student_file.php?success=File upload successfull!");
}else{
    echo "error".mysqli_error($conn);
}

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
    $sqlSelectGroup = "SELECT * 
    FROM group_student_lecturer 
    INNER JOIN lecturer ON group_student_lecturer.Lecturer_Id = lecturer.Lecturer_Id 
    WHERE Student_Id='$Student_Id'";
    
   
    // Execute the query
    $result = mysqli_query($conn, $sqlSelectGroup);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        $Lecturer_Login_Id=$row['Lecturer_Login_Id'];
        
    
?>

    <input type="hidden" name="Lecturer_Login_Id" value="<?php echo $Lecturer_Login_Id;?>">

<?php 
    }    
            ?>
      <button type="submit" name="Upload" id="submit">Upload</button>
    </form>

</div>


</body>
</html>