<?php
	$topSongResult = mysql_query("SELECT * FROM playlist ORDER BY rating DESC", $db);
	$topSongID = mysql_result($topSongResult, 0, "songID");
	$songQueryNew = mysql_query("SELECT * FROM songs WHERE songID =" . $topSongID, $db);
	$songMP3 = mysql_result($songQueryNew, 0, "fileName");
	print $songMP3;

?>
