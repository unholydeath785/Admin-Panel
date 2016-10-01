<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['username'] =='') {
  // header("Location:http://www.mundanewebsitename.me/Admin-Panel/login.php");
  header("Location: login.php");
}
$url="index.php";
$widget = $_GET['widget'];
$name = $_GET['name'];
$extras = "";
if ($widget == "news") {
  $url="news.php";
}
if ($name != "new-file") {
  //load html;
}
echo '<div style="display:none">'.$name.'</div>';
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Editor</title>
    <link rel="stylesheet" href="Assets/Styles/CSS/main.css" media="screen" title="no title" charset="utf-8">
    <link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="Assets/Scripts/JS/Frola/css/froala_editor.min.css" rel="stylesheet" type="text/css" />
    <link href="Assets/Scripts/JS/Frola/css/froala_style.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="Assets/Scripts/JS/Frola/css/plugins/char_counter.css">
    <link rel="stylesheet" href="Assets/Scripts/JS/Frola/css/plugins/code_view.css">
    <link rel="stylesheet" href="Assets/Scripts/JS/Frola/css/plugins/colors.css">
    <link rel="stylesheet" href="Assets/Scripts/JS/Frola/css/plugins/emoticons.css">
    <link rel="stylesheet" href="Assets/Scripts/JS/Frola/css/plugins/file.css">
    <link rel="stylesheet" href="Assets/Scripts/JS/Frola/css/plugins/fullscreen.css">
    <link rel="stylesheet" href="Assets/Scripts/JS/Frola/css/plugins/image.css">
    <link rel="stylesheet" href="Assets/Scripts/JS/Frola/css/plugins/image_manager.css">
    <link rel="stylesheet" href="Assets/Scripts/JS/Frola/css/plugins/line_breaker.css">
    <link rel="stylesheet" href="Assets/Scripts/JS/Frola/css/plugins/quick_insert.css">
    <link rel="stylesheet" href="Assets/Scripts/JS/Frola/css/plugins/table.css">
    <link rel="stylesheet" href="Assets/Scripts/JS/Frola/css/plugins/video.css">
  </head>
  <body>
    <div class="header">
      <a style="display:flex; text-decoration:none; color: rgb(49, 138, 230); border-bottom: 1px solid black;
      margin-top: 15px; -webkit-box-shadow: 0px 10px 5px 0px rgba(0,0,0,0.75);
