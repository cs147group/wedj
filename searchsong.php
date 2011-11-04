<?php

include "connect_db.php";

$songName = $_POST["songName"];
$query = "SELECT * FROM songs WHERE name LIKE '%" . $songName . "%';";
$result = mysql_query($query) or die(mysql_error());

while ($row = mysql_fetch_array($result)) {
	echo '<li><a href="#" class="addSong" id="' . $row['songID'] . '"><h3>' . $row['name'] . '</h3><p>' . $row['artist'] . '</p></a><a href="#" class="addSong" id="' . $row['songID'] . '"></a></li>';
}

?>