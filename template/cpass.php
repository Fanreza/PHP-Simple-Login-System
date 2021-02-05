<?php
require_once "fungsi.php";

$_SESSION['id'] = $_GET['id'];



$_SESSION['isi'] = take("SELECT * FROM data WHERE id = '" . $_SESSION['id'] . "' ")[0];


if( isset($_POST['edit']) ){
		if(changePass($_POST) > 0 ){
				echo "<script> 

				    alert('password berhasil diganti');
				    window.location.href = '../profile.php' ;

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
	<title>Ganti Password</title>
	<link rel="icon" type="image/png" href="../aset/img/logokampak.png">
	<link rel="stylesheet" type="text/css" href="../aset/css/style.css">
</head>
<body>
 	<div class="container">
		<div class="regis-box">
			<div class="head">
				<h1>Ganti Password</h1>
			</div>
			<div class="form-regis">
				<form action="" method="post">
					<div class="input-box">

						<input type="password" name="password" id="password" placeholder="Masukan Password Lama" required>

						<input type="password" name="newPassword" id="newPassword" placeholder="Masukan Password Baru" required>

						<input type="password" name="password2" id="password2" placeholder="Konfirmasi Password" required>

						<div class="button">
							<button class="submit" name="edit">Ganti</button>
							<a href="../profile.php">Batal</a>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>


</body>		
</html>