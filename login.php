<?php 
	require "fungsi.php";


	if (isset($_POST["login"])) {
		login();
	}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Login Page</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="container">
		<div class="login-box">
			<div class="image">
				<img src="aset/logokampak.png">
			</div>
			<div class="form">
				<form action="" method="post">
					<input type="text" name="username" id="username" placeholder="Masukan Username" required>
					<br>
					<input type="password" name="password" id="password" placeholder="Masukan Password" required>
					<br>
					<div class="button">
						<button type="submit" class="submit" name="login" id="login">Login</button>
						<a href="regis.php" class="register" name="register" id="register">Registrasi</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>
</html>