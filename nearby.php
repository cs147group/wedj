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

$noPartiesNearby = true;
while ($row = mysql_fetch_array($result)) {
	$noPartiesNearby = false;
	echo '<li><a href="party.php" class="nearbyParty">'.$row['name'].'</a></li>';
}

if ($noPartiesNearby) {
	echo '<p align="center">No parties were found nearby.</p>';
}

?>
