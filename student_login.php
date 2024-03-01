  <?php 
    include('LoginHeader.php');
  ?>

  <div class="login-container">
    <h2 class="text-center">LimYONGKHN Login</h2>
    <form id="loginForm" action="Login.php" method="POST">
      <div class="form-group">
        <label for="username">Student Code:</label>
        <input type="text" class="form-control" id="student_login_id" name="student_login_id" placeholder="StudentCode">
      </div>
      <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" class="form-control" id="password" name="password" required>
      </div>
      
      <input type="submit" value="Login" class="btn btn-primary btn-block">
    </form>
  </div>
</body>
</html>
