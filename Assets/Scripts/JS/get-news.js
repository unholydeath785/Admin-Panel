getNews();
var slides;
$.ajax({
	type:"GET",
	url:"Assets/Scripts/PHP/get_news_sorting_order.php",
	success:function (string) {
		$('.order-by').val(string);
	}
})

function getNews() {
	var optionsTxt = $('.order-by').val();
	var options = optionsTxt.split("|");
	var opt = options[1];
	var db_var = options[0];
	console.log(optionsTxt);
	$.ajax({
		type: "GET",
		url:"Assets/Scripts/PHP/get_news.php?opt="+opt+"&var="+db_var+"&save="+optionsTxt+"",
		dataType:"json",
		success: function(data) {
			$('.slider').html("");
			slides = data;
			var width = slides.length*400;
			$('.slider').width(width);
			for (var o in data) {
				appendSlide(data[o]);
			}
		}
	})
}

function appendSlide(data) {
	var html = '<div style="background-image:url('+data.bg_path.substring(1,data.bg_path.length - 1)+')" class="slide" id="slide-'+data.id+'"><button data-modal="edit-news" onclick="editClick(this)" class="edit">Edit</button><div class="info"><h2 class="title">'+data.title+'<p class="summary">'+data.summary_html+'</p><p style="font-weight:400; font-size:8px;">'+data.date+'</p></h2></div></div>';
	$('.slider').append(html);
}

function updateSlide(ele) {
	var summary = $(ele).parent().find('.summary-input').val();
	var url = $(ele).parent().find('.url-input').val();
	var id = $(ele).parent().data('slide') + 1;
	$.ajax({
		type:"GET",
		url:'Assets/Scripts/PHP/update_current_news.php?s='+summary+'&url="'+url+'"&id='+id,
		success:function (data) {
			window.location.reload(true);
		}
	})
}
