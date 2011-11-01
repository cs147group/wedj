<?php
include("connect_db.php");

$songTitle = $_GET["songtitle"];
$songID = 2;
$partyID = 1;
$rating = 1;
$time = time();


$result = mysql_query("INSERT INTO playlist (songID, partyID, rating, time) VALUES ('".$songID."', ".$partyID.", ".$rating.", ".$time.")");
if ($result) echo "successfully able to insert new song into playlist!";
?>