<?php

include "sessionLogin.php";
include "logActivity.php";


if ($_SERVER["REQUEST_METHOD"] === "POST") {
	$username = $mysqli->real_escape_string($_POST["username"]);
    $password = $mysqli->real_escape_string($_POST["password"]);
    
    $sql = ("SELECT * FROM users where id = '".$username."'");
    $result = $mysqli->query($sql) or die($mysqli->error);
    $array = $result->fetch_assoc();
}