<?php

	$db=mysqli_connect("localhost","root","","db_licenta");


	if (mysqli_connect_errno()) {
		echo "Eroare la conexiunea la BD: ".mysqli_connect_error();
		exit;
	}

?>