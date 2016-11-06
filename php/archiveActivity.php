<?php

include "sessionLogin.php";
include "logActivity.php";


if ($_SERVER["REQUEST_METHOD"] === "POST") {

	session_start();

	if ($_SESSION["username"] == $_POST["username"]) {
		logActivity($mysqli, $_POST["username"], "Activity log archived");
		$out = fopen("../archive/".$_POST["username"]."-".time().".csv", "a");
		$results = $mysqli->query("SELECT * FROM activity WHERE username='".$_POST["username"]."'") or die($mysqli->error);
		while($result = $results->fetch_assoc()) {
			fputcsv($out, $result);
		}
		$mysqli->query("DELETE FROM activity WHERE username='".$_POST["username"]."'") or die($mysqli->error);
		fclose($out);

		header("Location: ../info.php");
	}
	else {
		$errorMessage = "Username does not match";
		header("Location: ../info.php?aaError=$errorMessage");
	}
}
else {
	echo "You can't just navigate to this page, we need data!";
}
