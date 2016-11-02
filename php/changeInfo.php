<?php

include "sessionLogin.php";
include "logActivity.php";


if ($_SERVER["REQUEST_METHOD"] === "POST") {
	if (isset($_SESSION["username"])) {
		$newPassword = $mysqli->real_escape_string($_POST["newPassword"]);
		$mysqli->query("UPDATE users SET password='$newPassword' WHERE username='".$_SESSION['username']."'") or die($mysqli->error);
	}
	else {
		echo "You are not logged in.";
	}
}
else {
	echo "You can't just navigate to this page, we need data!";
}