<?php if(Session::get('loggedIn') == true):?>			
Hello 
<?php $username = Session::get('username');?>
<?php endif; ?>		
<?php echo $username; ?>
<a href="dashboard/yandex_connect">Подключиться к Яндексу</a>