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
	$mysqli->query("INSERT INTO threads (name, username) VALUES ('$threadName', '$username')");

	// Log that the thread was created
	logActivity($mysqli, $username, "Created thread: $threadName");

	// Redirect back to the forum page
	header("Location: ../forum.php");
else {
	echo "You can't just navigate to this page, we need data!";
}
