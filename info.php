<?php 
	include "php/bounceCheck.php";
	include "php/sessionLogin.php";
?>

<!DOCTYPE html>
<html>
	<head>
		<?php include "partials/head.html" ?>
		<title>Info - CS212</title>
	</head>
	<body>
		<div class="main-container">

			<?php include "partials/navbar.html" ?>

			<div class="main-body">
				<div class="main-body-sidebar">
					View and edit some of your account settings. Want to change your password? We got that. Want to delete your account off the face of the Earth? We got that too.
				</div>
				<div class="main-body-content">
					<h2 class="partay-img">Change Password</h2>
					<form action="php/changeInfo.php" method="post">
						<input type="text" placeholder="New password" name="newPassword" />
						<button type="submit">Submit</button>
					</form>

					<h2 class="blue-img">Delete Account</h2>
					<form action="php/deleteAccount.php" method="post">
						<?php if(isset($_GET["daError"])) echo "<div class='error-message'>".$_GET["daError"]."</div>"; ?>
						<input type="text" placeholder="Confirm username" name="username" />
						<button type="submit">Submit</button>
					</form>

					<h2 class="partay-img">Archive Activity Log</h2>
					<form action="php/archiveActivity.php" method="post">
						<?php if(isset($_GET["aaError"])) echo "<div class='error-message'>".$_GET["aaError"]."</div>"; ?>
						<input type="text" placeholder="Confirm username" name="username" />
						<button type="submit">Submit</button>
					</form>

					<h2 class="magenta-img">Activity Log</h2>
					<table>
						<?php
							// Display table of activity log data
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

		<script type="text/javascript" src="js/validate.js"></script>
	</body>
</html>