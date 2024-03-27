<?php
include('../DatabaseConnection.php');
if(isset($_POST['submit']))
{

    $success = false; // Initialize the success flag
//  if the button click i want to check wheater the student list in group list or not 
//if in gorup list not allow edit must edit the 
//prompt a message to user ask them to remove the student in the lecturer list first
$student_list=$_POST['student_list'];
$program_id=$_POST['program_id'];
$lecturer_id=$_POST['lecturer_id'];

foreach($student_list as $student_id){
$sqlSelectStudentInGroup="SELECT * FROM group_student_lecturer WHERE Student_Id='$student_id'";
$resultsqlSelectStudentInGroup = mysqli_query($conn, $sqlSelectStudentInGroup);
    if (mysqli_num_rows($resultsqlSelectStudentInGroup) < 1) {
        $sql = "INSERT INTO group_student_lecturer (Student_Id, Lecturer_Id) VALUES ('$student_id', '$lecturer_id')";
        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Updated student list to lecturer successfull!');";
            // Redirect to admin_group.php using JavaScript
            echo "window.location.href = 'admin_group.php';";
            echo "</script>";
    } 
}else{
     // the student have been assign for other lecturer remove the record that have been assign to the lecturer 
    //and insert them in database 
    
    //remove the old group  
    $sqlDeleteOldGroup2="DELETE FROM group_student_lecturer WHERE Student_Id='$student_id'";
    mysqli_query($conn, $sqlDeleteOldGroup2);
    $sqlDeleteOldGroup="DELETE FROM group_student_lecturer WHERE Lecturer_Id='$lecturer_id'";
    mysqli_query($conn, $sqlDeleteOldGroup);

    

    
    // insert the new group
    $sqlInsertNewGroup = "INSERT INTO group_student_lecturer (Student_Id, Lecturer_Id) VALUES ('$student_id', '$lecturer_id')";
    if (mysqli_query($conn, $sqlInsertNewGroup)) {
        echo "<script>alert('Updated student list to lecturer successfull!');";
        // Redirect to admin_group.php using JavaScript
        echo "window.location.href = 'admin_group.php';";
        echo "</script>";
    }
}
}
 

}

?>