google.charts.setOnLoadCallback(deviceChart);

function updateDeviceUsage() {
	//Update device table
}

function deviceChart() {
	$.ajax({
		type:"GET",
		url:"Assets/Scripts/PHP/get_device_usage.php",
		dataType:"json",
		success: function (devices) {
			var ar = [];
			for (var i in devices) {
				var array = [];
				array[0] = devices[i].device;
				array[1] = parseInt(devices[i].count);
				ar.push(array);
			}
			var data = new google.visualization.DataTable();
			data.addColumn('string','Devices');
			data.addColumn('number','Count');
			data.addRows(ar)
			var options = {
				title:"Device Usage",
				subtitle:"User devices used on website",
				height:400,
				pieHole:0.45
			};

			var chart = new google.visualization.PieChart(document.getElementById('piechart'));

			chart.draw(data, options);
		}
	})
}
