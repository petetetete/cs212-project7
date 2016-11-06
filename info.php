<?php 
	include "php/bounceCheck.php";
	include "php/sessionLogin.php";
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="css/style.css" />
		<link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
		<title>Info - CS212</title>
	</head>
	<body>
		<div class="main-container">

			<?php include "partials/navbar.html" ?>

			<div class="main-body">
				<div class="main-body-sidebar">
					I am also a sidebar but my content is less coolio
				</div>
				<div class="main-body-content">
					<h2 class="partay-img">Change Password</h2>
					<form action="php/changeInfo.php" method="post">
						<input type="text" placeholder="New password" name="newPassword" />
						<button type="submit">Submit</button>
					</form>

					<h2 class="blue-img">Delete Account</h2>
					<form action="php/deleteAccount.php" method="post">
						<input type="text" placeholder="Confirm username" name="username" />
						<button type="submit">Submit</button>
					</form>

					<h2 class="blue-img">Archive Activity Log</h2>
					<form action="php/archiveActivity.php" method="post">
						<input type="text" placeholder="Confirm username" name="username" />
						<button type="submit">Submit</button>
					</form>

					<h2 class="magenta-img">Activity Log</h2>
					<table>
						<?php
							$results = $mysqli->query("SELECT * FROM activity WHERE username='".$_SESSION["username"]."'") or die($mysqli->error);
							while($result = $results->fetch_assoc()) {
								echo "<tr><td>".$result["time"]."</td><td>".$result["activity_descr"]."</td></tr>";
							}
						?>
					</table>
				</div>
			</div>
			<div class="main-footer material">
				ph289@nau.edu
			</div>
		</div>
		<div class="fixed-notification material">
			Just regular news!
		</div>
	</body>
</html>