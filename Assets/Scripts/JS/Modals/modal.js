$('.modal-close').click(function () {
  $('.modal').slideUp(250, function () {
    $('.modal-overlay').slideUp(250);
  })
})

function closeModal(ele) {
  $(ele).parent().slideUp(250, function () {
    $(ele).parent().parent().slideUp(250);
  })
}

$('.btn-ok').click(function () {
  $('.modal').slideUp(250, function () {
    $('.modal-overlay').slideUp(250);
  })
})

$('.btn-no').click(function () {
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

function editClick(ele) {
  var clicked = ele;
  var id = $(ele).parent().prop("id").substring(6) - 1;
  var slide = slides[id];
  $('.modal-overlay').slideDown(250,function () {
    $('#'+$(clicked).data('modal')).slideDown(250);
    var path = slide.bg_path.substring(1,slide.bg_path.length - 1)
    $('#'+$(clicked).data('modal')).html('<span onclick='+'closeModal(this)'+' class="modal-close">X</span><h1 class="modal-title">Edit</h1><h1 class="summary-title">Summary</h1><textarea class="summary-input">'+slide.summary_html+'</textarea><h2 class="bg-image-txt">Background Image</h2><input class="url-input" type="text" placeholder="url..." name="name" value="'+path+'"><a class="edit-in-editor" href="text-editor.php?widget=news&name='+slide.id+'">Edit Body and Title</a><button class="submit-task" onclick="updateSlide(this);closeModal(this);" name="button">Save</button>');
    $('#'+$(clicked).data('modal')).data('slide',id);
  })
}

$(document).keydown(function (e) {
  if (e.keyCode == 27) {
    $('.modal').slideUp(250, function () {
      $('.modal-overlay').slideUp(250);
    })
  }
})
