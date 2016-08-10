jQuery.fn.rotate = function(degrees) {
    $(this).css({'transform' : 'rotate('+ degrees +'deg)'});
    return $(this);
};

var toggled = false;
$(document).ready(function() {
  function setHeight() {
    windowHeight = $(window).innerHeight();
    $('.fluid-container').css('min-height', windowHeight);
    $('.navbar-block').css('min-height', windowHeight);
  };
  setHeight();

  $(window).resize(function() {
    setHeight();
  });
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
})

$('.user').mouseenter(function () {
  $('.user-dropdown').slideDown(100);
})

$('.user').mouseleave(function () {
  $('.user-dropdown').slideUp(100);
})

$('#close-container').click(function () {
  $(this).parent().parent().parent().fadeOut(250, function () {
    $(this).remove();
  });
})

showing = true;
$('#minimize-container').click(function () {
  $(this).parent().parent().parent().find('.panel-body').slideToggle(250);
  if (showing) {
    showing = false;
    $(this).rotate(180);
    $(this).parent().parent().parent().css({
      height:"75px"
    })
  } else {
    showing = true;
    $(this).rotate(360);
    $(this).parent().parent().parent().css({
      height:"427px"
    })
  }
})

$('.message-item').click(function () {
  var userto = $(this).data("userto");
  window.location.href = "messages.php?userto="+userto;
})
