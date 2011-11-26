<?php

include "connect_db.php";

$minLat = $_POST['lat'] - .015;
$maxLat = $_POST['lat'] + .015;
$minLon = $_POST['lon'] - .02;
$maxLon = $_POST['lon'] + .02;
$clickedTimes = $_POST['clickedTimes'];
$clickedTimes = $clickedTimes % 2;
if($clickedTimes){
$query =
	"SELECT * ".
	"FROM parties ".
	"WHERE lat BETWEEN ".$minLat." AND ".$maxLat.
	" AND lon BETWEEN ".$minLon." AND ".$maxLon. "ORDER BY name";
$result = mysql_query($query) or die(mysql_error());
mysql_close();

$noPartiesNearby = true;
while ($row = mysql_fetch_array($result)) {
	$noPartiesNearby = false;
	echo '<li><a href="#" class="nearbyParty" partyid="'.$row['id'].'">'.$row['name'].'</a></li>';
}

if ($noPartiesNearby) {
	echo '<p align="center">No parties were found nearby. Join a party by entering its name below.</p>';
}
}

?>
