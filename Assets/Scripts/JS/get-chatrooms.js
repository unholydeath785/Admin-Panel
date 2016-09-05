var ADDNEWTHREADHTML = '<li onclick="newThreadEvent();" class="message-item" id="new-thread">New Converstaion</li>'
function getRooms() {
	var dropdownClass = '.message-dropdown';
	$.ajax({
		type:"GET",
		url:"Assets/Scripts/PHP/get_user.php",
		success:function (data) {
			var username = data;
			var URL = "Assets/Scripts/PHP/get_conversations.php?username=" + username + "";
			$.ajax({
				type:"GET",
				url:URL,
				dataType: "json",
				success: function (data) {
					var conversationArray = compressData(data);
					var HTML = "";
					for (var i = 0; i < conversationArray.length; i++) {
						HTML += '<li onclick="conversationClicked(this);" class="message-item" id="item-' + (i + 1) +
						'" data-userto="' + conversationArray[i] + '">'+ conversationArray[i] +'</li>';
					}
					HTML += ADDNEWTHREADHTML;
					$(dropdownClass).html(HTML);
				}
			})
		}
	})
}

function queryUsers(e) {
	if (e.code == "Enter") {
		createNewThread();
	} else {
		updateDropdown();
	}
}

function createNewThread() {
	var ele = document.getElementById('new-thread-conv');
	var ele = $(ele).find('input');
	var user = $(ele).val();
	userExsists(user);
}

function updateDropdown() {
	//ajax query user array
	//loop through arraay create <li> for each
	$.ajax({
		type:"GET",
		url:"Assets/Scripts/PHP/get_user.php",
		success:function (data) {
			var username = data;
			var ele = document.getElementById('new-thread-conv');
			var ele = $(ele).find('input');
			var URL = 'Assets/Scripts/PHP/query_users.php?username=' + $(ele).val();
			$.ajax({
				type:"GET",
				url:URL,
				dataType:"json",
				success:function (data) {
					var users = data;
					var menu = document.getElementById('live-usernames');
					var HTML = "";
					if (users.length != 0) {
						for (var i = 0; i < users.length; i++) {
							if (users[i] != username) {
								var usernameItem = '<li onclick="conversationClicked(this);" data-userto=' + users[i] + ' class="username-item" id="username-' + (i + 1) +'">' + users[i] + '</li>';
								HTML += usernameItem;
							}
						}
					} else {
						HTML += '<li class="username-item">NO RESULTS</li>'
					}
					$(menu).html(HTML);
				}
			})
		}
	});
}

function userExsists(user) {
	// ajax query for user array
	// loop array checking for user
	var URL = 'Assets/Scripts/PHP/query_users.php?username=' + user;
	$.ajax({
		type:"GET",
		url:URL,
		dataType:"json",
		success:function (data) {
			var users = data;
			var menu = document.getElementById('live-usernames');
			var HTML = "";
			if (users.length != 0) {
				for (var i = 0; i < users.length; i++) {
					if (users[i] == user) {
						window.location.href="http://localhost/Admin-Panel/messages.php?userto="+user;
					}
				}
			}
		}
	});
}

function newThreadEvent() {
	var inputHTML = '<li onkeydown="queryUsers(event);" class="message-item" id="new-thread-conv"><input class="username" type="text"><ul id="live-usernames"></ul></li>'
	$('#new-thread').parent().append(inputHTML);
	$('#new-thread').remove();
}

function restoreThread() {
	$('#new-thread-conv').parent().append(ADDNEWTHREADHTML);
	$('#new-thread-conv').remove();
}

function compressData(d) {
	var ar = [];
	ar.push(d[0]);
	for (var o in d) {
		if (ar.indexOf(d[o]) == -1) {
			ar.push(d[o]);
		}
	}
	return ar;
}

function getUnopenedMessages() {
	var URL = "Assets/Scripts/PHP/get_user.php";
	$.ajax({
		type:"GET",
		url: URL,
		success:function (user) {
			var username = user;
			var URL = "Assets/Scripts/PHP/get_unopened.php?username=" + username;
			$.ajax({
				type:"GET",
				url:URL,
				dataType: "json",
				success:function (data) {
					var total = 0;
					var users = [];
					for (var obj in data) {
						if (users.indexOf(data[obj].username) == -1) {
							users.push(data[obj].username);
						}
						total++;
					}
					for (var i = 0; i < users.length; i++) {
						var original = $("[data-userto='"+users[i]+"']").text();
						$("[data-userto='"+users[i]+"']").append('<span class="unopened-dot" style="color: rgb(84, 159, 255);">\t\t•</span>')
					}
					$('.mail-count').text(total);
				}
			})
		}
	})
}

function updateUnopened(user) {
	$.ajax({
		type:"GET",
		url:"Assets/Scripts/Php/get_user.php",
		success:function (username) {
			$.ajax({
				type:"GET",
				url:"Assets/Scripts/PHP/update_unopened.php?userto="+user+"&user="+username+"",
				success:function (data) {
					updatePage(data);
				}
			})
		}
	})
}

function updatePage(user) {
	window.location.href = "messages.php?userto="+user;
}
