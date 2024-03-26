<!-- admin_register_user.php -->
<?php
  $pageTitle = "Admin | Edit Group";
  $customCssFile = '../Styles/admin_register_user.css';
  $lecturer_id=$_GET['lecturer_id'];
  $program_id=$_GET['program_id'];
  $program_name=$_GET['program_name'];
  $lecturer_name=$_GET['lecturer_name'];

  include('../Header/head.php');
  include('../Header/admin_navibar.html');
  include('../DatabaseConnection.php');

?>

<body>
<div class="admin-container mt-4">
<h2>Admin - Edit Group</h2>

    <form id="registrationForm"  action="admin_edit_group_request.php" method="post">
 
    <label for="program">Program: <?php echo $program_name;?></label>
    <input type="hidden" name="program_id" value="<?php echo $program_id;?>">
  
    <label for="lecturer">Lecturer: <?php echo $lecturer_name?></label>
    <input type="hidden" name="lecturer_id" value="<?php echo $lecturer_id;?>">
    
    <select name="student_list[]" multiple required>
      <option disabled class="header">Student List</option>
      <?php
    // sql select the student belong to the lecturer
    $sql2="SELECT * 
    FROM group_student_lecturer 
    INNER JOIN student ON group_student_lecturer.Student_Id = student.Student_Id 
    WHERE group_student_lecturer.Lecturer_Id = '$lecturer_id'";
  $result2=mysqli_query($conn,$sql2);
    while($row=mysqli_fetch_assoc($result2)){ 
         // hold one data  
    $StudentList=$row['Student_Id'];
    //pass the ta data hold by the studentList store into array
    $StudentLists[]=$StudentList;

    ?>
    <option value="<?php echo $row['Student_Id']?>" selected><?php echo $row['Student_Name'];?></option> 
    <?php 
    }
    $sql3="SELECT * FROM student WHERE Program_Id='$program_id'";
    foreach($StudentLists as $Student_Id){
    $sql3.="AND Student_Id!='$Student_Id'";
  }
    $result3=mysqli_query($conn,$sql3);
    while($row=mysqli_fetch_assoc($result3)){
?>
  <option value="<?php echo $row['Student_Id']?>"><?php echo $row['Student_Name'];?></option> 
<?php
    }
    
    ?>
    </select>
      
    <button type="submit" name="submit" id="submit">Update List</button>

    </form>

</div>


</body>
</html>