<?php 
require_once "fungsi.php";


	if( isset($_POST['tambah']) ){
		if(tambah($_POST) > 0 ){
			echo "<script> 

				    alert('data berhasil ditambahkan');
				    window.location.href = '../data-admin.php';

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
	<title>Tambah</title>
	<link rel="icon" type="image/png" href="../aset/img/logokampak.png">
	<link rel="stylesheet" type="text/css" href="../aset/css/style.css">
</head>
<body>
	<div class="container">
		<div class="regis-box">
			<div class="head">
				<h1>Tambah Data Anggota</h1>
			</div>
			<div class="form-regis">
				<form action="" method="post" enctype="multipart/form-data">
					<div class="input-box">
						<input type="text" name="username" id="username" placeholder="Username" required>

						<input type="password" name="password" id="password" placeholder="Password" required>

						<input type="password" name="password2" id="password2" placeholder="Konfirmasi Password" required>

						<input type="text" name="nama" id="nama" placeholder="Nama" required>

						<input name="alamat" id="alamat" placeholder="Alamat" required></input>

						<input type="email" name="email" id="email" placeholder="Email" required>

						<input type="file" name="gambar" id="file" class="file">
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
						<button class="submit" name="tambah">Tambah Data</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>
</html>