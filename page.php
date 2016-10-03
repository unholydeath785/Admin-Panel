<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['username'] =='') {
  // header("Location:http://www.mundanewebsitename.me/Admin-Panel/login.php");
  header("Location: login.php");
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title><?php print($_GET['page']); ?></title>
    <link rel="stylesheet" href="Assets/Styles/CSS/main.css" media="screen" title="no title" charset="utf-8">
	</head>
	<body>
    <div class="navbar-top">
      <nav class="navbar">
        <li class="user"><img src="Assets/Images/user.svg" class="messages-icon" alt="" /><img src="Assets/Images/carrot.svg" alt="" class="carrot">
          <ul class="user-dropdown">
            <li id="shorten" class="username"><?php echo $_SESSION['username'] ?></li>
            <li class="user-item" id="item-1"><a href="#profile" class="user-link">Profile</a></li>
            <li class="user-item" id="item-2"><a href="#setting" class="user-link">Settings</a></li>
            <li class="user-item" id="item-3"><a href="#help" class="user-link">Help</a></li>
            <li class="user-item" id="item-4"><a href="Assets/Scripts/PHP/logout.php" class="user-link">Logout</a></li>
          </ul>
        </li>
        <li class="messages">
          <img src="Assets/Images/mail.svg" class="messages-icon" alt="" />
          <span class="mail-count"></span>
          <img src="Assets/Images/carrot.svg" alt="" class="carrot">
          <ul class="message-dropdown">
          </ul>
        </li>
      </nav>
    </div>
		<div class="navbar-block">
      <div class="nav-item active" id="home">
        <img class="nav-icon" src="Assets/Images/home.svg" alt="" />
        <span class="nav-title">Home</span><span class="carrot-nav">V</span>
        <ul class="nav-options" id="home-list">
          <a class="nav-link" href="index.php?zone=America/Los_Angeles"><li class="nav-sub-item" id="item-1">Dash</li></a>
        </ul>
      </div>
      <div class="nav-item" id="">
        <img class="nav-icon" src="Assets/Images/stats.svg" alt="" />
        <span class="nav-title">Widget</span><span class="carrot-nav">V</span>
        <ul class="nav-options" id="home-list">
          <a class="nav-link" href="news.php"><li class="nav-sub-item" id="item-1">News</li></a>
          <a class="nav-link" href="https://forge.moltin.com/"><li class="nav-sub-item" id="item-2">Shop</li></a>
        </ul>
      </div>
      <div class="nav-item" id="">
        <img class="nav-icon" src="Assets/Images/page.svg" alt="" />
        <span class="nav-title">Pages</span><span class="carrot-nav">V</span>
        <ul class="nav-options" id="home-list">
          <a class="nav-link" href="page.php?page=home"><li class="nav-sub-item" id="item-1">Home</li></a>
          <a class="nav-link" href="page.php?page=about"><li class="nav-sub-item" id="item-2">About</li></a>
          <a class="nav-link" href="page.php?page=news"><li class="nav-sub-item" id="item-3">News</li></a>
        </ul>
      </div>
    </div>
    <div class="page-container">
      <div class="spinner">
        <div class="loader">Loading...</div>
      </div>
    </div>
    <button type="button" class="save-button">Submit</button>
    <script src="Assets/Scripts/JS/jquery.js" charset="utf-8"></script>
    <script src="Assets/Scripts/JS/app.js" charset="utf-8"></script>
		<script src="Assets/Scripts/JS/get-chatrooms.js" charset="utf-8"></script>
		<script src="Assets/Scripts/JS/location.js" charset="utf-8"></script>
		<script src="Assets/Scripts/JS/Modals/modal.js" charset="utf-8"></script>
    <script src="Assets/Scripts/JS/get-html.js" charset="utf-8"></script>
	</body>
</html>
