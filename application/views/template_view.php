<!DOCTYPE html>
<html>
<head>
	<meta charset = "utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="js/init.js"></script>
	<link rel="stylesheet" type="text/css" href="css/styles.css">
	<link rel="stylesheet" type="text/css" href="css/styles-normal.css">
	<link rel="icon" type="image/ico" href="/img/favicon.ico">
	<title>InOneCloud</title>
</head>
<body>
	<!--Top Menu-->
	<header id="logo">
		<h1>InOneCloud</h1>
		<nav>
			<ul class="topmenu">
				<?php if(Session::get('loggedIn') == true):?>
				<li><a href="dashboard">Home</a></li>
				<li><a href="#">Settings</a></li>
				<li><a href="dashboard/logout">Log out</a></li>
				<?php else: ?>
				<li><a href="/">Home</a></li>
				<li><a href="about">About</a></li>
				<li><a href="registration">Registration</a></li>
				<?php endif; ?>	
			</ul>
		</nav>
	</header>
	<!--End Top Menu-->

	<?php include 'application/views/'.$content_view; ?>
	
	<!--Footer-->
	<footer id="footer">
		<ul class="copyright">
			<li>Andrew Yelmanov</li>
			<li>&copy; 2015</li>
		</ul>
		<nav class="buttonmenu">
			<ul class="repeatemenu">
				<li><a href="">Home</a></li>
				<li><a href="">About</a></li>
				<li><a href="">Registration</a></li>
			</ul>
			<ul class="storages">
				<li><a href="https://drive.google.com">Google Drive</a></li>
				<li><a href="https://disk.yandex.ru">Yandex Disk</a></li>
			</ul>
		</nav>
	</footer>
	<!--End Footer-->
</body>
</html>