<?php

// Include functionalities
include "sessionLogin.php";
include "logActivity.php";


// Ensure this script is being accessed through a POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {

	session_start();

	// Ensure that they entered the same username as is on record
	if ($_SESSION["username"] == $_POST["username"]) {

		// Update active column in user database to delete user safely
		$mysqli->query("UPDATE users SET active=0 WHERE username='".$_POST["username"]."'") or die($mysqli->error);
		logActivity($mysqli, $_POST["username"], "User deleted");

		// Destroy session variables and redirect back to login
		session_destroy();
		header("Location: ../login.php");
	}
	else {
		// Redirect back to info page with error message
		$errorMessage = "Username does not match";
		header("Location: ../info.php?daError=$errorMessage");
	}
}
else {
	echo "You can't just navigate to this page, we need data!";
}
