<!-- admin_register_user.php -->
<?php
  $pageTitle = "Lecturer | Upload File";
  $customCssFile = '../Styles/admin_register_user.css';
  session_start();
  $Lecturer_Id=$_SESSION['Lecturer_Id'];
  $Lecturer_Login_Id=$_SESSION['Lecturer_Login_Id'];
  include('../Header/head.php');
  include('../Header/lecturer_navibar.html');
  include('../DatabaseConnection.php');
  date_default_timezone_set('Asia/Kuala_Lumpur');
  $currentDateTime = date("Y-m-d H:i:s");
  


    //   add a check for ensure the lecturer have been grouped if no grouped prompt message ask for admin group first.
    $sqlSelectLecturerGroup="";
    
    if(isset($_POST['Upload'])){
     
        $date_upload=$_POST['date_upload'];
        $file_title=$_POST['file_title'];
        $Student_Login_Id=$_POST['Student_Login_Id'];
        // get file name uploaded
        $file_upload=$_FILES['file_upload']['name'];
        //tempe file
        $file_upload_tmp=$_FILES['file_upload']['tmp_name'];
        //the part you store the upload file must in your code file
        // $path_store="C:/xampp/htdocs/GitHub/enterprise/download_upload_file/".$file_upload;
        $path_store ="C:/xampp/htdocs/enterprise/download_upload_file/".$file_upload;

          // block if the file name have been use same name
          $sqlSelectFileName="SELECT * FROM file_management WHERE File_Link='$file_upload'";
          $resultSelectFileName = mysqli_query($conn, $sqlSelectFileName);
          if ($resultSelectFileName->num_rows > 1) {
            echo "<script>alert('Upload file fail please rename the file the file name have been used');</script>";
          }else{        
        
        $sqlInsertFile="INSERT INTO file_management(File_Link,File_Title,Uploaded_Date,Upload_Id ,Received_Id) VALUES ('$file_upload','$file_title','$date_upload','$Lecturer_Login_Id','$Student_Login_Id')";
        $runsqlInsertFile=mysqli_query($conn,$sqlInsertFile);
        if($runsqlInsertFile){
            // if can insert upload file into the part we store
            move_uploaded_file($file_upload_tmp,$path_store);
           
    header("location:lecturer_file.php?success=File upload successfull!");
        
}else{
    echo "error".mysqli_error($conn);
}

    }
}


?>

<body>
<div class="admin-container mt-4">
<h2>Lecturer - Upload File</h2>

    <form id="UploadFileForm" method="post" enctype="multipart/form-data">
 
    <label for="file_title">File Title:</label>
    <input type="text" id="file_title" name="file_title" required>
      
    <label for="file_upload">File Upload:</label>
    <input type="file" name="file_upload" id="file_upload" required>
    
    <!--value is current date  -->
    <input type="hidden" name="date_upload" value="<?php echo $currentDateTime;?>">
    
    <label for="student_received">Student:</label>
    <!-- select out the student belong to the lecturer group -->
    <select name="Student_Login_Id" required>
    <?php 
    // SQL query to select data from group_student_lecturer based on student_Id
    $sqlSelectGroup = "SELECT * FROM group_student_lecturer INNER JOIN student  ON group_student_lecturer.Student_Id= student.Student_Id WHERE Lecturer_Id='$Lecturer_Id'";
    
   
    // Execute the query
    $result = mysqli_query($conn, $sqlSelectGroup);
    if (mysqli_num_rows($result) > 0) {
        // Loop through each row in the result set
        while ($row = mysqli_fetch_assoc($result)) {
?>
<!-- select the student received -->
    <option value="<?php echo $row['Student_Login_Id'];?>"><?php echo $row['Student_Login_Id'];?> </option>
<?php 
        }
    }
            ?>
            </select>
      <button type="submit" name="Upload" id="submit">Upload</button>
    </form>

</div>


</body>
</html>