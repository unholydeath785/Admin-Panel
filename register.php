<?
session_start();
if (isset($_SESSION['username']) && $_SESSION['username'] != '') {
  header("Location:index.php");
}

if (isset($_POST['submit'])) {
  $dbuser = "root";
  $dbpass = "";
  $dbhost = "localhost";
  $dbh = new PDO('mysql:dbname=Admin-Panel;host'.$dbhost.'',$dbuser,$dbpass);
  if (isset($_POST['user']) && isset($_POST['pass1'])) {
    $password = $_POST['pass1'];
    $checkPass= $_POST['pass2'];
    if ($password == $checkPass && $password != "") {
      $email = $_POST['email'];
      $siteID = $_POST['id'];
      $sql=$dbh->prepare("SELECT COUNT(*) FROM `users` WHERE `username`=?");
      $sql->execute(array($_POST['user']));
      if ($sql -> fetchColumn() != 0) {
        die ("User Exists");
      } else {
        function rand_string($length) {
          $str = "";
          $chars = "subinsblogabcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
          $size = strlen($chars);
          for ($i = 0; $i < $length; $i++) {
            $str .= $chars[rand(0,$size-1)];
          }
          return $str;
        }
        if (isset($email) && isset($siteID) && isset($_POST['fname']) && isset ($_POST['lname']) && $email != ""
                                              && $siteID != "" && $_POST['fname'] != "" && $_POST['lname'] != "") {
          $firstName = $_POST['fname'];
          $lastName = $_POST['lname'];
          $username = $_POST['user'];
          $username = preg_replace("#[^0-9a-z]#i","",$username);
          $firstName = preg_replace("#[^0-9a-z]#i","",$firstName);
          $lastName = preg_replace("#[^0-9a-z]#i","",$lastName);
          $email = mysql_real_escape_string($email);

          $p_salt = rand_string(20);
          $site_salt = "myAdminsalt";
          $salted_hash = hash('sha256', $password.$site_salt.$p_salt);
          $sql = $dbh -> prepare("INSERT INTO `users` (`id`, `username`, `password`, `psalt`, `email`,`siteID`,`firstname`,`lastname`) VALUES (NULL, ?, ?, ?, ?,?,?,?);");
          $sql -> execute(array($username, $salted_hash, $p_salt, $email,$siteID,$firstName,$lastName));
          echo "<br><h1>Successfully Registered.</h1><br>";
        } else {
          echo "<br><h1>Register Failed.</h1><br>";
        }
      }
    } else {
      echo "<br><h1>Register Failed.</h1><br>";
    }
  } else {
    echo "<br><h1>Register Failed.</h1><br>";
  }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Secure Login: Registration Form</title>
        <link rel="stylesheet" href="Assets/Styles/CSS/main.css" media="screen" title="no title" charset="utf-8">
    </head>
    <body>
      <div class="fluid-container">
        <div class="login-container">
          <div class="login-row" id="row-1">
            <div class="register-info" id="col-1">
              <h1 class="register-title">myAdmin</h1>
              <div class="register-info">
                Register with your sites ID in order to register.
              </div>
            </div>
            <div class="register-form-container" id="col-2">
              <h1 class="register-hero-title">Register</h1>
              <form class="register-form" action="" name="register_form" method="post">
                <label for="">Username: </label><input type="text" name="user" placeholder="Username...">
                <br>
                <br>
                <label for="">First Name: </label><input type="text" name="fname" placeholder="Username...">
                <br>
                <br>
                <label for="">Last Name: </label><input type="text" name="lname" placeholder="Username...">
                <br>
                <br>
                <label for="">Email: </label><input type="text" name="email" placeholder="Email...">
                <br>
                <br>
                <label for="">Password: </label><input type="password" name="pass1" placeholder="Password...">
                <br>
                <br>
                <label for="">Confirm Password: </label><input type="password" name="pass2" placeholder="Password...">
                <br>
                <br>
                <label for="">SiteID: </label><input type="text" name="id" placeholder="Site ID...">
                <br>
                <br>
                <button type="submit" value="Login" name="submit">Register</button>
              </form>
              <div class="login-options">
                <a class="register" href="login.php">Login</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </body>
</html>
