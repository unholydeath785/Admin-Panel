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
		<title>News</title>
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
          <a class="nav-link" href="home.php"><li class="nav-sub-item" id="item-1">Home</li></a>
          <a class="nav-link" href="about.php"><li class="nav-sub-item" id="item-2">About</li></a>
          <a class="nav-link" href="news.php"><li class="nav-sub-item" id="item-3">News</li></a>
        </ul>
      </div>
    </div>
		<div class="news-widget-container">
			<div class="head">
				<h1 class="title">News Widget</h1>
			</div>
			<div class="body">
				<div class="row" id="news-row-1">
					<h2 class="control-title">Display</h2>
					<div class="control">
						<select name="" onchange="$('.slider').html(''); getNews();" class="order-by">
							<option value="title|ASC">(Asc) Title</option>
							<option value="title|DESC">(Desc) Title</option>
							<option value="date|ASC">(Asc) Date</option>
							<option value="date|DESC">(Desc) Date</option>
						</select>
						<div class="news-carousel">
							<div class="slider">
							</div>
						</div>
					</div>
				</div>
				<div class="row" id="news-row-2">
					<div class="control" id="add">
						<h2 class="control-title">Add</h2>
						<a class="editor-link" href="text-editor.php?widget=news&name=new-file"><button>Add News</button></a>
					</div>
				</div>
			</div>
		</div>
		<div class="modal-overlay">
			<div class="modal" data-slide="0" id="edit-news">
        <span class="modal-close">X</span>
        <!-- JS GENERATED CODE -->
      </div>
		</div>
		<script src="Assets/Scripts/JS/jquery.js" charset="utf-8"></script>
    <script src="Assets/Scripts/JS/app.js" charset="utf-8"></script>
		<script src="Assets/Scripts/JS/get-chatrooms.js" charset="utf-8"></script>
		<script src="Assets/Scripts/JS/location.js" charset="utf-8"></script>
		<script src="Assets/Scripts/JS/Modals/modal.js" charset="utf-8"></script>
		<script src="Assets/Scripts/JS/get-news.js" charset="utf-8"></script>
	</body>
</html>
