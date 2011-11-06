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
	echo
		'<a href="#" data-role="button" data-icon="plus" data-iconpos="right" class="addSong ui-btn ui-btn-icon-right ui-btn-down-c ui-btn-up-c' . $class_extras . '" id="' . $row['songID'] . '" data-theme="c">' .
			'<span class="ui-btn-inner' . $class_extras . '" aria-hidden="true">' .
				'<span class="ui-btn-text">' . 
					'<h3 class="ui-li-heading">' . $row['name'] . '</h3>' . 
					'<p class="ui-li-desc">' . $row['artist'] . '</p>' .
				'</span>' .
				'<span class="ui-icon ui-icon-plus ui-icon-shadow"></span>' .
			'</span>' .
		'</a>';
}

?>
