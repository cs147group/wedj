<?php
	$ipAddress = $_SERVER['REMOTE_ADDR'];

	$userQuery = "SELECT * FROM users WHERE ip='$ipAddress'";
	$userResult = mysql_query($userQuery) or die(mysql_error());
	$isHost = mysql_result($userResult, 0, "isAdmin");
	$partyID = mysql_result($userResult, 0, "party");

	$playlistQuery =
		"SELECT * FROM playlist " .
		"WHERE partyID=" . $partyID .
		" ORDER BY rating DESC";
	$playlistResult = mysql_query($playlistQuery) or die(mysql_error());
	if ($row = mysql_fetch_array($playlistResult)) {
		// Non-empty playlist
		$highestRatedSongID = $row["songID"];
		$songQuery = "SELECT * FROM songs WHERE songID =" . $highestRatedSongID;
		$songResult = mysql_query($songQuery) or die(mysql_error());
		$name = mysql_result($songResult, 0, "name");
		$artist = mysql_result($songResult, 0, "artist");
		$songFile = mysql_result($songResult, 0, "fileName");
		$songURL = "http://jpulvera.cs147.org/music/" . $songFile;
	} else {
		// Playlist is empty
	}
?>
