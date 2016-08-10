<?php
session_start();
$userto = stripslashes(htmlspecialchars($_GET['userto']));
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Messages</title>
    <link rel="stylesheet" href="Assets/Styles/CSS/main.css" media="screen" title="no title" charset="utf-8">
  </head>
  <body>
    <div class="msg-container">
      <div class="header"><span><a href=<?php echo "index.php?zone=".$_SESSION['zone']; ?>><img src="Assets/Images/message-back.svg" class="back" alt="" /></a></span><?php print($userto); ?></div>
      <div class="msg-area" id="message-area">
      </div>
      <div class="bottom">
        <input type="text" name="msginput" class="msginput" id="msginput" onkeydown="if (event.keyCode == 13) { sendmsg(); updateTyping(false); } else { updateTyping(true); }" value="" placeholder="Enter your message here...">
      </div>
    </div>
  </body>
  <div class="info"></div>
  <!-- Custom Navbar -->

  <nav class="context-menu" id="context-menu">
    <ul class="context-menu__items">
      <li class="context-menu__item" onclick="showDate(event);"><a href="#" class="context-menu__link"><i class="fa fa-eye"></i></a>View Date</li>
    </ul>
  </nav>

  <script src="Assets/Scripts/JS/jquery.js" charset="utf-8"></script>
  <script src="Assets/Scripts/JS/messages.js" charset="utf-8"></script>
  <script src="Assets/Scripts/JS/Widget/context-menu.js" charset="utf-8"></script>
  <script type="text/javascript">
    var userto = "<?php print($userto); ?>";
  </script>
</html>
