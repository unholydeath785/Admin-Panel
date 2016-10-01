$.ajax({
	type:"GET",
	dataType:"json",
	url:"Assets/Scripts/PHP/get_news_raw.php",
	success:function (data) {
		console.log("success");
		console.log(data);
		if (data.length > 0) {
			var optionsTxt = data[0].sort_by;
			var options = optionsTxt.split("|");
			var opt = options[1];
			var db_var = options[0];
			$.ajax({
				type: "GET",
				url:"Assets/Scripts/PHP/get_news.php?opt="+opt+"&var="+db_var+"&save="+optionsTxt+"",
				dataType:"json",
				success: function(data) {
					for (var o in data) {
						$('.news-widget').append("<h1>"+data[o].title+"</h1>");
						$('.news-widget').append('<div style="color:red" class="article">' + data[o].article_html + "</div>")
					}
				}
			})
		}
	}
})
