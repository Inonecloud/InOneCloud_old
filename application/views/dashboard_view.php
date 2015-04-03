<?php if(Session::get('loggedIn') == true):?>			
Hello 
<?php $username = Session::get('username');?>
<?php endif; ?>		
<?php echo $username; ?>