<?php if(Session::get('loggedIn') == true):?>			
Hello 
<?php $username = Session::get('username');?>
<?php $yatocken = Session::get('yatoken');?>
<?php endif; ?>		
<?php echo $username . "<br/>"; ?>
<?php echo $yatocken; ?>
<a href="dashboard/yandex_connect">Подключиться к Яндексу</a>