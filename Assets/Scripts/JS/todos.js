var largestID = 0;
function createHtmlObj(obj) {
	if (obj.completed == 0) {
		html = '<li class="todo-item" data-date="'+obj.date+'" data-complete="'+obj.completed+'"><input class="todo-check" id="todo-'+obj.id+'" onclick="removeTodo(this)" type="checkbox" name="name" value=""><label for="todo-'+obj.id+'">'+obj.task+'</label></li>'
	} else {
		html = '<li class="todo-item" data-date="'+obj.date+'" data-complete="'+obj.completed+'"><input class="todo-check" id="todo-'+obj.id+'" checked="true" onclick="removeTodo(this)" type="checkbox" name="name" value=""><label for="todo-'+obj.id+'">'+obj.task+'</label></li>'
	}
	largestID = parseInt(obj.id);
	return html;
}

function addTask() {
	var text = $('.add-task').val();
	largestID += 1;
	var obj = {
		id:largestID,
		task:text,
		completed:0,
		date:new Date()
	}
	console.log(obj);
	updateDB(obj)
	appendTask(obj);

}

function updateDB(obj) {
	var URL = "Assets/Scripts/PHP/add_task.php?task="+obj.task+"&completed="+obj.completed+"";
	$.ajax({
		type:"POST",
		url:URL,
	})
}

getTodos();
function getTodos() {
	$.ajax({
		type:"GET",
		url:"Assets/Scripts/PHP/get_todos.php",
		dataType:"json",
		success:function (data) {
			console.log(data.length);
			for (var i = 0; i < data.length; i++) {
				appendTask(data[i]);
			}
		},
		error: function (err) {
			console.log(err);
		}
	})
}

function removeTodo(elem) {
	var complete = $(elem).parent().data("complete");
	var parent = $(elem).parent();
	var id = $(elem).prop("id");
	$('#' + id).parent().remove();
	id = id.substring(5);
	if (complete == 0) {
		$('.completed-todo-list').append(parent);
		complete = 1;
	} else {
		$('.todo-list').append(parent);
		complete = 0;
	}
	$(elem).parent().data("complete", complete);
	$.ajax({
		type:"GET",
		url:"Assets/Scripts/PHP/update_todos.php?id="+id+"&completed="+complete+"",
	})
}

function appendTask(obj) {
	html = createHtmlObj(obj);
	if (obj.completed == 0) {
		$('.todo-list').append(html);
	} else {
		$('.completed-todo-list').append(html);
	}
}

function showList(elem) {
	if ($(elem).prop("checked")) {
		$('#todo').find('.panel-title').text("Completed Todos");
		$('.todo-list').slideUp();
		$('.completed-todo-list').slideDown();
	} else {
		$('#todo').find('.panel-title').text("Todos");
		$('.completed-todo-list').slideUp();
		$('.todo-list').slideDown();
	}
}
