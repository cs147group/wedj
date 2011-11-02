
<?php
include("connect_db.php");

$songID = $_POST["song"];
$partyID = $_POST["party"];
$rating = $_POST["rating"];
$time = time();


$result = mysql_query("INSERT INTO playlist (songID, partyID, rating, time) VALUES ('".$songID."', ".$partyID.", ".$rating.", ".$time.")");
if ($result) echo "successfully able to insert new song into playlist!";

?>