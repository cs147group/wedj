<?php

include("connect_db.php");

$partyName = $_POST['name'];
$lat = $_POST['lat'];
$lon = $_POST['lon'];

// No blank party names
if ($partyName == "") {
	$partyName = "Party";
}
// Escape html characters
$partyName = htmlspecialchars($partyName);
// Max length of party name
$partyName = substr($partyName, 0, 250);

$query =
	"SELECT * " .
	"FROM parties " .
	"WHERE name = '" . mysql_real_escape_string($partyName) . "'";
$result = mysql_query($query) or die(mysql_error());

if ($row = mysql_fetch_array($result)) {
	$nSuggestion = 0;
	while ($row) {
		$nSuggestion++;
		$suggestion = $partyName . $nSuggestion;
		$query =
			"SELECT * " .
			"FROM parties " .
			"WHERE name = '" . mysql_real_escape_string($suggestion) . "'";
		$result = mysql_query($query) or die(mysql_error());
		$row = mysql_fetch_array($result);
	}
	echo $suggestion;
} else {
	$query =
		"INSERT INTO parties (name, lat, lon, time) " .
		"VALUES ('" . mysql_real_escape_string($partyName) . "', " .
		$lat . ", " . $lon . ", " . time() . ")";
	mysql_query($query) or die(mysql_error());
	$partyID = mysql_insert_id();
	// Now, save this info for the user
	$ip = $_SERVER['REMOTE_ADDR'];
	$query =
		"SELECT * " .
		"FROM users " .
		"WHERE ip = '" . $ip . "'";
	$result = mysql_query($query) or die(mysql_error());
	if ($row = mysql_fetch_array($result)) {
		// User already in our table
		$query =
			"UPDATE users " .
			"SET isAdmin = 1, party = " . $partyID . " " .
			"WHERE ip = '" . $ip . "'";
	} else {
		// New user, add to table
		$query =
			"INSERT INTO users " .
			"VALUES ('" . $ip . "', 1, " . $partyID . ")";
	}
	mysql_query($query) or die(mysql_error());
	echo 'OK';
}

mysql_close();

?>
