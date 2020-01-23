<?php
	include 'login.php';
	if(isset($_POST['regis'])){
		$username = $_POST["username"];
		$password = md5($_POST["password"]);
		$sql = "INSERT INTO `user` (`username`, `password`) VALUES ('$username', '$password');";
		$db = new DB();
		$db->query($sql);
		echo "<script>alert('success regis silahkan login dahulu')</script>";
	}
?>