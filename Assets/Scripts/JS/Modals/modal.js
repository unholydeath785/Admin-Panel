$('.modal-close').click(function () {
  $('.modal').slideUp(250, function () {
    $('.modal-overlay').slideUp(250);
  })
})

$('.setting').click(function () {
  var clicked = this;
  $('.modal-overlay').slideDown(250,function () {
    $('#'+$(clicked).data('modal')).slideDown(250);
  })
})
