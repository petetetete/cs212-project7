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
					Welcome to the best placeholder discussion board you've ever seen. Lorem ipsum, meet foo bar. Oh, TEST4, what a jokester you are.
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
						<input type="text" name="threadName" data-validate="true" placeholder="Thread name" />
						<button type="submit">Submit</button>
					</form>
				</div>
			</div>
			<div class="main-footer material">
				ph289@nau.edu
			</div>
		</div>

		<script type="text/javascript" src="js/validate.js"></script>
	</body>
</html>