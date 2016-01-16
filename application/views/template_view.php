<!DOCTYPE html>
<html>
<head>
	<meta charset = "utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/styles.css">
	<link rel="icon" type="image/ico" href="/img/favicon.ico">
    <link rel="apple-touch-icon" sizes="152x152" href="/img/apple-touch-icon.png">
	<title><?=(isset($this->title)) ? $this->title :'InOneCloud';?></title>
	
	<script type="text/javascript">
		function ChangeText()
		{
			//document.body.style.backgroundColor="lavender";
			document.getElementById("caption").innerHTML="¯\\_(ツ)_/¯ What's next?";
			document.getElementById("caption").style.fontFamily="Segoe UI";
			document.getElementById("caption").style.fontSize="2.2em";
		}
	</script>
</head>
<body>
	<!--Top Menu-->
	<header id="logo">
		<h1 id = "caption" onclick="ChangeText()">InOneCloud</h1>
		<nav>
			<ul class="topmenu">
				<?php if(Session::get('loggedIn') == true):?>
				<li><a href="dashboard">Home</a></li>
				<li><a href="settings">Settings</a></li>
				<li><a href="dashboard/logout">Log out</a></li>
				<?php else: ?>
				<li><a href="/">Home</a></li>
				<li><a href="about">About</a></li>
				<li><a href="registration">Sign Up</a></li>
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
				<?php if(Session::get('loggedIn') == true):?>
				<li><a href="dashboard">Home</a></li>
				<li><a href="settings">Settings</a></li>
				<li><a href="dashboard/logout">Log out</a></li>
				<?php else: ?>
				<li><a href="/">Home</a></li>
				<li><a href="about">About</a></li>
				<li><a href="registration">Registration</a></li>
				<?php endif; ?>	
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