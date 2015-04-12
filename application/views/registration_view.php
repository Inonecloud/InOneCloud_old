<div id="registration">
	<h2>Create your InOneCloud Account</h2>
	<form id="reg" method="post" action="/registration/add_user">
		<fieldset>
			<lable>Username</lable><input class="username" name="username" type="text" required>
			<label>E-mail</label></label><input class="email" name="email" type="email" required>
			<lable>Password</lable><input class="password" name="password" type="password" required>
			<label>Confirm password</label><input class="confpassword" name="confpassword" type="password" required>
		</fieldset>
		<fieldset>
			<input class="submit" type="submit" name="registrate" value="Registration">
		</fieldset>
		<!--<script type="text/javascript">
		console.log("Hello");
		var pass = document.getElementByID(password).value;
		var cPass = document.getElementByID(confpassword).value;
		var input = document.getElementById('input');
		console.log("pass");

		function CheckPassword(pass, cpass)
		{
			//console.log(pass);
			if( pass = cPass)
				return false;
			else
				return true;
				//alert("Пароли должны совпадать");
		}
		</script>-->
</div>