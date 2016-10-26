<?php

include "sessionLogin.php";

function logActivity($user_id, $descr) {
	$sql = ("INSERT INTO activity (user_id, activity_descr) VALUES (?, ?)");
	$stmt = $mysqli->prepare($sql);
	$stmt->bind_param("ssd", $user_id, $descr);
	$stmt->execute();
	$stmt->close();
}
