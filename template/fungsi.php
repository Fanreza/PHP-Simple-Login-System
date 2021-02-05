<?php
// start a session
session_start();
// Connect database
$conn = mysqli_connect("localhost", "root", "", "data_login");


// Function take all data
function take($query){
	global $conn;
	global $rows;

	if (!$query) {
		echo mysqli_error($conn);
	}

	$result = mysqli_query($conn,$query);
	$rows = [];

	while ($row = mysqli_fetch_assoc($result) ) {
	   	array_push($rows , $row);

	};

	return $rows;
}

// function take data profile
function takeProfil($query){
	global $conn;

	$result = mysqli_query($conn , $query);
	$resultFetch = mysqli_fetch_assoc($result);

	$rows = [];
	array_push($rows , $resultFetch);

	return $rows;
}

// function registrasi page
function registrasi($data){
		global $conn;

		// capture and process data from the registrasi page
		$username = htmlspecialchars(strtolower(stripcslashes($data["username"])));
		$password = htmlspecialchars(mysqli_real_escape_string($conn , $data["password"]));
		$password2 = htmlspecialchars(mysqli_real_escape_string($conn , $data["password2"]));
		$nama = htmlspecialchars($data["nama"]);
		$alamat = htmlspecialchars($data["alamat"]);
		$email = htmlspecialchars($data["email"]);

		global $level;
		$level = $data['level'];

		// capture image
		$gambar = upload();

		if (!$gambar) {
			return false;
		}


		// check username availability
		$result = mysqli_query($conn , "SELECT username FROM data WHERE username = '$username' ");

		
		if (mysqli_fetch_assoc($result) ) {
			echo "<script> 

				    alert('username sudah terdaftar'); 

				  </script>";

			return false;
		}

		// check password confirm
		if ($password != $password2) {
			echo "<script> 

				    alert('konfirmasi password anda tidak sama'); 

				  </script>";
			return false;
		}

		// encrypt password
		$password = password_hash($password, PASSWORD_DEFAULT);

		// insert data to database
		mysqli_query($conn, "INSERT INTO data VALUES('','$username','$password','$nama','$alamat','$email','$level','$gambar')");

		return mysqli_affected_rows($conn);
	}



// function login page
function login(){
		global $conn;
		global $username;
		global $rows;

		// capture and process data from the login page
		$username = $_POST["username"];
		$password = $_POST["password"];

		// check the similarity of the username from the database and from the user input 
		$result = mysqli_query($conn , "SELECT * FROM data WHERE username = '$username' ");
		$resultFetch = mysqli_fetch_assoc($result);


		if (mysqli_num_rows($result) === 1) {
			
			// check the similarity of passwords from the database and from user input
			if (password_verify($password, $resultFetch["password"]) ) {
				// if the guest is a admin
				if ($resultFetch['level'] === 'admin') {
					$_SESSION['login'] = true;
					$_SESSION['nama'] = $username;
					$_SESSION['login-verif'] = $resultFetch['level'];
					$_SESSION['profilGambar'] = $resultFetch['gambar'];

				 	header("Location: dashboard-admin.php");
				 	exit;
				}
				
				// if the guest is a user
				elseif ($resultFetch['level'] === 'user') {
					$_SESSION['login'] = true;
					$_SESSION['nama'] = $username;
					$_SESSION['login-verif'] = $resultFetch['level'];
					$_SESSION['profilGambar'] = $resultFetch['gambar'];

				 	header("Location: dashboard-user.php");
				 	exit;
				}
			 	
			 } 

			 // if the password wrong
			 else {
			 	echo "<script> 

					    alert('password salah'); 

					  </script>";
			 }
		}

		// if the username is not exist in database
		else {
			echo "<script> 

					alert('username tidak terdaftar'); 

				  </script>";
		}
 }


// Function upload image
function upload() {

	// capture file array
	$namaFile = $_FILES['gambar']['name'];
	$sizeFile = $_FILES['gambar']['size'];
	$error = $_FILES['gambar']['error'];
	$tmpFile = $_FILES['gambar']['tmp_name'];

	// check if the image not uploaded
	if ($error === 4) {
		echo "<script> 

				alert('gambar belum di upload'); 

			  </script>";
	}

	// create allowed file extensions
	$imageEkstensionAllowed = ['jpg','png','jpeg'];

	// Check if the uploaded image is an image
	$imageEkstension = explode('.', $namaFile);

	$imageEkstension = strtolower(end($imageEkstension));

	if (!in_array($imageEkstension, $imageEkstensionAllowed)) {
	 	echo "<script> 

				alert('gambar belum di upload'); 

			  </script>";
	 } 

	 // check and limit the uploaded images
	 if ($sizeFile > 10000000) {
	 	echo "<script> 

				alert('gambar belum di upload'); 

			  </script>";
	 }

	 // generate new file name
	 $namaFileBaru = uniqid();
	 $namaFileBaru .= '.';
	 $namaFileBaru .= $imageEkstension;


	 // If the image passes checking, upload the image
	 move_uploaded_file($tmpFile, 'img-user/' . $namaFileBaru);

	 return $namaFileBaru;

}

