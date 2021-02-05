<?php 
	require "template/fungsi.php";

	if (isset($_SESSION["login"] )) {
		if ($_SESSION['login-verif'] === 'admin') {
			header("Location: dashboard-admin.php");
			exit;
		}
		else {
			header("Location: dashboard-user.php");
			exit;
		}
	}



	if (isset($_POST["login"])) {
		login();
	}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Login Page</title>
	<link rel="icon" type="image/png" href="aset/img/logokampak.png">
	<link rel="stylesheet" type="text/css" href="aset/css/style.css">
</head>
<body>
	<div class="container">
		<div class="login-box">
			<div class="image">
				<img src="aset/img/logokampak.png">
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