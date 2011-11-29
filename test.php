<?php
include("connect_db.php");
$ip = $_SERVER['REMOTE_ADDR'];
	$query = "SELECT * FROM users WHERE ip = '$ip'";
	$result = mysql_query($query) or die(mysql_error());
	if ($row = mysql_fetch_array($result)) {
		// User already in our table
		if($row['party'] != $partyId) $query ="UPDATE users SET isAdmin = 0, party = 'partyID' WHERE ip = '$ip'";
		 
	} 
	else $query ="INSERT INTO users VALUES ('$ip', 0, '$partyID')";
	$result = mysql_query($query) or die(mysql_error());
	echo 'OK';	
?>
