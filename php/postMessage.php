<?php

// Include functionalities
include "sessionLogin.php";
include "logActivity.php";


// Ensure this script is being accessed through a POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {

	session_start();

	// Get data
	$threadID = $mysqli->real_escape_string($_POST["threadID"]);
	$message = $mysqli->real_escape_string($_POST["message"]);
	$username = $_SESSION["username"];
	
	// Ensure that the user entered a message
	if ($message) {

		$mysqli->query("INSERT INTO posts (thread_id, username, message) VALUES ('$threadID', '$username', '$message')");

		// Log that the thread was created
		logActivity($mysqli, $username, "Posted in thread ($threadID)");
		header("Location: ../thread.php?id=$threadID");
	}
	else {
		logActivity($mysqli, $username, "Tried to post empty message in thread ($treadID)");

		// Redirect back to the thread with the error
		$errorMessage = "Field cannot be empty";
		header("Location: ../thread.php?id=$threadID&pError=$errorMessage");
	}
}
else {
	echo "You can't just navigate to this page, we need data!";
}
