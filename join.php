<?php

$partyName = $_POST['name'];

mysql_connect("mysql.cs147.org","jpulvera","eymQqu6V") or die(mysql_error());
mysql_select_db("jpulvera_mysql") or die(mysql_error());
$query =
	"SELECT * " .
	"FROM parties " .
	"WHERE name = '" . mysql_real_escape_string($partyName) . "'";
$result = mysql_query($query) or die(mysql_error());

if ($row = mysql_fetch_array($result)) {
	$partyID = $row['id'];
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
			"SET party = " . $partyID . " " .
			"WHERE ip = '" . $ip . "'";
	} else {
		// New user, add to table
		$query =
			"INSERT INTO users " .
			"VALUES ('" . $ip . "', 0, " . $partyID . ")";
	}
	$result = mysql_query($query) or die(mysql_error());
	echo 'OK';
} else {
	echo 'NOT FOUND';
}

mysql_close();
?>
