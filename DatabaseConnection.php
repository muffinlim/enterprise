<?php
   $host = "localhost";
   $dbusername = "root";
   $dbpassword = "";
   $dbname = "etutoring";

   $conn = new mysqli($host,$dbusername,$dbpassword,$dbname);

   if($conn -> connect_error){
       die("Connection Failed: ". $conn -> connect_error);
   }

?>