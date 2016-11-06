<?php

include "sessionLogin.php";
include "logActivity.php";


if ($_SERVER["REQUEST_METHOD"] === "POST") {

	// Get posted data
	$username = $mysqli->real_escape_string($_POST["username"]);
	$password = $mysqli->real_escape_string($_POST["password"]);

	if ($username && $password) {

		$result = $mysqli->query("SELECT * FROM users WHERE username='$username'");
		if (!is_null($result)) $array = $result->fetch_assoc();
		if (!is_null($array["password"])) $dbPassword = $array["password"];
		if (!is_null($array["active"])) $userActive = $array["active"];

		if ($result->num_rows > 0 && $password == $dbPassword && $userActive == 1) {

			session_start();
			$_SESSION["username"] = $username;
			$_SESSION["password"] = $password;

			logActivity($mysqli, $username, "User login");
			header("Location: ../index.php");
		}
		else {
			logActivity($mysqli, "ADMIN", "Invalid login attempt U:$username, P:$password");

			$errorMessage = "Invalid login";
			header("Location: ../login.php?lError=$errorMessage");
		}
	}
	else {
		logActivity($mysqli, "ADMIN", "Empty login");

		$errorMessage = "Fields cannot be empty";
		header("Location: ../login.php?lError=$errorMessage");
	}
}
else {
	echo "You can't just navigate to this page, we need data!";
}
