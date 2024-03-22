<!-- admin_register_user.php -->
<?php
  $pageTitle = "Admin | Edit Group";
  $customCssFile = '../Styles/admin_register_user.css';

  include('../Header/head.php');
  include('../Header/admin_navibar.html');
  include('../DatabaseConnection.php');

  
  if(isset($_POST['submit']))
{
  
  $program=$_POST['program'];
  $lecturer=$_POST['lecturer'];
  $student_list=$_POST['student_list'];
  
  foreach ($student_list as $student_id) {

    $sql="INSERT INTO group_student_lecturer (Student_Id,Lecturer_Id) VALUES('$student_id','$lecturer')";
    mysqli_query($conn,$sql);
  }
  
}
?>

<!-- code for ajax request -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
$(document).ready(function(){
  $("#program").on('change', function(){
    var program = $(this).val();
    if(program){
      $.ajax({
        type: 'POST',
        url: "admin_add_group_ajax.php",
        data: {
          program_selected: program 
        },
        success: function(html){
          $('#lecturer').html(html);
        }
      });
    }
  });
});      

$(document).ready(function(){
  $("#program").on('change', function(){
    var program = $(this).val();
    if(program){
      $.ajax({
        type: 'POST',
        url: "admin_student_list_ajax.php",
        data: {
          program_selected: program 
        },
        success: function(html){
          $('#student_list').html(html);
        }
      });
    }
  });
});      
    </script>
<body>
<div class="admin-container mt-4">
<h2>Admin - Add Group</h2>

    <form id="registrationForm" method="post">
 
    <label for="program">Program:</label>
    
    <select id="program" name="program">
    <option Selected value=""disabled>Select me to display the lecturer list and student list</option>
    <?php 
    $sql = "SELECT * FROM program";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
    ?>
    <option value="<?php echo $row['Program_Id']; ?>"><?php echo $row['Program_name']; ?></option>   
    <?php  
    } 
    ?> 
</select>


    <!-- use ajax to change the lecturer list -->
    <label for="lecturer">Lecturer:</label>
      <select id="lecturer" name="lecturer" required>
             <option Selected value=""disabled>select program first before group them </option>
    </select>
   
    
    <!-- use ajax to change the student list -->
    <select name="student_list[]" id="student_list" required multiple>
      <option disabled class="header">Student List</option>
    </select>
     
      
    <button type="submit" name="submit" id="submit">Add List</button>

    </form>

</div>


</body>
</html>