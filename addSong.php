<?php

include "connect_db.php";

$ip = $_SERVER['REMOTE_ADDR'];
$songID = $_POST["songID"];

// Look up user to find which party they're in
$query = "SELECT party FROM users WHERE ip='$ip';";
$result = mysql_query($query) or die(mysql_error());
if ($row = mysql_fetch_array($result)) {
	$partyID = $row['party'];
	//Tests to see if this is the only song in the party
	$testQuery = "SELECT * FROM playlist WHERE partyID = $partyID;";
	$testResult = mysql_query($testQuery) or die(mysql_error());
	$isFirst = 0;
	if(mysql_num_rows($testResult) == 0) $isFirst = 1;
	// Now, make sure the song isn't already in the playlist for that party
	$query = "SELECT * FROM playlist WHERE songID=$songID AND partyID=$partyID;";
	$result = mysql_query($query) or die(mysql_error());
	if(!mysql_num_rows($result)) {
		if($isFirst == 1)$query = "INSERT INTO playlist (songID, partyID, rating, time, isPlaying)" . "VALUES ('$songID', '$partyID', '1', CURRENT_TIMESTAMP, 1);";
		if($isFirst == 0)$query = "INSERT INTO playlist (songID, partyID, rating, time, isPlaying)" . "VALUES ('$songID', '$partyID', '1', CURRENT_TIMESTAMP, 0);";
		mysql_query($query) or die(mysql_error());
		$insertVoteQuery = "INSERT INTO votes (ip, songID, isUpvote) VALUES ('$ip', '$songID', '1')";
                mysql_query($insertVoteQuery) or die(mysql_error());

		if($isFirst) echo 'ADDED1';
		else echo 'ADDED';
	} else {
		echo 'ALREADY_IN_PLAYLIST';
	}
} else {
	echo 'NO_PARTY';
}

?>
