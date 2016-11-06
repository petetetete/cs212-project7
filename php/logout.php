<?php

// Include functionalities
include "sessionLogin.php";
include "logActivity.php";

session_start();

// Ensure there is a username, but if the user is at the logout button it should already exist
if (isset($_SESSION["username"])) {

	// Log taht the user logged out
	logActivity($mysqli, $_SESSION["username"], "User logout");

	// Destroy session variables and reidrect back to login page
	session_destroy();
	header("Location: ../login.php");
}
