<?php 
	require 'fungsi.php';

	if( isset($_POST['register']) ){
		if(registrasi($_POST) > 0 ){
			echo "<script> 

				    alert('Anda berhasil didaftarkan');
				    window.location.href = 'login.php';

				  </script>";
		}
		else {
			echo mysqli_error($conn);
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Registrasi</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="container">
		<div class="regis-box">
			<div class="head">
				<h1>Pendaftaran Anggota</h1>
			</div>
			<div class="form-regis">
				<form action="" method="post">
					<div class="input-box">
						<input type="text" name="username" id="username" placeholder="Username" required>

						<input type="password" name="password" id="password" placeholder="Password" required>

						<input type="password" name="password2" id="password2" placeholder="Konfirmasi Password" required>

						<input type="text" name="nama" id="nama" placeholder="Nama" required>

						<textarea name="alamat" id="alamat" placeholder="Alamat" required></textarea>

						<input type="email" name="email" id="email" placeholder="Email" required>
					</div>

						<div class="level">
							<div class="admin">
								<input type="radio" name="level" id="admin" value="admin" required>
								<label for="admin">Administrator</label>
							</div>
							
							<div class="user">
								<input type="radio" name="level" id="user" value="user" required>
								<label for="user">User</label>
							</div>
						</div>
					

					<div class="button-regis">
						<button class="submit" name="register">Daftar</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>
</html>