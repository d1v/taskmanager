<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="/templates/taskmanager/tasks.png" type="image/x-icon">
	<script src="https://code.jquery.com/jquery-3.5.0.min.js"
	        integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ=" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
	        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
	        crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
	        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
	        crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
	      integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link href="/templates/taskmanager/style.css" rel="stylesheet">
	<script src="/templates/taskmanager/script.js"></script>
	<title>Taskmanager</title>
</head>
<body>
<div class="container-fluid">
	<div class="raw text-center">
		<a href="/" class="text-decoration-none nav-link">
			<h1>Taskmanager</h1>
		</a>
	</div>
	<div class="raw text-right">
		<? if (isset($arResult['admin'])): ?>
			<a href="/logout" id="logoutBtn" class="logBtn btn btn-dark">Log out</a>
		<? else: ?>
			<a href="" id="authFormBtn" class="logBtn btn btn-warning">Log in</a>
		<? endif; ?>
	</div>