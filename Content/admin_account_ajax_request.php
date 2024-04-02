<?php
include('../DatabaseConnection.php');

if(isset($_POST['request'])){
    $request = $_POST['request'];

    $sql = "";
    
    if($request == "Student" || $request == "All") {
        $sql .= "SELECT s.Student_Id AS Id, s.Student_Name AS Name, s.Email, s.Student_Login_Id AS LoginId, p.Program_name AS ProgramName 
                FROM student s 
                INNER JOIN program p ON s.Program_Id = p.Program_Id";
    } 
    
    if($request == "Lecturer" || $request == "All") {
        if ($sql != "") {
            $sql .= " UNION ";
        }
        $sql .= "SELECT l.Lecturer_Id AS Id, l.Lecturer_Name AS Name, l.Email, l.Lecturer_Login_Id AS LoginId, p.Program_name AS ProgramName 
                FROM lecturer l 
                INNER JOIN program p ON l.Program_Id = p.Program_Id";
    }

    $result = mysqli_query($conn, $sql);
    $count = 0;
    $output = '';

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $count++;
            $output .= "<tr>";
            $output .= "<th scope='row'>$count</th>";
            $output .= "<td>{$row['ProgramName']}</td>"; // Assuming 'ProgramName' is consistent in both tables
            $output .= "<td>{$row['Name']}</td>";
            $output .= "<td>{$row['Email']}</td>";
            $output .= "<td>{$row['LoginId']}</td>";
            $output .= "<td> <a href=admin_remove_account.php?LoginId={$row['LoginId']} class='btn btn-danger'>Remove <i class='fa fa-trash' aria-hidden='true'></i></a></td>";
            $output .= "</tr>";
        }
    }
    echo $output;
}
?>
