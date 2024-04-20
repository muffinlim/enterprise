<?php
include('../DatabaseConnection.php');

// Check if the 'File_Id' is set in the POST data
if(isset($_GET['File_Id'])) {
    // Get the 'File_Id' from the POST data
    $File_Id = $_GET['File_Id'];


    // Construct the SQL query to select the file path
    $sql_select_file = "SELECT File_Link FROM file_management WHERE File_Id='$File_Id'";
    $result = mysqli_query($conn, $sql_select_file);
    if($row = mysqli_fetch_assoc($result)) {

        
        // $path_store="C:/xampp/htdocs/GitHub/enterprise/download_upload_file/".$row['File_Link'];
        $path_store="C:/xampp/htdocs/enterprise/download_upload_file/".$row['File_Link'];

        // Delete the file from the storage location
        if(unlink($path_store)) {
            // Construct the SQL query to delete the record
            $sql_delete = "DELETE FROM file_management WHERE File_Id='$File_Id'";

            // Execute the SQL query
            if(mysqli_query($conn, $sql_delete)) {
                
            header("location:student_file.php?success=File remove successfull!");

            } else {
                echo "Error deleting record: " . mysqli_error($conn);
            }
        } else {
            echo "Error deleting file";
        }
    } else {
        echo "File not found";
    }
} else {
    echo "File_Id is not set in the POST data";
}
?>
