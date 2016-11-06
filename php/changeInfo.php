<?php

include "sessionLogin.php";
include "logActivity.php";


if ($_SERVER["REQUEST_METHOD"] === "POST") {

	session_start();

	$newPassword = $mysqli->real_escape_string($_POST["newPassword"]);

	
	$mysqli->query("UPDATE users SET password='$newPassword' WHERE username='".$_SESSION['username']."'") or die($mysqli->error);

	logActivity($mysqli, $_SESSION["username"], "Password changed P:".$_SESSION["password"]);
	$_SESSION["password"] = $_POST["newPassword"];

	header("Location: ../info.php");
}
else {
	echo "You can't just navigate to this page, we need data!";
}
