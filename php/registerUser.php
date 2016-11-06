<?php

include "sessionLogin.php";
include "logActivity.php";


if ($_SERVER["REQUEST_METHOD"] === "POST") {

	// Get posted data
	$username = $mysqli->real_escape_string($_POST["username"]);
	$password = $mysqli->real_escape_string($_POST["password"]);
	
	// Check if user exists
	$result = $mysqli->query("SELECT * FROM users WHERE username='$username'");
	if ($result->num_rows == 0 && $username != "ADMIN") {

		$stmt = $mysqli->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
		$stmt->bind_param("ss", $username, $password);
		$stmt->execute();

		logActivity($mysqli, $username, "Account registered");

		session_start();
		$_SESSION["username"] = $username;
		$_SESSION["password"] = $password;
		header("Location: ../index.php");
	}
	else {
		logActivity($mysqli, "ADMIN", "Duplicate registration: (U: ".$username.")");
		echo "Username already exists";
	}
}
else {
	echo "You can't just navigate to this page, we need data!";
}
