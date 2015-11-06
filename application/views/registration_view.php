<!-- Main-->
<!-- <article id="main" class="container">
	<header>
				<h2>Create your InOneCloud Account</h2>

				<h2>Unfortunately, registration is not avalible now</h2>

				<p>If you want to take a part in testing write your email here and we send you login and password</p>
				<form method="post" action="/registration/subscribe">
					<input type="email" name="testemail" id="email" placeholder="example@example.com">
					<input type="submit" value="send">
				</form>
				<p>Best Regards<br>InOne Team<br></p>

				<p>You can create your account here</p>
			</header>
		</article>-->

<article id="main" class="container">	
	<header class="aboutcloud">
		<h2>Create your InOneCloud account</h2>
		<hr>
	</header>
	<article id="registration">
		<p>You can create your personal account here.</p>	
		<form id="regist" method="post" action="registration/add_user">
			<fieldset id="inputs">
				<input class ="username" name="username" type="text" placeholder="Username" autofocus required>
				<input class="email" name="email" type="email" placeholder="Email" required>
				<input class="password" name="password" type="password" placeholder="Password" required pattern="[0-9a-zA-Z]{6,32}" title="Password should have 6 sybols with digits">
				<input class="password" name="CNFpassword" type="password" placeholder="Repeat password" required>
				<select name="lang">
					<option></option>
					<option value="en">English</option>
					<option value="de">Deutsch</option>
					<option value="ru">Русский</option>
				</select>
			</fieldset>
			<fieldset id="actions">
				<input type="checkbox" required><label>I agree with license</label>
				<input class="submit" type ="submit" name="Registration" value = "Create account">
			</fieldset>
		</form>	
	</article>	
</article> 
<!--End Main-->

<!--
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
		</fieldset>-->
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