<!-- admin_register_user.php -->
<?php
  $pageTitle = "Admin | RegisterUser";
  $customCssFile = '../Styles/admin_register_user.css';

  include('../Header/head.php');
  include('../Header/header.html');

  if(isset($_POST['submit']))
{

  $name=$_POST['username'];
  $email=$_POST['email'];
  $password=$_POST['password'];
  $usertype=$_POST['usertype'];

  
  $conn = mysqli_connect("localhost","root","","etutor_database");
  $sql = "INSERT INTO users(username, email, password, user_type_id) VALUES ('" . $name . "', '" . $email . "', '" . $password . "', 
   '" . $usertype . "')";
       mysqli_query($conn, $sql);
	  
	  echo "<script>alert('success');</script>";
  

  
}
?>

<body>
<div class="admin-container mt-4">
<h2>Admin - Register User</h2>

    <form id="registrationForm" method="post">
      <label for="username">Username:</label>
      <input type="text" id="username" name="username" required>

      <label for="email">Email:</label>
      <input type="email" id="email" name="email" required>

      <label for="password">Password:</label>
      <input type="password" id="password" name="password" required>

      <label for="usertype">User Type:</label>
      <select id="usertype" name="usertype" required>
        <option value="student">Student</option>
        <option value="lecturer">Lecturer</option>
        <!-- Add more user types as needed -->
      </select>

      <button type="submit" name="submit" id="submit">sign up</button>
    </form>

</div>

<script>
    function registerUser() {
        var username = document.getElementById('username').value;
        var email = document.getElementById('email').value;
        var password = document.getElementById('password').value;
        var usertype = document.getElementById('usertype').value;
        // You would send the credentials and usertype to the server for validation
        // You can use AJAX to send a request to the server

        // For demonstration purposes, let's just display an alert with the user type
        alert('Login button clicked for ' + usertype + ': ' + username);
    }
  </script>

</body>
</html>