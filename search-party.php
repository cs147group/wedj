<?php

include "connect_db.php";

$searchName = $_POST['name'];
$searchName = htmlspecialchars($searchName);
$searchName = substr($searchName, 0, 255);

$query =
	"SELECT * " .
	"FROM parties " .
	"WHERE name LIKE '%" .
	mysql_real_escape_string($searchName) .
	"%'";
$result = mysql_query($query) or die(mysql_error());
mysql_close();

$noResults = true;
while ($row = mysql_fetch_array($result)) {
	$noResults = false;
	echo '<li><a href="#" class="partyResult" partyid="'.$row['id'].'">'.$row['name'].'</a></li>';
}

if ($noResults) {
	echo '<p align="center">No parties were found.</p>';
}

?>
