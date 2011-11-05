<?php
	include("connect_db.php");
	$id = $_POST["songID"];
	$isUp = $_POST["isUp"];
	if($isUp == 1) $result = mysql_query("UPDATE playlist SET rating = rating + 1 WHERE songID = $id");
	else $result = mysql_query("UPDATE playlist SET rating = rating - 1 WHERE songID = $id");
	
	$ip = $_SERVER['REMOTE_ADDR'];
	$query = "SELECT party FROM users WHERE ip='$ip';";
	$result = mysql_query($query) or die(mysql_error());
  if ($row = mysql_fetch_array($result)) {
		$partyID = $row['party'];
		$playlistResult = mysql_query("SELECT * FROM playlist WHERE partyID = $partyID ORDER BY rating DESC");
		// Loop through all songs in playlist
 		while ($row = mysql_fetch_array($playlistResult)) {
			$currSongID = $row["songID"];
      $currRating = $row["rating"];
			$songResult =mysql_query("SELECT * FROM songs WHERE songID = $currSongID");
			if ($row = mysql_fetch_array($songResult)) {
?>
<li>
	<h3><?php echo $row["name"]; ?></h3>
	<p><?php echo $row["artist"]; ?></p>
	<span class="ui-li-count"><?php echo $currRating; ?></span>
	<div data-role="controlgroup" data-type="horizontal" class="ui-corner-all ui-controlgroup ui-controlgroup-horizontal">
  	<a data-icon="arrow-u" data-iconpos="notext" data-role="button" href="#" class="like-button ui-btn ui-btn-icon-notext ui-corner-left ui-btn-up-c" id="<?php echo $currSongID; ?>" title="" data-theme="c">
    	<span class="ui-btn-inner ui-corner-left" aria-hidden="true">
      	<span class="ui-btn-text"></span>
      	<span class="ui-icon ui-icon-arrow-u ui-icon-shadow"></span>
    	</span>
  	</a>
  	<a data-icon="arrow-d" data-iconpos="notext" data-role="button" href="#" class="dislike-button ui-btn ui-btn-icon-notext ui-corner-right ui-controlgroup-last ui-btn-up-c" id="<?php echo $currSongID; ?>" title="" data-theme="c">
    	<span class="ui-btn-inner ui-corner-right ui-controlgroup-last" aria-hidden="true">
      	<span class="ui-btn-text"></span>
      	<span class="ui-icon ui-icon-arrow-d ui-icon-shadow"></span>
    	</span>
  	</a>
	</div>
</li>
<?php
      }
		}
	}
?>



