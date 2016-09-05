google.charts.setOnLoadCallback(deviceChart);

function updateDeviceUsage() {
	//Update device table
}

function deviceChart() {
	var data = google.visualization.arrayToDataTable([
		['Device', 'Percentage']
	]);
	$.ajax({
		type:"GET",
		url:"Assets/Scripts/PHP/get_device_usage.php",
		dataType:"json",
		success: function (devices) {
			var ar = [];
			for (var i in devices) {
				var array = [];
				array.push(devices[i].device);
				array.push(devices[i].count);
				ar.push(array);
			}
			data.addRows(ar);
			var options = {
				height:400,
				pieHole:0.45
			};

			var chart = new google.visualization.PieChart(document.getElementById('piechart'));

			chart.draw(data, options);
		}
	})
}
