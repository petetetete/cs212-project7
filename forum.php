<?php 
	include "php/bounceCheck.php";
	include "php/sessionLogin.php";
?>

<!DOCTYPE html>
<html>
	<head>
		<?php include "partials/head.html" ?>
		<link rel="stylesheet" type="text/css" href="css/forum.css" />
		<title>Info - CS212</title>
	</head>
	<body>
		<div class="main-container">

			<?php include "partials/navbar.html" ?>

			<div class="main-body">
				<div class="main-body-sidebar">
					Welcome to the site forum! Feel free to create a thread, post in an existing thread, and participate in conversation!
				</div>
				<div class="main-body-content">
					<h2 class="magenta-img">Threads</h2>
					<div class="forum-container">
						<?php
							// Display table of activity log data
							$results = $mysqli->query("SELECT * FROM threads") or die($mysqli->error);
							while($result = $results->fetch_assoc()) {
								echo "<div class='thread-post clearfix'>";
								echo 	"<div class='thread-info'>";
								echo 		"<div class='thread-info-line'>".$result["time"]."</div>";
								echo 		"<div class='thread-info-line'>".$result["username"]."</div>";
								echo 	"</div>";
								echo 	"<div class='thread-name'>".$result["thread_id"].". ".$result["name"]."</div>";
								echo "</div>";
							}
						?>
					</div>
				</div>
			</div>
			<div class="main-footer material">
				ph289@nau.edu
			</div>
		</div>
	</body>
</html>