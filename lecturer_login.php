<?php 
    include('LoginHeader.php');
    include('DatabaseConnection.php');
  ?>

  <div class="login-container">
    <h2 class="text-center">Lecture Login</h2>
    <form id="loginForm" action="lecturer_login_request.php" method="POST">
      <div class="form-group">
        <label for="username">Lecturer Id:</label>
        <input type="text" class="form-control" id="lecturer_login_id" name="Lecturer_Login_Id" placeholder="Lecturer Code" required>
      </div>
      <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" class="form-control" id="password" name="Lecturer_Password" required>
      </div>
      
      <button type="submit" name="submit" class="btn btn-primary btn-block" name="login">log in</button>
      
    </form>
  </div>
</body>
</html>
