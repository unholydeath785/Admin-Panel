if ((!getCookies() == true || getCookies() == "true") && window.location.href == "http://localhost/Admin-Panel/index.php?zone=America/Los_Angeles") {
	$('.modal-overlay').slideDown(250,function () {
		$('#location-modal').slideDown(250);
	})
}

function setCookies(input) {
	var d = new Date();
	d.setTime(d.getTime() + (100*24*60*60*1000));
	var str = "location="+input+"; expires=" + d.toUTCString();
	document.cookie=str;
}

function getCookies() {
	if (document.cookie.includes("location=true") || document.cookie.includes("location=false")) {
		var ar = document.cookie.split('=');
		var ar2 = ar[1].split(';');
		return ar2[0];
	}
	return "";
}

function getLocation() {
    if (navigator.geolocation) {
			var x = navigator.geolocation.getCurrentPosition(showPosition);
    } else {
        alert("Geolocation is not supported by this browser.");
    }
}

function showPosition(position) {
	var lat = position.coords.latitude;
	var lon = position.coords.longitude;
	$.ajax({
		type:"GET",
		url:"https://maps.googleapis.com/maps/api/geocode/json?latlng="+lat+","+lon+"&key=AIzaSyA9-SeXQ4aJHd-Qq8dYB23TjULjhGQeuWY",
		dataType:"json",
		success:function (data) {
			getCity(data);
		}
	})
}


function getKnownLocations(city) {
	$.ajax({
		type:"GET",
		url:"https://maps.googleapis.com/maps/api/geocode/json?address="+city+"&key=AIzaSyA9-SeXQ4aJHd-Qq8dYB23TjULjhGQeuWY",
		success:function (json) {
			getLocations(city, json.results[0].geometry.location.lat, json.results[0].geometry.location.lng);
		}
	})
}

function getLocations(city, lat, lon) {
	$.ajax({
		type:"GET",
		url:"Assets/Scripts/PHP/get_locations.php?city="+city+"&lat="+lat+"&lon="+lon+"",
		dataType:"json",
		success:function (values) {
			//get map of cities and update heatmap [DO NOT CREATE HEATMAP HERE WILL EXPEND TO MUCH CPU]
			//GET lat long of cities that are unknown create database of know lat longs
			var locations = [];
			for (o in values) {
				locations.push(values[o]);
			}
			$.ajax({
				type:"POST",
				url:"Assets/Scripts/PHP/update_location.php?city="+city,
				dataType:"json",
				success:function (data) {
					//get map of cities and update heatmap [DO NOT CREATE HEATMAP HERE WILL EXPEND TO MUCH CPU]
					//GET lat long of cities that are unknown create database of know lat longs
					getPoints(data, locations);
				}
			})
		}
	})
}

function getPoints(data,locations) {
	// new google.maps.LatLng(37.751266, -122.403355)
	var positions = [];
	for (var i = 0; i < locations.length; i++) {
		for (var j = 0; j < 50; j++) {
			positions.push(new google.maps.LatLng(locations[i].lat, locations[i].lon))
		}
	}
	initMap(positions);
}

function getCity(data) {
	var city = "";
	for (var o in data) {
		if (typeof data[o] !== 'string') {
			city = data[o][0].address_components[2].long_name;
		}
	}
	getKnownLocations(city);
}

function initMap(points) {
  map = new google.maps.Map(document.getElementById('map'), {
    zoom: 8,
    center: {lat: 47.6062, lng: -122.3321},
  });

  heatmap = new google.maps.visualization.HeatmapLayer({
    data: points,
    map: map
  });
}

function toggleHeatmap() {
  heatmap.setMap(heatmap.getMap() ? null : map);
}

function changeGradient() {
  var gradient = [
    'rgba(0, 255, 255, 0)',
    'rgba(0, 255, 255, 1)',
    'rgba(0, 191, 255, 1)',
    'rgba(0, 127, 255, 1)',
    'rgba(0, 63, 255, 1)',
    'rgba(0, 0, 255, 1)',
    'rgba(0, 0, 223, 1)',
    'rgba(0, 0, 191, 1)',
    'rgba(0, 0, 159, 1)',
    'rgba(0, 0, 127, 1)',
    'rgba(63, 0, 91, 1)',
    'rgba(127, 0, 63, 1)',
    'rgba(191, 0, 31, 1)',
    'rgba(255, 0, 0, 1)'
  ]
  heatmap.set('gradient', heatmap.get('gradient') ? null : gradient);
}

function changeRadius() {
  heatmap.set('radius', heatmap.get('radius') ? null : 20);
}

function changeOpacity() {
  heatmap.set('opacity', heatmap.get('opacity') ? null : 0.2);
}
