<?php

$minLat = $_POST['lat'] - .015;
$maxLat = $_POST['lat'] + .015;
$minLon = $_POST['lon'] - .02;
$maxLon = $_POST['lon'] + .02;

mysql_connect("mysql.cs147.org","jpulvera","eymQqu6V") or die(mysql_error());
mysql_select_db("jpulvera_mysql") or die(mysql_error());
$query =
	"SELECT * ".
	"FROM parties ".
	"WHERE lat BETWEEN ".$minLat." AND ".$maxLat.
	" AND lon BETWEEN ".$minLon." AND ".$maxLon;
$result = mysql_query($query) or die(mysql_error());
mysql_close();

while ($row = mysql_fetch_array($result)) {
	echo '<li><a href="party.php?id='.$row['id'].'">'.$row['name'].'</a></li>';
}

?>
