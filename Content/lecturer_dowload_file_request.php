<?php
 include('../DatabaseConnection.php');
if(!empty($_GET['File_Link'])){
$File_Link=basename($_GET['File_Link']);
$path_store="C:/xampp/htdocs/GitHub/enterprise/download_upload_file/".$File_Link;

if(!empty($File_Link)&&file_exists($path_store)){

         header("Cache-Control: public");
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=$File_Link");
        header("Content-Type: application/zip");
        header("Content-Transfer-Encoding: binary");
        
        //read file 
        readfile($path_store);
        exit;
}else{
    $sqlDeletFile="DELETE FROM file_management WHERE File_Link='$File_Link'";
    mysqli_query($conn,$sqlDeletFile);
             echo "<script>alert('The file have been removed from the part you store!');";
            echo "window.location.href = 'lecturer_file.php';";
            echo "</script>";
     
    }
}


?>