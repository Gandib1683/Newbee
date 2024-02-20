<?php
include "controlluserdata.php"
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Form</title>
  <link rel="stylesheet" href="../css/login.css">
  <script src="https://kit.fontawesome.com/e6ec068722.js" crossorigin="anonymous"></script>
</head>
<body>
  <div class="wrapper">
    <form action="" method="POST">
      <h1>Login</h1>
      <!--Error and Success msz display-->
      <span class="error-txt"><?php echo $fieldError; ?></span>
      <div class="input-box">
        <input type="text" name="email" placeholder="Email">
        <i class="fa-solid fa-envelope"></i>
        <!--Error and Success msz display-->
      <span class="error-txt"><?php echo $emailError; ?></span>
      </div>
      <div class="input-box">
        <input type="password" name="password" placeholder="Password">
        <i class="fa-solid fa-lock"></i>
        <!--Error and Success msz display-->
      <span class="error-txt"><?php echo $passwordError; ?></span>
      </div>
      <div class="remember-forgot">
        <label><input type="checkbox">Remember Me</label>
        <a href="#">Forgot Password</a>
      </div>
      <button type="submit" name="login" class="btn">Login</button>
      <div class="register-link">
        <p>Dont have an account? <a href="register.php">Register</a></p>
      </div>
    </form>
  </div>
</body>
</html>