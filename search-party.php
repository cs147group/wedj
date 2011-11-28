<?php
	include "connect_db.php";
	include("strip-special.php");
	$searchName = $_POST['name'];
	$searchName = htmlspecialchars($searchName);
	$searchName = substr($searchName, 0, 255);
	$searchName = stripSpecial($searchName);
	$query = "SELECT * FROM parties";
	$result = mysql_query($query) or die(mysql_error());
	mysql_close();
	$noResults = true;
	$count = 0;
	while($row = mysql_fetch_array($result)){
		$sqlParty = stripSpecial($row['name']); //Is name correct?
		if(strstr($sqlParty, $searchName) !== false){
			$count++;
			echo '<li><a href="#" class="partyResult" partyid="'.$row['id'].'">'.$row['name'].'</a></li>';
		}
	}
	if($count == 0) echo '<p align="center">No parties were found.</p>';
/*while ($row = mysql_fetch_array($result)) {
	$noResults = false;
	echo '<li><a href="#" class="partyResult" partyid="'.$row['id'].'">'.$row['name'].'</a></li>';
}

if ($noResults) {
	echo '<p align="center">No parties were found.</p>';
}*/

?>
