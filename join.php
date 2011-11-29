<?php

include "connect_db.php";

$partyID = $_POST['id'];

if ($partyID == "NO_ID") {
	$partyName = $_POST['name'];
	// Escape html characters
	$partyName = htmlspecialchars($partyName);
	// Max length of party name
	$partyName = substr($partyName, 0, 255);
	$query =
		"SELECT * " .
		"FROM parties " .
		"WHERE name = '" . mysql_real_escape_string($partyName) . "'";
	$result = mysql_query($query) or die(mysql_error());
	if ($row = mysql_fetch_array($result)) {
		$partyID = $row['id'];
	}
}
if ($partyID != "NO_ID") {
	//$ip = $_SERVER['REMOTE_ADDR'];
	$ip = "128.12.121.28";
	$query = "SELECT * FROM users WHERE ip = '$ip'";
	$result = mysql_query($query) or die(mysql_error());
	if ($row = mysql_fetch_array($result)) {
			// User already in our table
		if($row['party'] != $partyID){
			$query = "UPDATE users SET isAdmin = 0, party = '$partyID' WHERE ip = '$ip'";
		}
	} 
	else {
		// New user, add to table
		$query =
			"INSERT INTO users " .
			"VALUES ('" . $ip . "', 0, " . $partyID . ")";
	}
	$result = mysql_query($query) or die(mysql_error());
	echo 'OK';
} else {
	echo $partyID;
}

mysql_close();
?>
