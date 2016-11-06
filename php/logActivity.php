<?php

// Function used to log into activity table that will be used in many places
function logActivity($mysqli, $username, $descr) {
	$mysqli->query("INSERT INTO activity(username, activity_descr) VALUES('$username', '$descr')");
}
