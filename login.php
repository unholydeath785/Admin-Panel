<?php
include_once 'Assets/Scripts/PHP/connect.php';
include_once 'Assets/Scripts/PHP/functions.php';

sec_session_start();

if (login_check($mysqli) == true) {
    $logged = 'in';
} else {
    $logged = 'out';
}

if ($logged == 'in') {
  header('home.html');
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Admin Log-in</title>
    <link rel="stylesheet" href="Assets/Styles/CSS/main.css" media="screen" title="no title" charset="utf-8">
  </head>
  <body>
    <?php
        if (isset($_GET['error'])) {
            echo '<p class="error">Error Logging In!</p>';
        }
    ?>
    <div class="fluid-container">
      <div class="login-container">
        <div class="login-row" id="row-1">
          <div class="login-info" id="col-1">
            <h2 class="site-title">MySite</h2>
            <div class="site-desc">An Admin Pannel For All.</div>
          </div>
          <div class="login-form-container" id="col-2">
            <h1 class="login-hero-title">Login</h1>
            <form class="login-form" action="Assets/Scripts/PHP/process-login.php" name="login_form" method="post">
              <input type="text" name="username" placeholder="Username...">
              <input type="password" name="password" placeholder="Password...">
              <button type="submit" value="Login" name="submit">Login</button>
            </form>
            <div class="login-options">
              <a class="register" href="register.php">Register</a>
              <a class="forgot-password" href="#forgot-password">Forgot Password</a>
            </div>
          </div>

        </div>
      </div>
    </div>
    <script src="Assets/Scripts/JS/jquery.js" charset="utf-8"></script>
    <script src="Assets/Scripts/JS/main.js" charset="utf-8"></script>
  </body>
</html>