-moz-box-shadow: 0px 10px 5px 0px rgba(0,0,0,0.75);
box-shadow: 0px 10px 5px 0px rgba(0,0,0,0.75);" href=<?php print($url); ?> class="return-link">
        <img style="margin-left: 40%; width: 50px; height: 50px;" src="Assets/Images/message-back.svg" alt="" />
        <h1 style="text-align:center; margin: 0; margin-left: 25px; margin-bottom: 15px;"class="return-text">Return</h1>
      </a>
    </div>
    <input class="quick-input" type="text" placeholder="Title..." name="name" value="Title...">
    <div id="edit"></div>
    <button id="complete">Finish</button>
    <script src="Assets/Scripts/JS/jquery.js" charset="utf-8"></script>
    <script type="text/javascript" src="Assets/Scripts/JS/Frola/js/froala_editor.min.js"></script>
    <script type="text/javascript" src="Assets/Scripts/JS/Frola/js/plugins/align.min.js"></script>
    <script type="text/javascript" src="Assets/Scripts/JS/Frola/js/plugins/char_counter.min.js"></script>
    <script type="text/javascript" src="Assets/Scripts/JS/Frola/js/plugins/code_beautifier.min.js"></script>
    <script type="text/javascript" src="Assets/Scripts/JS/Frola/js/plugins/code_view.min.js"></script>
    <script type="text/javascript" src="Assets/Scripts/JS/Frola/js/plugins/colors.min.js"></script>
    <script type="text/javascript" src="Assets/Scripts/JS/Frola/js/plugins/emoticons.min.js"></script>
    <script type="text/javascript" src="Assets/Scripts/JS/Frola/js/plugins/entities.min.js"></script>
    <script type="text/javascript" src="Assets/Scripts/JS/Frola/js/plugins/file.min.js"></script>
    <script type="text/javascript" src="Assets/Scripts/JS/Frola/js/plugins/font_family.min.js"></script>
    <script type="text/javascript" src="Assets/Scripts/JS/Frola/js/plugins/font_size.min.js"></script>
    <script type="text/javascript" src="Assets/Scripts/JS/Frola/js/plugins/fullscreen.min.js"></script>
    <script type="text/javascript" src="Assets/Scripts/JS/Frola/js/plugins/image.min.js"></script>
    <script type="text/javascript" src="Assets/Scripts/JS/Frola/js/plugins/image_manager.min.js"></script>
    <script type="text/javascript" src="Assets/Scripts/JS/Frola/js/plugins/inline_style.min.js"></script>
    <script type="text/javascript" src="Assets/Scripts/JS/Frola/js/plugins/line_breaker.min.js"></script>
    <script type="text/javascript" src="Assets/Scripts/JS/Frola/js/plugins/link.min.js"></script>
    <script type="text/javascript" src="Assets/Scripts/JS/Frola/js/plugins/lists.min.js"></script>
    <script type="text/javascript" src="Assets/Scripts/JS/Frola/js/plugins/paragraph_format.min.js"></script>
    <script type="text/javascript" src="Assets/Scripts/JS/Frola/js/plugins/paragraph_style.min.js"></script>
    <script type="text/javascript" src="Assets/Scripts/JS/Frola/js/plugins/quick_insert.min.js"></script>
    <script type="text/javascript" src="Assets/Scripts/JS/Frola/js/plugins/quote.min.js"></script>
    <script type="text/javascript" src="Assets/Scripts/JS/Frola/js/plugins/table.min.js"></script>
    <script type="text/javascript" src="Assets/Scripts/JS/Frola/js/plugins/save.min.js"></script>
    <script type="text/javascript" src="Assets/Scripts/JS/Frola/js/plugins/url.min.js"></script>
    <script type="text/javascript" src="Assets/Scripts/JS/Frola/js/plugins/video.min.js"></script>
    <script>
    var isUpdateable = false;
    var id = "";
      $(function() {
        $('#edit').froalaEditor();
        var fileName = window.location.href.substring(62,window.location.href.length);
        if (fileName === "new-file") {
          $('.quick-input').val("Title");
        } else {
          $.ajax({
            type:"GET",
            url:"Assets/Scripts/PHP/get_news_title.php?id="+fileName,
            success:function (title) {
              $('.quick-input').val(title);
              $.ajax({
                type:"GET",
                dataType:"json",
                url:"Assets/Scripts/PHP/get_slide_html.php?title="+fileName,
                success:function (data) {
                  $('#edit').froalaEditor('html.set',data[0].article_html);
                  isUpdateable = true;
                  id = fileName;
                },
                error: function (err) {
                  console.log(err);
                }
              })
            }
          })
        }
      });
      setTimeout(function () {
        $(function() {
            $('#summary').froalaEditor()
        });
      }, 10);
      $('#complete').click(function () {
        $('#edit').hide();
        $('.quick-input').hide();
        $(this).hide();
      })
      $('#complete').click(function () {
        var articleHTML = $('#edit').froalaEditor('html.get');
        var title = $('.quick-input').val();
        var path = articleHTML.substring(articleHTML.indexOf("src="),articleHTML.indexOf(" style=")).substring(4);
        if (!isUpdateable) {
          $.ajax({
            type:"POST",
            url:"Assets/Scripts/PHP/update_news.php?aH=" + articleHTML + "&t=" + title + "&p=" + path,
            success:function () {
              window.location.href = "news.php";
            },
            error: function (err) {
              console.log(err);
            }
          })
        } else {
          $.ajax({
            type:"POST",
            url:"Assets/Scripts/PHP/update_exisiting_news.php?aH=" + articleHTML + "&t=" + title + "&id=" + id,
            success:function () {
              window.location.href = "news.php";
            },
            error: function (err) {
              console.log(err);
            }
          })
        }
      })
    </script>
  </body>
</html>
