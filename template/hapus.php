<?php 
require_once "fungsi.php";

$id = $_GET["id"];

if (hapus($id) > 0) {
	echo "<script> 

			alert('data berhasil dihapus');
			document.location.href ='../data-admin.php';

		  </script>";
}

elseif (hapus($id) ==1) {
	echo "<script> 

		    alert('data gagal dihapus'); 
		    document.location.href ='../data-admin.php';

		  </script>";
}
 ?>