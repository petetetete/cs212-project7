<?php

// Include functionalities
include "sessionLogin.php";
include "logActivity.php";


// Ensure this script is being accessed through a POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {

	session_start();

	// Ensure that they entered the same username as is on record
	if ($_SESSION["username"] == $_POST["username"]) {

		// Write to log table that they have archived the log
		logActivity($mysqli, $_POST["username"], "Activity log archived");

		// Write to new file in archives folder what the activity was
		$out = fopen("../archive/".$_POST["username"]."-".time().".csv", "a");
		$results = $mysqli->query("SELECT * FROM activity WHERE username='".$_POST["username"]."'") or die($mysqli->error);
		while($result = $results->fetch_assoc()) {
			fputcsv($out, $result);
		}
		$mysqli->query("DELETE FROM activity WHERE username='".$_POST["username"]."'") or die($mysqli->error);
		fclose($out);

		// Redirect back to the info page
		header("Location: ../info.php");
	}
	else {
		// Error message if the username was not the same
		$errorMessage = "Username does not match";
		header("Location: ../info.php?aaError=$errorMessage");
	}
}
else {
	echo "You can't just navigate to this page, we need data!";
}
