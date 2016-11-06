<?php

include "sessionLogin.php";
include "logActivity.php";


if ($_SERVER["REQUEST_METHOD"] === "POST") {

	session_start();

	if ($_SESSION["username"] == $_POST["username"]) {
		$mysqli->query("UPDATE users SET active=0 WHERE username='".$_POST["username"]."'") or die($mysqli->error);
		logActivity($mysqli, $_POST["username"], "User deleted");

		session_destroy();
		header("Location: ../login.html");
	}
	else {
		echo "Username does not match.";
	}
}
else {
	echo "You can't just navigate to this page, we need data!";
}
