$(document).ready(function() {
  function setHeight() {
    windowHeight = $(window).innerHeight();
    $('.fluid-container').css('min-height', windowHeight);
  };
  setHeight();

  $(window).resize(function() {
    setHeight();
  });
});
