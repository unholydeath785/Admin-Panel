var page = window.location.href.split('?')[1].substring(5);
$.ajax({
  type:"GET",
  url:"Assets/Scripts/PHP/get_html.php?page="+page+"",
  success:function (data) {
    console.log(data);
    $('.page-container').html(data);
  },
  error:function (err) {
    console.log(err);
  }
})
