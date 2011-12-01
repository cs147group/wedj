<?php
	include("connect_db.php");
	include("information-gatherer.php");
	if ($isHost) {
		$nextSongQuery =
			"SELECT * FROM playlist " .
			"WHERE partyID=" . $partyID .
			" AND isPlaying = 0" .
			" ORDER BY rating DESC";
		$nextSongResult = mysql_query($nextSongQuery) or die(mysql_error());
		if ($row = mysql_fetch_array($nextSongResult)) {
			$nextSongID = $row["songID"];
			mysql_query("DELETE FROM playlist WHERE partyID = '$partyID' AND isPlaying = 1");
			mysql_query("UPDATE playlist SET isPlaying = 1 WHERE partyID = '$partyID' AND songID = '$nextSongID'");
			$songQueryNew = mysql_query("SELECT * FROM songs WHERE songID =" . $nextSongID);
			$artistName = mysql_result($songQueryNew, 0, "artist");
			$songName = mysql_result($songQueryNew, 0, "name");
			$songMP3 = mysql_result($songQueryNew, 0, "fileName");
			print $artistName . " - " . $songName . "\n";
			print "http://jpulvera.cs147.org/music/" . $songMP3;
		} else {
			print "NO_MORE_SONGS";
		}
	} else {
		print "NOT_HOST";
	}
?>
