<?php 

/*******w******** 
    
    Name: Jiahui Wu
    Date: 4/22/2024
    Description: Registration page

****************/

include('server.php'); 

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" type="text/css" href="style.css">
	<title>Register</title>
</head>
<body>
	<div class="header">
		<h2>Register</h2>
	</div>
	
	<form method="post" action="register.php">
		<!-- errors -->
		<?php include('errors.php'); ?>

		<!-- username field -->
		<div class="input-group">
			<label>Username</label>
			<input type="text" name="username" value="">
		</div>

		<!-- email field -->
		<div class="input-group">
			<label>Email</label>
			<input type="email" name="email" value="">
		</div>

		<!-- password field -->
		<div class="input-group">
			<label>Password</label>
			<input type="password" name="password_1">
		</div>

		<!-- confirm password -->
		<div class="input-group">
			<label>Confirm password</label>
			<input type="password" name="password_2">
		</div>

		<!-- submit button -->
		<div class="input-group">
			<button type="submit" class="btn" name="reg_user">Register</button>
		</div>

		<!-- login -->
		<p>Already a member? <a href="login.php">Sign in</a></p>
	</form>
</body>
</html>