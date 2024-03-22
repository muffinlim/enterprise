<?php
include('../DatabaseConnection.php');
if(!empty($_POST['program_selected'])){
    $program = $_POST['program_selected'];
    $sql = "SELECT * FROM lecturer WHERE Program_Id='$program'";
    $result = mysqli_query($conn, $sql);

    if($result->num_rows > 0){
        echo '<option selected disabled value="">TBC</option>';
        while($row = mysqli_fetch_assoc($result)){
            echo '<option value="'.$row['Lecturer_Id'].'">'.$row['Lecturer_Name'].'</option>';
        }
    } else {
        echo '<option selected disabled value="">No lecturer belongs to this program</option>';
    }
} else {
    echo '<option disabled value="">Error</option>';
}
?>
