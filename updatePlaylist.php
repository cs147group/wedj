<?php
include("connect_db.php");


$thing = $_POST["bsubmit"];
$beginning = substr($thing, 0, 4);
if ($beginning == "down"){
   echo "Downvoting song # ".substr($thing,10)." by 1 vote";
  $song = substr($thing,10);
  $result = mysql_query("UPDATE playlist SET rating = rating - 1 WHERE songID = $song");

} else {
  echo "Incrementing song # ".$thing."by 1 vote";
  $result = mysql_query("UPDATE playlist SET rating = rating + 1 WHERE songID = $thing");

}


if ($result) {
   "successfully able to update your vote!";
} else {
  echo "couldn't update likes in the playlist table. bummer.";
}
?>
