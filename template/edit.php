<?php 
require_once "fungsi.php";

if (!isset($_SESSION["login"]  )) {
	header("Location: login.php");
}

// ambil data dari url
$id = $_GET["id"];
global $level;

// query data berdasarkan id
$isi = take("SELECT * FROM data WHERE id = '$id' ")[0];

// cek apakah data berhasil diubah
	if( isset($_POST['edit']) ){
		if(edit($_POST) > 0 ){
				echo "<script> 

				    alert('data berhasil diedit');
				    window.location.href = '../data-admin.php';

				  </script>";
		}
		else {
			echo mysqli_error($conn);
		}
	}

// 
	if ($isi['level'] === $level) {
		echo "<script> 

				    alert('data berhasil diedit');
				    window.location.href = '../data-admin.php';

				    
			  </script>";
	}
 ?>



<!DOCTYPE html>
<html>
<head>
	<title>edit</title>
	<link rel="icon" type="image/png" href="../aset/img/logokampak.png">
	<link rel="stylesheet" type="text/css" href="../aset/css/style.css">
</head>
<body>
	<div class="container">
		<div class="regis-box">
			<div class="head">
				<h1>Edit Data Anggota</h1>
			</div>
			<div class="form-regis">
				<form action="" method="post" enctype="multipart/form-data">
					<div class="input-box">
						<input type="hidden" name="id" class="id" value="<?= $isi["id"];?>">
						<input type="hidden" name="roleLama" value="<?= $isi["level"];?>">
						<input type="hidden" name="gambarLama" class="gambarLama" id="gambarLama" value="<?= $isi["gambar"] ?>">

						<input type="text" name="username" id="username" placeholder="Username" required
						value="<?= $isi["username"];?>">

						<input type="text" name="nama" id="nama" placeholder="Nama" required value="<?= $isi["username"];?>">

						<input type="hidden" name="password" id="password" placeholder="Password" required>

						<input type="hidden" name="password2" id="password2" placeholder="Konfirmasi Password" required>

						<input style="height: 80px;" name="alamat" id="alamat" placeholder="Alamat" value="<?= $isi["alamat"];?>"></input>

						<input type="email" name="email" id="email" placeholder="Email" required value="<?= $isi["email"];?>">

						<div class="image-preview">
							<img  src="../img-user/<?= $isi["gambar"]; ?>">
							<input type="file" name="gambar" id="file" class="file">
						</div>
					</div>

						<?php 

						if ($_SESSION['login-verif'] === 'admin') {
							echo 

						'<div class="level">
							<div class="admin">
								<input type="radio" name="level" id="admin" value="admin"required>
								<label for="admin">Administrator</label>
							</div>
							
							<div class="user">
								<input type="radio" name="level" id="user" value="user" required>
								<label for="user">User</label>
							</div>
						</div>';

						}

						 ?>
					

					<div class="button-regis">
						<button class="submit" name="edit">Edit Data</button>
						<?php 
						if ($_SESSION['login-verif'] === 'admin') {
							echo '<a href="../dashboard-admin.php">Batal</a>';
						}

						else {
							echo '<a href="../dashboard-user.php">Batal</a>';
						}

						 ?>
					</div>

				</form>
			</div>
		</div>
	</div>
</body>
</html>