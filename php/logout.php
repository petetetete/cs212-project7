<?php

include "sessionLogin.php";
include "logActivity.php";

session_start();

if (isset($_SESSION["username"])) {

	logActivity($mysqli, $_SESSION["username"], "User logout");

	session_destroy();
	header("Location: ../login.php");
}
