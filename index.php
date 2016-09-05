<?
session_start();
if (!isset($_SESSION['username']) || $_SESSION['username'] =='') {
  // header("Location:http://www.mundanewebsitename.me/Admin-Panel/login.php");
  header("Location: login.php");
}
$conn = mysqli_connect("localhost","root","","Admin-Panel");
// $conn = mysqli_connect("localhost","unholyde_ath7856","Bertschi2012","unholyde_ath7856_AdminPanel");
date_default_timezone_set($_GET['zone']);
$timestamp = date("H");
$day = date("j");
$month = date("n");
$year = date("Y");
$query = "INSERT INTO access (time,date) VALUES (".$timestamp.",NOW())";
mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title><?php echo $_SESSION['site'] . " Admin Panel"; ?></title>
    <link rel="stylesheet" href="Assets/Styles/CSS/main.css" media="screen" title="no title" charset="utf-8">
  </head>
  <body>
    <div class="navbar-top">
      <nav class="navbar">
        <li class="user"><img src="Assets/Images/user.svg" class="messages-icon" alt="" /><img src="Assets/Images/carrot.svg" alt="" class="carrot">
          <ul class="user-dropdown">
            <li class="username"><?php echo $_SESSION['username'] ?></li>
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
          <li class="nav-sub-item" id="item-1">Dash</li>
        </ul>
      </div>
      <div class="nav-item" id="">
        <img class="nav-icon" src="Assets/Images/stats.svg" alt="" />
        <span class="nav-title">Stats</span><span class="carrot-nav">V</span>
        <ul class="nav-options" id="home-list">
          <li class="nav-sub-item" id="item-1">One</li>
          <li class="nav-sub-item" id="item-2">Two</li>
          <li class="nav-sub-item" id="item-3">Three</li>
          <li class="nav-sub-item" id="item-3">Four</li>
        </ul>
      </div>
      <div class="nav-item" id="">
        <img class="nav-icon" src="Assets/Images/page.svg" alt="" />
        <span class="nav-title">Pages</span><span class="carrot-nav">V</span>
        <ul class="nav-options" id="home-list">
          <li class="nav-sub-item" id="item-1">One</li>
          <li class="nav-sub-item" id="item-2">Two</li>
          <li class="nav-sub-item" id="item-3">Three</li>
        </ul>
      </div>
    </div>

    <div class="row" id="row-1">
      <div class="panel-container" id="network-analytics">
        <div class="panel-header">
          <h2 class="panel-title">Network Activites</h2>
          <span class="panel-icons">
            <div class="icon-container minimize-container" id="minimize-container">
              <img src="Assets/Images/carrot.svg" alt="" class="pannel-icon" id="carrot">
            </div>
            <div class="icon-container setting" id="setting" data-modal="calendar">
              <img src="Assets/Images/settings.svg" alt="" class="pannel-icon" id="setting">
            </div>
            <div id="close-container close" class="icon-container close-container">
              <img src="Assets/Images/close.svg" alt="" class="pannel-icon" id="close">
            </div>
          </span>
        </div>
        <div class="panel-body">
          <div id="chart_div"></div>
        </div>
      </div>
    </div>
    <div class="row" id="row-2">
      <div class="panel-container" id="device-usage">
        <div class="panel-header">
          <h2 class="panel-title">Devices</h2>
          <span class="panel-icons">
            <div class="icon-container minimize-container" id="minimize-container">
              <img src="Assets/Images/carrot.svg" alt="" class="pannel-icon" id="carrot">
            </div>
            <div class="icon-container setting" id="setting" data-modal="device-usage">
              <img src="Assets/Images/settings.svg" alt="" class="pannel-icon" id="setting">
            </div>
            <div id="close-container" class="icon-container close-container">
              <img src="Assets/Images/close.svg" alt="" class="pannel-icon" id="close">
            </div>
          </span>
        </div>
        <div class="panel-body">
          <div id="piechart" style="width: 100%; height: 400px;"></div>
        </div>
      </div>
    </div>
    <div class="row" id="row-2">
      <div class="panel-container" id="location">
        <div class="panel-header">
          <h2 class="panel-title">Location</h2>
          <span class="panel-icons">
            <div class="icon-container minimize-container" id="minimize-container">
              <img src="Assets/Images/carrot.svg" alt="" class="pannel-icon" id="carrot">
            </div>
            <div class="icon-container setting" id="setting" data-modal="location">
              <img src="Assets/Images/settings.svg" alt="" class="pannel-icon" id="setting">
            </div>
            <div id="close-container" class="icon-container close-container">
              <img src="Assets/Images/close.svg" alt="" class="pannel-icon" id="close">
            </div>
          </span>
        </div>
        <div class="panel-body">
          <div id="piechart" style="width: 100%; height: 400px;"></div>
        </div>
      </div>
    </div>
    <!-- <div class="row" id="row-3">

    </div>
    <div class="row" id="row-4">

    </div> -->

    <!-- Modals -->
    <div class="modal-overlay">
      <div class="modal" id="calendar">
        <span class="modal-close">X</span>
        <span id="cal-prev"><</span>
        <span id="cal-next">></span>
        <!-- JS GENERATED CODE -->
      </div>
      <!-- <div class="modal" id=""></div> -->
    </div>

    <!--- TODO: -->
    <!-- Adjust minimization of containers -->
    <!-- Adjust username length -->

    <!-- Computer Only Cover -->

    <!-- <script src="Assets/Scripts/JS/platform.js" charset="utf-8"></script> -->
    <script src="Assets/Scripts/JS/jquery.js" charset="utf-8"></script>
    <script src="Assets/Scripts/JS/app.js" charset="utf-8"></script>
    <script src="Assets/Scripts/JS/Modals/modal.js" charset="utf-8"></script>
    <script src="Assets/Scripts/JS/Modals/calendar.js" charset="utf-8"></script>
    <script src="Assets/Scripts/JS/get-chatrooms.js" charset="utf-8"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="Assets/Scripts/JS/network-analytics.js" charset="utf-8"></script>
    <script src="Assets/Scripts/JS/device-usage.js" charset="utf-8"></script> -->
    </body>
</html>
