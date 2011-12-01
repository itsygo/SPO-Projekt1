<?php
/*
roles:
	login page naredit z PHP. 
	http://www.9lessons.info/2009/09/php-login-page-example.html

session:
	v session se shrani:
	username, usertype
	
	!!! login funkcije so v functions.php
	
todo:
	session expire time?
*/
?>
<?php include ("header.php"); ?>
	<div id="content">
		<form id="formlogin" method="post" action="">
			<p>
				<label for="username">Uporabniško ime: </label>
				<input type="text" name="username" id="username" />
			</p>
			<p>
				<label for="password">Geslo: </label>
				<input type="password" name="password" id="password" />
			</p>
			<p>
				<input type="submit" id="login" name="login" value="Prijava" />
			</p>
			<p>
				<?php echo $error; ?>
			</p>
		</form>
        <div>
           <form id="formR" method="post" action="register.php">
            <p><input type="submit" id="register" name="register" value="Registracija študenta" /></p>
           </form>
        </div>
	</div>
<?php include ("footer.php"); ?>