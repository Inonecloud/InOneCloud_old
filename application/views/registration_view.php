<div id="registration">
	<h2>Registration</h2>
	<form id="reg" method="post" action="/registration/add_user">
		<fieldset>
			<lable>Username</lable><input id="username" name="username" type="text" required>
			<label>E-mail</label></label><input id="email" name="email" type="email" required>
			<lable>Password</lable><input id="password" name="password" type="password" required>
			<label>Confirm password</label><input id="confpassword" name="confpassword" type="password" required>
		</fieldset>
		<fieldset>
			<input id="submit" type="submit" name="registrate" value="Registration">
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