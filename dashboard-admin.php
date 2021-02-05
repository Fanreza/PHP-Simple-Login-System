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

$total_data = row("SELECT * FROM data");
// echo 'total data adalah ',"$total_data" ;

$total_admin = role("SELECT level FROM data WHERE level = 'admin' ");
// echo 'total data adalah ',"$total_admin" ;

$total_user = role("SELECT level FROM data WHERE level = 'user ' ");
// echo 'total data adalah ',"$total_user" ;


 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Dashboard</title>
	<link rel="icon" type="image/png" href="aset/img/logokampak.png">
	<link rel="stylesheet" type="text/css" href="aset/css/style.css">
</head>
<body>


<div class="container-landing">
	<?php include "template/nav-template.php" ?>

	<div class="dashboard">
		<div class="head-name">
			<p>Selamat Datang <?= $_SESSION['nama']; ?></p>
		</div>

		<div class="dataset">
			<div class="card">
				<div class="circle"><h1 class="total-data"><?= $total_data ?></h1></div>
				<div class="text"><span><img src="aset/img/database.png"></span> Total Data</div>
			</div>

			<div class="card">
				<div class="circle"><h1 class="total-admin"><?= $total_admin ?></h1></div>
				<div class="text"><span><img src="aset/img/admin.png"></span> Total Admin Role</div>
			</div>

			<div class="card">
				<div class="circle"><h1 class="total-user"><?= $total_user ?></h1></div>
				<div class="text"><span><img src="aset/img/user.png"></span> Total User Role</div>
			</div>
		</div>
	</div>
</div>						



</body>
</html>