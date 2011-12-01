<?php 
$npplaylistQuery = "SELECT * FROM playlist WHERE partyID=" . $partyID . " AND isPlaying = '1' ORDER BY rating DESC";
$npplaylistResult = mysql_query($npplaylistQuery) or die(mysql_error());
if ($row = mysql_fetch_array($npplaylistResult)) {
		// A song is currently playing
		$isSongPlaying = true;
		$highestRatedSongID = $row["songID"];
		$songQuery = "SELECT * FROM songs WHERE songID =" . $highestRatedSongID;
		$songResult = mysql_query($songQuery) or die(mysql_error());
		$name = mysql_result($songResult, 0, "name");
		$artist = mysql_result($songResult, 0, "artist");
		$songFile = mysql_result($songResult, 0, "fileName");
		$songURL = "http://jpulvera.cs147.org/music/" . $songFile;
	} else {
		// No song is playing
		$isSongPlaying = false;
	}

?>
