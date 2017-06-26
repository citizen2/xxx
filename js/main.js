function ajaxController(params, files = null) {

	var data = new FormData();

	// Если присутствуют файлы, добавить их в data
	if(files != null) {
		for(var key in files) {
			$.each(files[key][0].files, function(i, file) {
				data.append(key+i, file);
			});
		}
	}

	// Добавляет в data все ключи и их значения
	for(var key in params) {
		data.append(key, params[key]);
	}

	// Отправка data в PHP контроллер аjax запросов
	$.ajax({
		url: "controller/listenerController.php",
		type: "POST",
		data: data,
		contentType: false,
		processData: false,
		success: params.callback
	});
}
function sysErr(str) {
	var block = $('.syserr');
	block.html(str);
	block.fadeIn(300);
	setTimeout(function() {
		block.fadeOut(300);
	}, 3000);
}
