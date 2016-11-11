<?php 
	include "php/bounceCheck.php";
	include "php/sessionLogin.php";

	if (!isset($_GET["id"])) header("Location: forum.php");
	else {
		$threadID = $_GET["id"];
		$results = $mysqli->query("SELECT * FROM threads WHERE thread_id='$threadID'") or die($mysqli->error);
		$threadData = $results->fetch_assoc();
		$threadName = $threadData["name"];
		$threadUserName = $threadData["username"];
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="css/forum.css" />
		<?php include "partials/head.html" ?>
		<title>Thread - CS212</title>
	</head>
	<body>
		<div class="main-container">

			<?php include "partials/navbar.html" ?>

			<div class="main-body">
				<div class="main-body-sidebar">
					<div>Thread: <?php echo $threadName ?></div>
					<div>Created by: <?php echo $threadUserName ?></div>
				</div>
				<div class="main-body-content">
					<h2 class="magenta-img">Posts</h2>
					<div class="forum-container">
						<?php
							// Display table of activity log data
							$results = $mysqli->query("SELECT * FROM posts WHERE thread_id='$threadID'") or die($mysqli->error);
							while($result = $results->fetch_assoc()) {
								echo "<div class='post-post clearfix'>";
								echo 	"<div class='post-info'>";
								echo 		"<div class='post-info-line'>User: ".$result["username"]."</div>";
								echo 		"<div class='post-info-line small-text'>Posted: ".$result["time"]."</div>";
								echo 	"</div>";
								echo 	"<div class='post-message'>";
								echo 		"<div class='post-edit'><input type='checkbox' /><label>edit</label></div>";
								if ($result["username"] == $_SESSION["username"]) {
									echo 	"<form class='post-message-edit' action='php/updateMessage.php' method='post'>";
									echo 		"<input type='hidden' name='threadID' value='$threadID' />";
									echo 		"<input type='hidden' name='postID' value='".$result["post_id"]."' />";
									echo 		"<textarea rows='9' name='message'>".$result["message"]."</textarea>";
									echo 		"<button type='submit'>Edit Message</button>";
									echo 	"</form>";
								}
								echo 		"<span class='post-message-text'>".$result["message"]."</span>";
								echo 	"</div>";
								echo "</div>";
							}
						?>
					</div>
					<h2 class="blue-img">Create New Post</h2>
					<form action="php/postMessage.php" method="post">
						<?php if(isset($_GET["pError"])) echo "<div class='error-message'>".$_GET["pError"]."</div>"; ?>
						<input type="hidden" name="threadID" value="<?php echo $threadID ?>" />
						<textarea name="message" rows="5" placeholder="Enter your post... (1000 character limit)"></textarea>
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