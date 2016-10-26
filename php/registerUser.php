<?php

include "sessionLogin.php";
include "logActivity.php";


if ($_SERVER["REQUEST_METHOD"] === "POST") {

	session_start();

	$username = $mysqli->real_escape_string($_POST["username"]);
    $password = $mysqli->real_escape_string($_POST["password"]);
    
    $sql = ("INSERT INTO users (username, password) VALUES (?, ?)");
	$stmt = $mysqli->prepare($sql);
	$stmt->bind_param("ssd", $username, $password);
	$stmt->execute();
	$user_id = $stmt->insert_id;
	$stmt->close();
	
	$_SESSION["user_id"] = $user_id;
	$_SESSION["username"] = $username;
	$_SESSION["password"] = $password;
	
	logActivity($user_id, "Account registered");
}
else {

}