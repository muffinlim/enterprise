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

    <form id="registrationForm" method="post">
 
    <label for="program">Program: <?php echo $program_name;?></label>
 
    <label for="lecturer">Lecturer:</label>
      <select id="lecturer" name="lecturer" required>
      <option value="<?php echo $lecturer_id; ?>" selected><?php echo $lecturer_name; ?></option>

      <?php
   $sql = "SELECT DISTINCT lecturer.Lecturer_Id, lecturer.Lecturer_Name 
   FROM lecturer 
   INNER JOIN program ON lecturer.Program_Id = program.Program_Id 
   WHERE program.Program_Id = '$program_id' AND lecturer.Lecturer_Id!='$lecturer_id'";

    $result=mysqli_query($conn,$sql);           
        // Loop through each row in the result set
        while ($row = mysqli_fetch_assoc($result)) {
           ?>
             <option value="<?php echo $row['Lecturer_Id']?>"><?php echo $row['Lecturer_Name'];?></option>
           <?php
        }
    
    ?>
    </select>
    <select name="student_list[]" multiple>
      <option disabled class="header">Student List</option>
      <?php
      $student_list=array();

    $sql2="SELECT * FROM student WHERE student.Program_Id='$program_id'";
    $result2=mysqli_fetch_assoc($sql2);
    while($row=mysqli_fetch_assoc($result)){  
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