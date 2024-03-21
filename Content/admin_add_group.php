<!-- admin_register_user.php -->
<?php
  $pageTitle = "Admin | Edit Group";
  $customCssFile = '../Styles/admin_register_user.css';

  include('../Header/head.php');
  include('../Header/admin_navibar.html');
  include('../DatabaseConnection.php');

?>

<body>
<div class="admin-container mt-4">
<h2>Admin - Add Group</h2>

    <form id="registrationForm" method="post">
 
    <label for="program">Program:</label>
    
    <select>
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
             <option value=""></option>
    </select>
   
    
    <!-- use ajax to change the student list -->
    <select name="student_list[]" multiple>
      <option disabled class="header">Student List</option>
    <option value=""></option> 
    </select>
     
      
    <button type="submit" name="submit" id="submit">Add List</button>

    </form>

</div>


</body>
</html>