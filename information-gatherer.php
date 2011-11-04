<?php
	$ipAddress = $_SERVER['REMOTE_ADDR'];
	$dbHost = "mysql.cs147.org";
    $dbUser = "jpulvera";
    $dbPass = "eymQqu6V";
    $dbDatabase = "jpulvera_mysql";
    $db = mysql_connect("$dbHost", "$dbUser", "$dbPass");
    $db_found = mysql_select_db("$dbDatabase", $db);
	$query = mysql_query("SELECT * FROM users", $db);
	if(!$query) die("WHAT THE OMG");
	$numRows = mysql_num_rows($query);
	$isHost = mysql_result($query, 0, "isAdmin");
	$songQuery = mysql_query("SELECT * FROM playlist", $db);
	$numRows = mysql_num_rows($songQuery);
	$greatest = -10000;
	$rating = 0; 
	$greatestID = 0;
	for($i = 0; $i < $numRows; $i++){
		$rating = mysql_result($songQuery, $i, "rating");
		if($rating > $greatest){
			$greatestID = mysql_result($songQuery, $i, "songID");
			$greatest = $rating;
		}
	}
	$songQueryNew = mysql_query("SELECT * FROM songs WHERE songID =" . $greatestID, $db);
	$name = mysql_result($songQueryNew, 0, "name");
	$artist = mysql_result($songQueryNew, 0, "artist");
	$songMP3 = mysql_result($songQueryNew, 0, "fileName");
	$songMP3 = "music/" . $songMP3;
?>