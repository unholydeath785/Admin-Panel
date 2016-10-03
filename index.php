<?
session_start();
if (!isset($_SESSION['username']) || $_SESSION['username'] =='') {
  // header("Location:http://www.mundanewebsitename.me/Admin-Panel/login.php");
  header("Location: login.php");
}
include_once 'Assets/Scripts/PHP/update_acsess.php';
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

    <div class="row" id="row-1">
      <div class="panel-container" id="network-analytics">
        <div class="panel-header">
          <h2 class="panel-title">Network Activites</h2>
          <span class="panel-icons">
            <div class="icon-container minimize-container" id="minimize-container" data-panel-id="0">
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
            <div class="icon-container minimize-container" id="minimize-container" data-panel-id="1">
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
        <div class="panel-body" style="max-height: 400px;">
          <div id="piechart" style="width: 100%; height: 400px;"></div>
        </div>
      </div>
      <div class="panel-container" id="location">
        <div class="panel-header">
          <h2 class="panel-title">Location</h2>
          <span class="panel-icons">
            <div class="icon-container minimize-container" id="minimize-container" data-panel-id="2">
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
        <div class="panel-body" style="max-height: 400px;">
          <div id="map" style="width: 100%; height: 400px;"></div>
        </div>
      </div>
    </div>
    <div class="row" style="margin-top:1050px" id="row-3">
      <div class="panel-container" id="todo">
        <div class="panel-header">
          <h2 class="panel-title">Todos</h2>
          <span class="panel-icons">
            <div class="icon-container minimize-container" id="minimize-container" data-panel-id="3">
              <img src="Assets/Images/carrot.svg" alt="" class="pannel-icon" id="carrot">
            </div>
            <div class="icon-container setting" id="setting" data-modal="todos">
              <img src="Assets/Images/settings.svg" alt="" class="pannel-icon" id="setting">
            </div>
            <div id="close-container" class="icon-container close-container">
              <img src="Assets/Images/close.svg" alt="" class="pannel-icon" id="close">
            </div>
          </span>
        </div>
        <div class="panel-body" style="height:400px">
          <ul class="todo-list">
          </ul>
          <ul class="completed-todo-list">
          </ul>
        </div>
      </div>
    </div>

    <!-- Modals -->
    <div class="modal-overlay">
      <div class="modal" id="calendar">
        <span class="modal-close">X</span>
        <span id="cal-prev"><</span>
        <span id="cal-next">></span>
        <!-- JS GENERATED CODE -->
      </div>

      <div class="modal" id="location-modal">
        <span class="modal-close">X</span>
        <h1 class="modal-title">Location Analytics</h1>
        <br>
        <p class="modal-info">
          This Site Will Ask To Track Your Location, This is for Analytics only, It is not a big deal if you do not accept because it is soley for analytics. <span><a id="hyper" href="#">See Here For More Detail</a></span>"
        </p>
        <button class="btn-ok" onclick="setCookies(true);"type="button" name="button">Ok</button>
        <button class="btn-no" onclick="setCookies(false);" type="button" name="button">No</button>
      </div>

      <div class="modal" id="todos">
        <span class="modal-close">X</span>
        <h1 class="modal-title">Todos</h1>
        <div class="modal-main">
          <div class="show">
            <input type="checkbox" onclick="showList(this)" name="name" value="">Show completed todos.
          </div>
          <div class="add">
            <span class="input-txt">Add Todo Task: </span><input class="add-task" type="text" name="name" value="">
            <br>
            <br>
            <br>
            <button class="submit-task" onclick="addTask()" name="button">Add Task</button>
          </div>
        </div>
        <!-- JS GENERATED CODE -->
      </div>
    </div>

    <!--- TODO: -->
    <!-- Adjust username length -->

    <!-- Computer Only Cover -->

    <script src="Assets/Scripts/JS/platform.js" charset="utf-8"></script>
    <script src="Assets/Scripts/JS/jquery.js" charset="utf-8"></script>
    <script src="Assets/Scripts/JS/app.js" charset="utf-8"></script>
    <script src="Assets/Scripts/JS/Modals/modal.js" charset="utf-8"></script>
    <script src="Assets/Scripts/JS/Modals/calendar.js" charset="utf-8"></script>
    <script src="Assets/Scripts/JS/get-chatrooms.js" charset="utf-8"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="Assets/Scripts/JS/network-analytics.js" charset="utf-8"></script>
    <script src="Assets/Scripts/JS/device-usage.js" charset="utf-8"></script>
    <script src="Assets/Scripts/JS/todos.js" charset="utf-8"></script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA9-SeXQ4aJHd-Qq8dYB23TjULjhGQeuWY&libraries=visualization&callback=getLocation"></script>
    <script src="Assets/Scripts/JS/location.js" charset="utf-8"></script>
    </body>
</html>
