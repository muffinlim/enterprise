<?php 
    include('LoginHeader.php');
  ?>

  <div class="login-container">
    <h2 class="text-center">Admin Login</h2>
    <form id="loginForm" action="admin_login_request.php" method="POST">
      <div class="form-group">
        <label for="username">Admin ID:</label>
        <input type="text" class="form-control" id="admin_login_id" name="admin_login_id" placeholder="AdminCode">
      </div>
      <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" class="form-control" id="admin_password" name="admin_password" required>
      </div>
      
      
      <button type="submit" name="submit" class="btn btn-primary btn-block" name="login">log in</button>
    </form>
  </div>
</body>
</html>
