<?php

include "connect_db.php";

$ip = $_SERVER['REMOTE_ADDR'];
$songID = $_POST["songID"];

// Look up user to find which party they're in
$query = "SELECT party FROM users WHERE ip='$ip';";
$result = mysql_query($query) or die(mysql_error());
if ($row = mysql_fetch_array($result)) {
	$partyID = $row['party'];
	// Now, make sure the song isn't already in the playlist for that party
	$query = "SELECT * FROM playlist WHERE songID=$songID AND partyID=$partyID;";
	$result = mysql_query($query) or die(mysql_error());
	if(!mysql_num_rows($result)) {
		$enqueueQuery = "INSERT INTO playlist (songID, partyID, rating, time, isPlaying)" . "VALUES ('$songID', '$partyID', '1', CURRENT_TIMESTAMP, 0);";
		mysql_query($enqueueQuery) or die(mysql_error());
		$insertVoteQuery = "INSERT INTO votes (ip, songID, isUpvote, party) VALUES ('$ip', '$songID', '1', '$partyID')";
    mysql_query($insertVoteQuery) or die(mysql_error());
		echo 'ADDED';
	} else {
		echo 'ALREADY_IN_PLAYLIST';
	}
} else {
	echo 'NO_PARTY';
}

?>
