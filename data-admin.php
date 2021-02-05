<?php 
require_once "template/fungsi.php";
// Login Verif
if (!isset($_SESSION["login"]  )) {
	header("Location: login.php");
}

if ($_SESSION['login-verif'] === 'user') {
			header("Location: dashboard-user.php");
			exit;
		}

$isi = take("SELECT * FROM data WHERE username != '" . $_SESSION['nama'] . "' ");


 ?>


<!DOCTYPE html>
<html>
<head>
	<title>Data</title>
	<link rel="icon" type="image/png" href="aset/img/logokampak.png">
	<link rel="stylesheet" type="text/css" href="aset/css/style.css">
	
</head>
<body>
	<div class="container-admin">

		<?php include "template/nav-template.php" ?>

		<div class="data-right">
			<div class="create">
				<a href="template/tambah.php">tambah data</a>
			</div>

			<div class="table">
				<table cellspacing="0">
					<th>NO</th>
					<th>gambar</th>
					<th>username</th>
					<th>nama</th>
					<th>alamat</th>
					<th>email</th>
					<th>Role</th>
					<th>aksi</th>

					<?php $no = 1 ?>
					<?php foreach( $isi as $isian) :?>
						<tr>
							<td> <?= $no ?> </td>
							<td><img src="img-user/<?= $isian["gambar"]; ?>" width="50" height="50"></td>
							<td> <?= $isian["username"];?></td>
							<td> <?= $isian["nama"]; ?></td>
							<td> <?= $isian["alamat"]; ?></td>
							<td> <?= $isian["email"]; ?></td>
							<td> <?= $isian["level"]; ?></td>
							<td><a href="template/edit.php?id=<?= $isian["id"]?>" class="edit">edit</a>

								 <a onclick="return confirm('Anda akan menghapus sebuah data');" href="template/hapus.php?id=<?= $isian["id"]?>" class="hapus">hapus</a>
							</td>
						</tr>
					<?php $no++ ?>
					<?php endforeach; ?>

				</table>
			</div>
		</div>
	</div>






	
</body>
</html>