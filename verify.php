<?php
if(isset($_POST['submit'])){
	$username = "user";
	$password = "pass";
	$username_in = $_POST["username"];
	$password_in = $_POST["password"];

	if (($username==$username_in) && ($password==$password_in)) {
		header("Location: admin.php");
	}else{
		header("Location: login.php");
	}
}else{
	header("Location: login.php");
}
?>
