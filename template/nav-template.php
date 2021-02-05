
	<div class="nav-template">
		<div class="profile-image">
			<img src="./img-user/<?= $_SESSION['profilGambar'] ?>">
		</div>
		
		<div class="link" id="nav">
			<div class="nav-link">
				<img src="./aset/img/dashboard.png" width="50" height="50">
				<a href="./dashboard-admin.php" class="nav">Dashboard</a>
			</div>

			<div class="nav-link">
				<img src="./aset/img/database.png" width="50" height="50">
				<a href="./data-admin.php" class="nav">Lihat Data</a>
			</div>

			<div class="nav-link">
				<img src="./aset/img/user.png" width="50" height="50">
				<a href="profile.php" class="nav">Profile</a>
			</div>

			<div class="nav-link">
				<img src="./aset/img/logout.png" width="50" height="50">
				<a href="logout.php" class="nav">Logout</a>
			</div>
		</div>
	</div>

