<?php
include_once 'Assets/Scripts/PHP/register.inc.php';
include_once 'Assets/Scripts/PHP/functions.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Secure Login: Registration Form</title>
    </head>
    <body>
        <h1>Register with us</h1>
        <?php
        if (!empty($error_msg)) {
            echo $error_msg;
        }
        ?>
        <p>Return to the <a href="login.php">login page</a>.</p>
        <script src="Assets/Scripts/JS/security.js" charset="utf-8"></script>
    </body>
</html>
