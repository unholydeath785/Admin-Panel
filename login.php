<?php
include_once 'Assets/Scripts/PHP/connect.php';
session_start();
if (isset($_SESSION['username']) && $_SESSION['username'] !='') {
  // header("Location:http://www.mundanewebsitename.me/Admin-Panel/index.php");
  header("Location:index.php?zone=".$_GET['zone']);
}
if (isset($_POST['submit'])) {
  // $dbh = new PDO('mysql:dbname=unholyde_ath7856_AdminPanel;host=localhost','unholyde_ath7856','Bertschi2012');
  $dbh = new PDO('mysql:dbname=Admin-Panel;host=localhost','root','');
  $user = $_POST['user'];
  $password = $_POST['pass'];
  if (isset($_POST) && $user != '' && $password != '') {
    $sql = $dbh -> prepare("SELECT id, password, psalt FROM users WHERE username=?");
    $sql -> execute(array($user));
    while ($r = $sql -> fetch()) {
      $p = $r['password'];
      $p_salt = $r['psalt'];
      $id = $r['id'];
    }
    if (isset($p_salt) && $p_salt != "") {
      $site_salt = "myAdminsalt";
      $salted_hash = hash('sha256', $password.$site_salt.$p_salt);
      if ($p == $salted_hash) {
        $_SESSION['username'] = $user;
        $_SESSION['id'] = $id;
        $_SESSION['site'] = "LittleBit";
        $_SESSION['name'] = "Evan";
        $url = "http://mundanewebsitename.me/Admin-Panel/index.php?zone=".$_GET['zone'];
        $url = "index.php?zone=".$_GET['zone'];
        $_SESSION['zone'] = $_GET['zone'];
        header("Location:".$url);
      } else {
        echo("<br><h1> Login Failed </h1><br>");
      }
    } else {
      echo("<br><h1> Login Failed </h1><br>");
    }
  } else {
    echo("<br><h1> Login Failed </h1><br>");
  }
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
    <div class="fluid-container">
      <div class="login-container">
        <div class="login-row" id="row-1">
          <div class="login-info" id="col-1">
            <h2 class="site-title">MySite</h2>
            <div class="site-desc">An Admin Pannel For All.</div>
          </div>
          <div class="login-form-container" id="col-2">
            <h1 class="login-hero-title">Login</h1>
            <form class="login-form" action="" name="login_form" method="post">
              <input type="text" name="user" placeholder="Username...">
              <input type="password" name="pass" placeholder="Password...">
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
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jstimezonedetect/1.0.4/jstz.min.js" charset="utf-8"></script>
    <script type="text/javascript">
      var tz = jstz.determine();
      var timezone = tz.name();
      // var url = "http://mundanewebsitename.me/Admin-Panel/login.php" +'?zone=' + timezone;
      var url = "http://localhost/Admin-Panel/login.php" +'?zone=' + timezone;
      var currentUrl = window.location.href;
      if (currentUrl != url) {
          window.location.href = url;
      }
      console.log(timezone);
    </script>
  </body>
</html>
