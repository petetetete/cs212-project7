<?php

// Include functionalities
include "sessionLogin.php";
include "logActivity.php";


// Ensure this script is being accessed through a POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {

	session_start();

	// Get data
	$threadID = $mysqli->real_escape_string($_POST["threadID"]);
	$postID = $mysqli->real_escape_string($_POST["postID"]);
	$message = $mysqli->real_escape_string($_POST["message"]);
	$username = $_SESSION["username"];
	
	// Check if user entered a message
	if ($message) {

		$mysqli->query("UPDATE posts SET message='$message' WHERE post_id='$postID'");

		// Log that the post was updated
		logActivity($mysqli, $username, "Updated post ($postID) in thread ($threadID)");
		header("Location: ../thread.php?id=$threadID");
	}
	else {

		$mysqli->query("UPDATE posts SET message=' --- Message Deleted ---' WHERE post_id='$postID'");

		// Log that the post was deleted
		logActivity($mysqli, $username, "Deleted post ($postID) in thread ($threadID)");
		header("Location: ../thread.php?id=$threadID");
	}
}
else {
	echo "You can't just navigate to this page, we need data!";
}
