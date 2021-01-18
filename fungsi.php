<?php 
// Connect database
$conn = mysqli_connect("localhost", "root", "", "data_login");


// function registrasi page
function registrasi($data){
		global $conn;

		// capture and process data from the registrasi page
		$username = strtolower(stripcslashes($data["username"]));
		$password = mysqli_real_escape_string($conn , $data["password"]);
		$password2 = mysqli_real_escape_string($conn , $data["password2"]);
		$nama = $data["nama"];
		$alamat = $data["alamat"];
		$email = $data["email"];
		$level = $data['level'];


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
		mysqli_query($conn, "INSERT INTO data VALUES('','$username','$password','$nama','$alamat','$email','$level')");

		return mysqli_affected_rows($conn);
	}




// function login page
function login(){
		global $conn;

		// capture and process data from the login page
		$username = $_POST["username"];
		$password = $_POST["password"];

		// check the similarity of the username from the database and from the user input 
		$result = mysqli_query($conn , "SELECT * FROM data WHERE username = '$username' ");

		if (mysqli_num_rows($result) === 1) {
			
			// check the similarity of passwords from the database and from user input
			$row = mysqli_fetch_assoc($result);

			if (password_verify($password, $row["password"]) ) {
			 	header("Location: index.php");
			 	exit;
			 } 

			 else {
			 	echo "<script> 

					    alert('password salah'); 

					  </script>";
			 }
		}

		else {
			echo "<script> 

					    alert('username tidak terdaftar'); 

					  </script>";
		}
}
?>