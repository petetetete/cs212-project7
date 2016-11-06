<?php

include "sessionLogin.php";
include "logActivity.php";


if ($_SERVER["REQUEST_METHOD"] === "POST") {

	// Get posted data
	$username = $mysqli->real_escape_string($_POST["username"]);
	$password = $mysqli->real_escape_string($_POST["password"]);
	
	if ($username && $password) {
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

			$errorMessage = "Username already exists";
			header("Location: ../login.php?rError=$errorMessage");
		}
	}
	else {
		logActivity($mysqli, "ADMIN", "Empty registration");

		$errorMessage = "Fields cannot be empty";
		header("Location: ../login.php?rError=$errorMessage");
	}
}
else {
	echo "You can't just navigate to this page, we need data!";
}
