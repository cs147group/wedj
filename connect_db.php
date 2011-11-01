<?php
	$conn = mysql_connect("mysql.cs147.org", "jpulvera", "eymQq6V");
	if (!$conn){
	   echo("could not connect:(");
	}
	if(!mysql_select_db("jpulvera_mysql"){
		echo("could not find database");
	}	

?>