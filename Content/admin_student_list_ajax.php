<?php

include('../DatabaseConnection.php');
if(!empty($_POST['program_selected'])){
    $program = $_POST['program_selected'];
    $sql = "SELECT * FROM student WHERE Program_Id='$program'";
    $result = mysqli_query($conn, $sql);

    $student_selected = array(); // Corrected array declaration

    while($row = mysqli_fetch_assoc($result)){ // Corrected variable name to $result
        $student_selected[] = array(
            'value' => $row['Student_Id'], // Corrected semicolon to a comma
            'text' => $row['Student_Name'] // Corrected semicolon to a comma
        );
    }

    $change_html = '';
    $change_html .= '<option value=""  disabled class="head_option">Student List</option>';

    foreach($student_selected as $student_select){ // Changed the loop variable name
        $change_html .= '<option value="' . $student_select['value'] . '">' . $student_select['text'] . '</option>';
    }
    echo $change_html;
} else {
    $change_html = '';
    $change_html .= '<option value=""  disabled class="head_option">Student List Enroll The Subject</option>';
    echo $change_html;
}

?>
