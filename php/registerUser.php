<?php

// Include functionalities
include "sessionLogin.php";
include "logActivity.php";


// Ensure this script is being accessed through a POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {

	// Get posted data
	$username = $mysqli->real_escape_string($_POST["username"]);
	$password = $mysqli->real_escape_string($_POST["password"]);

	// Check if user exists
	$result = $mysqli->query("SELECT * FROM users WHERE username='$username'");
	if ($result->num_rows == 0 && $username != "ADMIN") {

		// Add new user to the table
		$mysqli->query("INSERT INTO users (username, password) VALUES ('$username', '$password')");

		// Log that the user was created
		logActivity($mysqli, $username, "Account registered");

		// Initialize session variables and redirect to the actual page
		session_start();
		$_SESSION["username"] = $username;
		$_SESSION["password"] = $password;
		header("Location: ../index.php");
	}
	else {
		// Log that a user tried to register with a duplicate username
		logActivity($mysqli, "ADMIN", "Duplicate registration U:".$username);

		// Redirect back to login page with the error
		$errorMessage = "Username already exists";
		header("Location: ../login.php?rError=$errorMessage");
	}
}
else {
	echo "You can't just navigate to this page, we need data!";
}
