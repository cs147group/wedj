<?php
	include("connect_db.php");
	$id = $_POST["songID"];
	$isUp = $_POST["isUp"];
	if($isUp == 1) $result = mysql_query("UPDATE playlist SET rating = rating + 1 WHERE songID = $id");
	else $result = mysql_query("UPDATE playlist SET rating = rating - 1 WHERE songID = $id");
?>

	<?php
				$playlistResult = mysql_query("SELECT * FROM playlist ORDER BY rating DESC");
 				while ($row = mysql_fetch_array($playlistResult) ){
			?>
			<li><?php $currSongID = $row["songID"];
            $currRating = $row["rating"];
			$songsResult =mysql_query("SELECT * FROM songs WHERE songID = $currSongID");
			while ($row = mysql_fetch_array($songsResult)){

			?>
			<div>
				<?php
					$song = $currSongID;
 ?>
			</div>
			<h3><?php echo $row["name"];?></h3>
			<p><?php echo $row["artist"];?></p>
			<span class="ui-li-count"><?php echo $currRating;  ?></span>
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
			<?php
                }
    		?></li>
			<?php
				}
       ?>



