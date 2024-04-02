  <?php 
    include('LoginHeader.php');
    include('DatabaseConnection.php');
  
  ?>

  <div class="login-container">
    <h2 class="text-center">Login</h2>
    <form id="loginForm" action="student_login_request.php" method="POST">
      <div class="form-group">
        <label for="username">Student Id:</label>
        <input type="text" class="form-control" id="student_login_id" name="Student_Login_Id" placeholder="StudentCode" required>
      </div>
      <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" class="form-control" id="password" name="Student_Password" required>
      </div>
      
      <button type="submit" name="submit" class="btn btn-primary btn-block" name="login">log in</button>
      
    </form>
  </div>
</body>
</html>
