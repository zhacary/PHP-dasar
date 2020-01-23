<!DOCTYPE html>
<html>
<head>
	<title>Register</title>
</head>
<body>
	<h1>Register</h1>
	<?php include "db.php"; $d = new DB() ?>
<form action="index.php" method="post">
	<label>Username</label>
	<input type="text" name="username"><br>
	<label>Password</label>
	<input type="password" name="password"><br>
	<input type="submit" name="regis" value="Regis">
	<input type="reset" name="reset" value="Reset">
</form>
<a href="login.php"><button>Login</button></a>
</body>
</html>