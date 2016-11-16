<?php

// Include functionalities
include "sessionLogin.php";
include "logActivity.php";


// Ensure this script is being accessed through a POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {

	session_start();

	// Get POST data
	$newPassword = $mysqli->real_escape_string($_POST["newPassword"]);

	// Update entry in database and local variable
	$mysqli->query("UPDATE users SET password='$newPassword' WHERE username='".$_SESSION['username']."'");
	$_SESSION["password"] = $_POST["newPassword"];

	// Log the fact that they changed password and redirect back to info
	logActivity($mysqli, $_SESSION["username"], "Password changed");
	header("Location: ../info.php");
}
else {
	echo "You can't just navigate to this page, we need data!";
}
