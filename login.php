<!DOCTYPE html>
<html>
	<head>
		<?php include "partials/head.html" ?>
		<title>Login - CS212</title>
	</head>
	<body>
		<div class="main-container">
			<div class="main-header material">
				<ul>
					<li><a href="login.php">Login</a></li>
				</ul>
			</div>
			<div class="main-body">
				<div class="main-body-sidebar">
					Welcome!
				</div>
				<div class="main-body-content">
					<h3>Login</h3>
					<form action="php/validateLogin.php" method="post">
						<?php if(isset($_GET["lError"])) echo "<div class='error-message'>".$_GET["lError"]."</div>"; ?>
						<input type="text" placeholder="Username" name="username" />
						<input type="password" placeholder="Password" name="password" />
						<button type="submit">Submit</button>
					</form>

					<h3>Register</h3>
					<form action="php/registerUser.php" method="post">
						<?php if(isset($_GET["rError"])) echo "<div class='error-message'>".$_GET["rError"]."</div>"; ?>
						<input type="text" placeholder="Username" name="username" />
						<input type="password" placeholder="Password" name="password" />
						<button type="submit">Submit</button>
					</form>
				</div>
			</div>
			<div class="main-footer material">
				ph289@nau.edu
			</div>
		</div>
	</body>
</html>