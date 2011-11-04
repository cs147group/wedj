<?php

include "connect_db.php";

$ip = $_SERVER['REMOTE_ADDR'];

$songID = $_POST["songID"];

$query = "SELECT party FROM users WHERE ip='$ip';";
$result = mysql_query($query) or die(mysql_error());
$row = mysql_fetch_array($result) or die(mysql_error());
$partyID = $row['party'];

$query2 = "SELECT * FROM playlist WHERE songID=$songID AND partyID=$partyID;";
$result2 = mysql_query($query2) or die(mysql_error());
if(!mysql_num_rows($result2)) {
	echo "trying to add";
	$query2 = "INSERT INTO playlist (songID, partyID, rating, time) 
	VALUES ('$songID', '$partyID', '1', CURRENT_TIMESTAMP);";
	mysql_query($query2) or die(mysql_error());
}

?>