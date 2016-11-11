<?php 
	include "php/bounceCheck.php";
	include "php/sessionLogin.php";
?>

<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="css/forum.css" />
		<?php include "partials/head.html" ?>
		<title>Forum - CS212</title>
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
								echo "<a href='thread.php?id=".$result["thread_id"]."' class='thread-post clearfix'>";
								echo 	"<div class='thread-info'>";
								echo 		"<div class='thread-info-line'>".$result["time"]."</div>";
								echo 		"<div class='thread-info-line'>(id:".$result["thread_id"].") ".$result["username"]."</div>";
								echo 	"</div>";
								echo 	"<div class='thread-name'>".$result["name"]."</div>";
								echo "</a>";
							}
						?>
					</div>
					<h2 class="blue-img">Create New Thread</h2>
					<form action="php/createThread.php" method="post">
						<?php if(isset($_GET["fError"])) echo "<div class='error-message'>".$_GET["fError"]."</div>"; ?>
						<input type="text" name="threadName" placeholder="Thread name" />
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