<?php

// Include functionalities
include "sessionLogin.php";
include "logActivity.php";


// Ensure this script is being accessed through a POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {

	session_start();

	// Get data
	$threadName = $mysqli->real_escape_string($_POST["threadName"]);
	$username = $_SESSION["username"];
	
	// Ensure that the user entered a thread name
	if ($threadName) {

		$mysqli->query("INSERT INTO threads (name, username) VALUES ('$threadName', '$username')");

		// Log that the thread was created
		logActivity($mysqli, $username, "Created thread: $threadName");

		//header("Location: ../index.php");
	}
	else {
		logActivity($mysqli, $username, "Tried to create thread with no name");

		// Redirect back to login page with the error
		//$errorMessage = "Fields cannot be empty";
		//header("Location: ../login.php?rError=$errorMessage");
	}
}
else {
	echo "You can't just navigate to this page, we need data!";
}
