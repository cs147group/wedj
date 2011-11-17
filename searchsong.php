<?php

include "connect_db.php";

$searchText = $_POST["searchText"];
if (!$searchText) exit(0);
$rows = array();
$songIDs = array();
$query = "SELECT * FROM songs WHERE name LIKE '%" . $searchText . "%';";
$result = mysql_query($query) or die(mysql_error());
while ($row = mysql_fetch_array($result)) {
	$songIDs[] = $row["songID"];
	$rows[] = $row;
}
$query = "SELECT * FROM songs WHERE artist LIKE '%" . $searchText . "%';";
$result = mysql_query($query) or die(mysql_error());
while ($row = mysql_fetch_array($result)) {
	if (!in_array($row["songID"], $songIDs)) {
		$rows[] = $row;
	}
}
$lastIndex = count($rows) - 1;
foreach ($rows as $index => $row) {
	$class_extras = "";
	if ($index == 0) {
		$class_extras = " ui-corner-top";
	}
	if ($index == $lastIndex) {
		$class_extras = $class_extras . " ui-corner-bottom ui-controlgroup-last";
	}
	
	//need party ID to check playlist
	$ip = $_SERVER['REMOTE_ADDR'];
	$queryUser = "SELECT party FROM users WHERE ip='$ip';";
	$resultUser = mysql_query($queryUser) or die(mysql_error());
	$rowUser = mysql_fetch_array($resultUser) or die(mysql_error());
	$partyID = $rowUser['party'];
	$songID = $row['songID'];
	$isInPlaylistQuery = "SELECT * FROM playlist WHERE songID = '$songID' AND partyID = '$partyID'";
	$isInPlaylistResult = mysql_query($isInPlaylistQuery);
	$disabled_class = "";
	$icon = "plus";
	if(mysql_num_rows($isInPlaylistResult) != 0) { //already in playlist; need to gray out the result
		$disabled_class = " ui-disabled";
		$icon = "check";
	}
	
	echo
		'<a href="#" data-role="button" data-icon="' . $icon . '" data-iconpos="right" class="addSong ui-btn ui-btn-icon-right ui-btn-up-c' . $class_extras . $disabled_class . '" id="' . $row['songID'] . '" data-theme="c">' .
			'<span class="ui-btn-inner' . $class_extras . '" aria-hidden="true">' .
				'<span class="ui-btn-text">' . 
					'<h3 class="ui-li-heading">' . $row['name'] . '</h3>' . 
					'<p class="ui-li-desc">' . $row['artist'] . '</p>' .
				'</span>' .
				'<span class="ui-icon ui-icon-' . $icon . ' ui-icon-shadow"></span>' .
			'</span>' .
		'</a>';
}

?>
