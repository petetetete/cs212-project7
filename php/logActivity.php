<?php

function logActivity($mysqli, $username, $descr) {
	$mysqli->query("INSERT INTO activity(username, activity_descr) VALUES('$username', '$descr')");
}
