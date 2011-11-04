<?php
include("connect_db.php");

$songID = $_POST["song"];
$partyID = $_POST["party"];
$rating = 1;
$time = time();


echo "song id is $songID";

$result = mysql_query("INSERT INTO playlist(songID, partyID, rating, time) VALUES ($songID,$partyID,$rating,$\
time)");

if ($result) {
echo "successfully able to insert new song into playlist table!";
} else {
  echo "couldn't add song into playlist table. bummer.";
}
?>
