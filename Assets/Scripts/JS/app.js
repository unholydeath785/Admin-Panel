jQuery.fn.rotate = function(degrees) {
    $(this).css({'transform' : 'rotate('+ degrees +'deg)'});
    return $(this);
};

var toggled = false;
$(document).ready(function() {
  setHeight();
  getRooms();
  setCookies();
  getUnopenedMessages();
  shortenUsername();
  $(window).resize(function() {
    setHeight();
  });
  function setHeight() {
    windowHeight = $(window).innerHeight();
    $('.fluid-container').css('min-height', windowHeight);
    $('.navbar-block').css('min-height', windowHeight);
  };
});

$('.nav-item').click(function () {
  if ($(this).hasClass('active')) {
    var listHeight = $(this).find('.nav-options').children().size() * 36;
    if (toggled) {
      toggled = false;
    } else {
       toggled = true;
    }
    if (toggled) {
      $(this).find('.nav-options').slideToggle(500);
      $(this).css({
        'transition': 'margin-bottom 0.5s ease-in-out',
        'margin-bottom': listHeight
      })
    } else {
      $(this).css({
        'transition': 'margin-bottom 0.5s ease-in-out',
        'margin-bottom': 0
      })
      $(this).find('.nav-options').slideToggle(500);
    }
    return null;
  } else {
    toggled = false;
    $('.nav-options').slideUp(500);
    $('.nav-item').css({
      'transition': 'margin-bottom 0.5s ease-in-out',
      'margin-bottom': 0
    })
  }
  $(this).parent().find('.active').removeClass('active');
  $(this).addClass('active');
})

$('.messages').mouseenter(function () {
  $('.message-dropdown').slideDown(100);
})

$('.messages').mouseleave(function () {
  $('.message-dropdown').slideUp(100);
  restoreThread();
})

$('.user').mouseenter(function () {
  $('.user-dropdown').slideDown(100);
})

$('.user').mouseleave(function () {
  $('.user-dropdown').slideUp(100);
})

$('.close-container').click(function () {
  $(this).parent().parent().parent().fadeOut(250, function () {
    $(this).remove();
  });
})

var showing = [{row:"row-1", showing:true, height:427}, {row:"row-2", showing:true, height:477}, {row:"row-2", showing:true, height:477}, {row:"row-3", showing:true, height:400}];
$('.minimize-container').click(function () {
  var index = $(this).data("panel-id");
  $(this).parent().parent().parent().find('.panel-body').slideToggle(250);
  if (showing[index].showing) {
    showing[index].showing = false;
    $(this).rotate(180);
    $(this).parent().parent().parent().css({
      height:"75px"
    })
    var rowID = $(this).parent().parent().parent().parent().prop("id");
    for (var i = 0; i < showing.length; i++) {
      if (rowID == showing[i].row) {
        if (i + 1 < showing.length && showing[i + 1].row != rowID) {
          $(this).parent().parent().parent().parent().css({
            height:"75px"
          })
          var margin = 200;
          $(this).parent().parent().parent().parent().parent().find('#row-' + (index + 2)).css({
            "margin-top":margin
          }).animate();
        }
      }
    }
  } else {
    showing[index].showing = true;
    $(this).rotate(360);
    $(this).parent().parent().parent().css({
      height:showing[index].height
    })
    var rowID = $(this).parent().parent().parent().parent().prop("id");
    for (var i = 0; i < showing.length; i++) {
      if (rowID == showing[i].row) {
        $(this).parent().parent().parent().parent().css({
          height:showing[i].height
        })
        var margin = 550;
        $(this).parent().parent().parent().parent().parent().find('#row-' + (index + 2)).css({
          "margin-top":margin
        })
      }
    }
  }
})

function conversationClicked(ele) {
  var userto = $(ele).data("userto");
  updateUnopened(userto);
}

function shortenUsername() {
  if ($('#shorten').text().length > 9) {
    var text = $('#shorten').text()
    text = text.substring(0,9);
    text += "...";
    $('#shorten').text(text);
  }
}
