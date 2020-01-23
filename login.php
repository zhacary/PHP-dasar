<!DOCTYPE html>
<html>
<head><meta charset="utf-8">
    <title>
    Login user
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.1/umd/popper.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>
<body>
	<h1>Login</h1>
	<?php include "db.php"; $d = new DB() ?>
	<div class="col">
<form action="" method="post">
	<label>Username</label>
	<input type="text" name="username"><br>
	<label>Password</label>
	<input type="password" name="password"><br>
	<input type="submit" class="btn btn-success" name="login" value="Login">
	<input type="reset"  class="btn btn-primary" name="reset" value="Reset">
	</div>
</form>
<br><br>
<a href="register.php"><button>Register</button></a>
</body>
</html>

<?php 
	if(isset($_POST["login"])){
		$username = $_POST["username"];
		$password = md5($_POST["password"]);
		$sql = "SELECT * FROM user WHERE username = '".$username."' AND password = '".$password."'";
		$result = $d->getList($sql);
		$success = false;
		if(!empty($result)){
			echo "<script>alert('Success')</script>";
			$success = true;
		}else{
			echo "<script>alert('Login Gagal')</script>";
		}

		if($success){
			header('location: jabatan.php?username='.$username);
		}
	}

 ?>