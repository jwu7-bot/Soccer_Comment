<?php

/*******w******** 
    
    Name: Jiahui Wu
    Date: 4/23/2024
    Description: Login page

****************/

include('server.php'); 

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="header">
		<h2>Login</h2>
	</div>
	 
	<form method="post" action="login.php">
		<!-- errors -->
		<?php include('errors.php'); ?>

		<!-- username -->
		<div class="input-group">
			<label>Username</label>
			<input type="text" name="username" >
		</div>

		<!-- password -->
		<div class="input-group">
			<label>Password</label>
			<input type="password" name="password">
		</div>

		<!-- submit button -->
		<div class="input-group">
			<button type="submit" class="btn" name="login_user">Login</button>
		</div>

		<!-- register -->
		<p>Not yet a member? <a href="register.php">Sign up</a></p>
	</form>
</body>
</html>