// same as upload image but diffrent directory
function uploadAdd() {

	// capture file array
	$namaFile = $_FILES['gambar']['name'];
	$sizeFile = $_FILES['gambar']['size'];
	$error = $_FILES['gambar']['error'];
	$tmpFile = $_FILES['gambar']['tmp_name'];

	// check if the image not uploaded
	if ($error === 4) {
		echo "<script> 

				alert('gambar belum di upload'); 

			  </script>";
	}

	// create allowed file extensions
	$imageEkstensionAllowed = ['jpg','png','jpeg'];

	// Check if the uploaded image is an image
	$imageEkstension = explode('.', $namaFile);

	$imageEkstension = strtolower(end($imageEkstension));

	if (!in_array($imageEkstension, $imageEkstensionAllowed)) {
	 	echo "<script> 

				alert('gambar belum di upload'); 

			  </script>";
	 } 

	 // check and limit the uploaded images
	 if ($sizeFile > 10000000) {
	 	echo "<script> 

				alert('gambar belum di upload'); 

			  </script>";
	 }

	 // generate new file name
	 $namaFileBaru = uniqid();
	 $namaFileBaru .= '.';
	 $namaFileBaru .= $imageEkstension;


	 // If the image passes checking, upload the image
	 move_uploaded_file($tmpFile, '../img-user/' . $namaFileBaru);

	 return $namaFileBaru;

}



// Function total data
function row($query){
	global $conn;

	// query
	$result = mysqli_query($conn,$query);
	// sum total row
	$rows = mysqli_num_rows($result);

	return $rows;
}

// function total role 
function role($query){
	global $conn;
	global $level;
	// query
	$result = mysqli_query($conn,$query);
	// sum total row
	$rows = mysqli_num_rows($result);

	return $rows;
}



// function change password
function changePass($query){
	global $conn;
	global $rows;

	$password = $_POST["password"];
	$password2 = $_POST["password2"];
	$newPassword = $_POST["newPassword"];

	if (password_verify($password , $_SESSION["isi"]["password"]) ) {
		if ($newPassword === $password2) {

			$newPasswordHash  = password_hash($newPassword , PASSWORD_DEFAULT);

			$isi = mysqli_query($conn, "UPDATE data SET 
							password = '$newPasswordHash'

							WHERE id = '" . $_SESSION['id'] . "' ");
		}

		else {
			echo "<script> 

				    alert('konfirmasi password tidak sama');
				    
			      </script>";
		}
	}

	else {
		echo "<script> 

				    alert('password lama anda salah');
				    
			  </script>";
	}

	return mysqli_affected_rows($conn);

}


// =================================CRUD================================= //



// function delete data
function hapus($id){
	global $conn;
	// query
	mysqli_query($conn,"DELETE FROM data WHERE id = '$id' ");
	// return value affected
	return mysqli_affected_rows($conn);
}





// function add/create/insert
function tambah($data){
		global $conn;

		// capture and process data from the tambah page
		$username = htmlspecialchars(strtolower(stripcslashes($data["username"])));
		$password = htmlspecialchars(mysqli_real_escape_string($conn , $data["password"]));
		$password2 = htmlspecialchars(mysqli_real_escape_string($conn , $data["password2"]));
		$nama = htmlspecialchars($data["nama"]);
		$alamat = htmlspecialchars($data["alamat"]);
		$email = htmlspecialchars($data["email"]);

		global $level;
		$level = $data['level'];

		$gambar = uploadAdd();

		// if the image not exist
		if (!$gambar) {
			return false;
		}



		// check username availability
		$result = mysqli_query($conn , "SELECT username FROM data WHERE username = '$username' ");

		
		if (mysqli_fetch_assoc($result) ) {
			echo "<script> 

				    alert('username sudah terdaftar'); 

				  </script>";

			return false;
		}

		// check password confirm
		if ($password != $password2) {
			echo "<script> 

				    alert('konfirmasi password anda tidak sama'); 

				  </script>";
			return false;
		}

		// encrypt password
		$password = password_hash($password, PASSWORD_DEFAULT);

		// insert data to database
		mysqli_query($conn, "INSERT INTO data VALUES('','$username','$password','$nama','$alamat','$email','$level','$gambar')");

		return mysqli_affected_rows($conn);
	}






// function edit/update
function edit($data){
		global $conn;
		global $level;

		// capture and process data from the tambah page
		$id = ($data["id"]);
		$username = htmlspecialchars(strtolower(stripcslashes($data["username"])));
		$nama = htmlspecialchars($data["nama"]);
		$alamat = htmlspecialchars($data["alamat"]);
		$email = htmlspecialchars($data["email"]);
		if ($_SESSION['login-verif'] === 'admin') {
			$level = $data['level'];
		}
		$gambarLama = $data['gambarLama'];
		$roleLama = $data['roleLama'];

		// if the image is not edited
		if ($_FILES['gambar']['error'] === 4) {
			$gambar = $gambarLama;
		}

		// if the image is edited
		else {
			$gambar = uploadAdd();
		}

		// insert data to database
			mysqli_query($conn, "UPDATE data SET 
							username = '$username',
							nama = '$nama',
							alamat = '$alamat',
							email = '$email',
							level = '$level',
							gambar = '$gambar'

							WHERE id = '$id' ");

		return mysqli_affected_rows($conn);
	}



// edit for profil
function editProfile($data){
		global $conn;
		global $level;

		// capture and process data from the tambah page
		$id = ($data["id"]);
		$username = htmlspecialchars(strtolower(stripcslashes($data["username"])));
		$nama = htmlspecialchars($data["nama"]);
		$alamat = htmlspecialchars($data["alamat"]);
		$email = htmlspecialchars($data["email"]);
		$gambarLama = $data['gambarLama'];
		$roleLama = $data['roleLama'];

		// if the image is not edited
		if ($_FILES['gambar']['error'] === 4) {
			$gambar = $gambarLama;
		}

		// if the image is edited
		else {
			$gambar = uploadAdd();
		}

		// insert data to database
			mysqli_query($conn, "UPDATE data SET 
							username = '$username',
							nama = '$nama',
							alamat = '$alamat',
							email = '$email',
							level = '$roleLama',
							gambar = '$gambar'

							WHERE id = '$id' ");

		return mysqli_affected_rows($conn);
}


?>





