<?php

// Include functionalities
include "sessionLogin.php";
include "logActivity.php";


// Ensure this script is being accessed through a POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {

	// Get posted data
	$username = $mysqli->real_escape_string($_POST["username"]);
	$password = $mysqli->real_escape_string($_POST["password"]);

	// Ensure that the user entered a username and password
	if ($username && $password) {

		// Get user information from users table
		$result = $mysqli->query("SELECT * FROM users WHERE username='$username'");
		if (!is_null($result)) $array = $result->fetch_assoc();
		if (!is_null($array["password"])) $dbPassword = $array["password"];
		if (!is_null($array["active"])) $userActive = $array["active"];

		// Ensure that the user exists, has a correct password, and the user is active
		if ($result->num_rows > 0 && $password == $dbPassword && $userActive == 1) {

			// Log that the user was logged in
			logActivity($mysqli, $username, "User login");

			// Initialize session variables and redirect to the actual page
			session_start();
			$_SESSION["username"] = $username;
			$_SESSION["password"] = $password;
			header("Location: ../index.php");
		}
		else {
			// Log that a user tried to log in with invalid credentials
			logActivity($mysqli, "ADMIN", "Invalid login attempt U:$username, P:$password");

			// Redirect back to login page with the error
			$errorMessage = "Invalid login";
			header("Location: ../login.php?lError=$errorMessage");
		}
	}
	else {
		// Log that a user tried to log in with empty credentials
		logActivity($mysqli, "ADMIN", "Empty login");

		// Redirect back to login page with the error
		$errorMessage = "Fields cannot be empty";
		header("Location: ../login.php?lError=$errorMessage");
	}
}
else {
	echo "You can't just navigate to this page, we need data!";
}
