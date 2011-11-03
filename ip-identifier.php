<?php
	$ipAddress = $_SERVER['REMOTE_ADDR'];
	print $ipAddress;
	$dbHost = "mysql.cs147.org";
        $dbUser = "jpulvera";
        $dbPass = "eymQqu6V";
        $dbDatabase = "jpulvera_mysql";
        $db = mysql_connect($dbHost, $dbUser, $dbpass) or die (
"Error connecting to database :(");
        $db_found = mysql_select_db("$dbDatabase", $db) or die ("Couldn't selec\
t the database");
		$query = mysql_query("SELECT * FROM users WHERE ip=" . $ipAddress . ";", $db);
		$numRows = mysql_numrows($query);
		$isHost = mysql_result($query, 0, "isHost");
		if($isHost) print "YAY";
		if(!$isHost) print "NO HOST";
		
	
?>