$(document).ready(function(){

	$('#addFormBtn').on('click', function(e){
		e.preventDefault();
		$('#addTaskModal').modal();
	});

	$('#authFormBtn').on('click', function(e){
		e.preventDefault();
		$('#authModal').modal();
	});

	$('.editFormBtn').on('click', function () {
		taskId = false;
		$('#editTaskArea').val($('#task-'+$(this).attr('data')).attr('data'));
		taskId = $(this).attr('data');
		$('#editTaskModal').modal();
	});


	$('#editTaskForm').on('submit', function (e) {
		e.preventDefault();
		$.ajax({
			data: {'id': taskId, 'newText': $('#editTaskArea').val()},
			url: '/editTask',
			type: 'POST',
			dataType: 'json',
			success: function (data) {
				if (data.error !== undefined) {
					if(data.error == 'auth') {
						alert('Need log in!');
						$('#editTaskModal').modal('hide');
						$('#authModal').modal();
					} else {
						$('#editError').css({'display' : 'block'});
						$('#editError').html(data.error);
					}
				} else if (data.error === undefined) {
					alert('Task edit successfully!');
					location.reload(true);
				}
			},
			error: function (data) {
				$('#editError').html('Failed to edit task!');
			}
		});
	});

	$('.doneBtn').on('click', function () {
		$.ajax({
			data: {'id': $(this).attr('data')},
			url: '/doneTask',
			type: 'POST',
			dataType: 'json',
			success: function (data) {
				if (data.error !== undefined) {
					if(data.error == 'auth') {
						alert('Need log in!');
						$('#authModal').modal();
					} else {
						alert('Failed to done task!');
					}
				} else if (data.error === undefined) {
					alert('Task done successfully!');
					location.reload(true);
				}
			},
			error: function (data) {
				alert('Failed to done task!');
			}
		});
	});

	$('.undoneBtn').on('click', function () {
		$.ajax({
			data: {'id': $(this).attr('data')},
			url: '/undoneTask',
			type: 'POST',
			dataType: 'json',
			success: function (data) {
				if (data.error !== undefined) {
					if(data.error == 'auth') {
						alert('Need log in!');
						$('#authModal').modal();
					} else {
						alert('Failed to undone task!');
					}
				} else if (data.error === undefined) {
					alert('Task undone successfully!');
					location.reload(true);
				}
			},
			error: function (data) {
				alert('Failed to undone task!');
			}
		});
	});

	$('#authForm').on('submit', function(e){
		e.preventDefault();
		$.ajax({
			data: { 'login': $('#loginInput').val(), 'password': $('#passwordInput').val()},
			url: '/login',
			type: 'POST',
			dataType: 'json',
			success: function (data) {
				if (data.error !== undefined) {
					$('#loginError').css({'display' : 'block'});
					$('#loginError').html(data.error);
				} else if (data.error === undefined) {
					$('#loginError').html('');
					$('#loginError').css({'display' : 'none'});
					$('#passwordInput').val('');
					$('#loginInput').val('');
					alert('Log in successfully!');
					location.reload(true);
				}
			},
			error: function (data) {
				$('#loginError').html('Failed to log in!');
			}
		});
	});

	$('#addTaskForm').on('submit', function(e){
		e.preventDefault();
		$.ajax({
			data: { 'name': $('#nameInput').val(), 'email': $('#emailInput').val(), 'text':$('#taskArea').val()},
			url: '/addTask',
			type: 'POST',
			dataType: 'json',
			success: function (data) {
				if (data.error !== undefined) {
					$('#contentError').css({'display' : 'block'});
					$('#contentError').html(data.error);
				} else if (data.error === undefined) {
					$('#contentError').html('');
					$('#contentError').css({'display' : 'none'});
					$('#taskArea').val('');
					$('#nameInput').val('');
					$('#emailInput').val('');
					alert('Task add successfully!');
					location.reload(true);
				}
			},
			error: function (data) {
				$('#contentError').html('Failed to add task!');
			}
		});

	});
});