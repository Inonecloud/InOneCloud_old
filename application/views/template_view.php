<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="/css/styles.css">
	<link rel="icon" type="image/ico" href="/img/favicon.ico">
	<title>InOneCloud</title>
</head>
<body>
	<header>
		<nav>
			<h1 id="logo">InOneCloud</h1>
			<ul>
				<li><a href="/">Home</a></li>
				<li><a href="about">About</a></li>
				<?php if(Session::get('loggedIn') == true):?>
				<li><a href="dashboard/logout">Log out</a></li>
				<?php else: ?>	
				<li><a href="registration">Registration</a></li>
				<?php endif; ?>			
			</ul>
		</nav>
		<?php include 'application/views/'.$content_view; ?>
		
	</header>
	<article>
		
	</article>
	<footer>
		<div id="foot">
			<p>Andrew Yelmanov (c) 2015</p>
			<div id="footermenu">
				<ul>
					<li><a href="/">Home</a></li>
					<li><a href="about">About</a></li>
					<?php if(Session::get('loggedIn') == true):?>
					<li><a href="dashboard/logout">Log out</a></li>
					<?php else: ?>	
					<li><a href="registration">Registration</a></li>
					<?php endif; ?>					
				</ul>
			</div>
			<div id="partners">
				<ul>
					<li><a href="https://drive.google.com">Google Drive</a></li>
					<li><a href="https://disk.yandex.ru">Yandex Disk</a></li>				
				</ul>
			</div>
		</div>
	</footer>
</body>
</html>
