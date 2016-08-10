$(document).ready(function () {
  var height = $(window).innerHeight()-178;
  update();
  $('.msg-area').css({
    "height": height,
    "max-height": height
  })
})
var msginput = $('#msginput');
var msgarea = $('#message-area');
var prevLeng = 0;
var typing = "false";

function updateTyping(bool) {
  typing = bool + "";
  $.ajax({
    type:"GET",
    url:"Assets/Scripts/PHP/get_username.php",
    success:function (data) {
      var username = data;
      var URL = "Assets/Scripts/PHP/typing.php?typing=" + typing + "&username=" + username + "";
      $.ajax({
        type:"GET",
        url: URL
      })
      setTimeout(function () {
        typing = false + "";
        var URL = "Assets/Scripts/PHP/typing.php?typing=" + typing + "&username=" + username + "";
        $.ajax({
          type:"GET",
          url:URL
        })
      }, 5000);
    }
  })
}

function update() {
  var output = "";
  $.ajax({
    type:"GET",
    url:"Assets/Scripts/PHP/get_username.php",
    success: function (user) {
      var username = user;
      var URL = "Assets/Scripts/PHP/get_messages.php?username=" + username + "&userfrom=" + userto;
      $.ajax({
        type:"GET",
        url: URL,
        success:function (data) {
          var response = data.split("\n");
          var rl = response.length;
          var item = "";
          for (var i = 0; i < rl; i++) {
            item = response[i].split("\\");
            if (item[1] != undefined) {
              if (item[0] == username) {
                //blue
                output += '<div class="col"><div class="message-container" id="sent"><div class="msg">'+item[1]+'</div><div class="info">Sent by '+item[0]+'</div></div></div>';
              } else {
                //gray
                output += '<div class="col"><div class="message-container" id="received"><div class="msg">'+item[1]+'</div><div class="info">Sent by '+item[0]+'</div></div></div>';
              }
            }
          }
          if (rl > prevLeng) {
            setTimeout(function () {
              var obj = document.getElementById("message-area");
              obj.scrollTop = obj.scrollHeight;
            }, 250);
            prevLeng = rl;
          }
          URL = "Assets/Scripts/PHP/get_typing.php?username=" + userto + "";
          $.ajax({
            type:"GET",
            url:URL,
            success:function (data) {
              if (data == "true" || data == true) {
                output += '<img class="typing" src="Assets/Images/typing.gif" alt="" />';
              }
              $(msgarea).html(output);
            }
          })
        }
      })
    }
  })
}

function sendmsg() {
  var message = $(msginput).val();
  if (message != "") {
    $.ajax({
      type:"GET",
      url:"Assets/Scripts/PHP/get_username.php",
      success: function (user) {
        var username = user;
        var URL = "Assets/Scripts/PHP/update_messages.php?username=" + username + "&message=" + message + "&userto=" + userto;
        $.ajax({
          type:"GET",
          url: URL,
          success:function (data) {
            $(msginput).val("");
            var msgHTML = '<div class="col"><div class="message-container" id="sent"><div class="msg">'+message+'</div><div class="info">Sent by '+username+'</div></div></div>';
            $(msgarea).append(msgHTML);
          }
        })
      }
    })
  }
}

function showDate(e) {
  var URL = "Assets/Scripts/PHP/get_msg_date.php?message=" + message + "";
  console.log(e);
  $.ajax({
    type:"GET",
    url:URL,
    success:function (data) {
      console.log(data);
    }
  })
}

setInterval(function () {
  update();
}, 1000);
