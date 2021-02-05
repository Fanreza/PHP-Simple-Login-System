<?php 
require_once "template/fungsi.php";

// Login Verif
if (!isset($_SESSION["login"]  )) {
	header("Location: login.php");
}


$isi = takeProfil("SELECT * FROM data WHERE username = '" . $_SESSION['nama'] . "' ");

?>


<!DOCTYPE html>
<html>
<head>
	<title>Profile</title>
	<link rel="icon" type="image/png" href="aset/img/logokampak.png">
	<link rel="stylesheet" type="text/css" href="aset/css/style.css">
</head>
<body>

	<?php 

	if ($_SESSION['login-verif'] === 'admin') {
		include "template/nav-template.php";
	}

	else {
		include "template/nav-template-user.php";
	}

	 ?>


	<div class="container-profile">
		<div class="profile">
			<div class="profile-image">
				<img src="img-user/<?= $_SESSION['profilGambar'] ?>">
			</div>

			<div class="data-profile">
				<div class="data-label">
					<div class="data">
						<label>Nama</label>
						<label>Alamat</label>
						<label>Email</label>
						<label>Role</label>
						<label>Username</label>
					</div>
				</div>

				<div class="data-label2">
					<div class="data">
						<label>:</label>
						<label>:</label>
						<label>:</label>
						<label>:</label>
						<label>:</label>
					</div>
				</div>

				<div class="data-user">
					<?php foreach ($isi as $isian) :?>
						<div class="data">
							<p><?= $isian["nama"]; ?></p>
							<p><?= $isian["alamat"]; ?></p>
							<p><?= $isian["email"]; ?></p>
							<p><?= $isian["level"]; ?></p>
							<p><?= $isian["username"];?></p>
						</div>
					<?php endforeach ?>
				</div>
			</div>

			<div class="button-help">
				<div class="edit">
					<a href="template/edit-profil.php?id=<?= $isian["id"]?>">edit</a>
				</div>

				<div class="change-pass">
					<a href="template/cpass.php?id=<?= $isian["id"]?>">ganti password</a>
				</div>
			</div>
		</div>
	</div>
</body>
</html>