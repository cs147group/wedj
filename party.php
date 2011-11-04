<!DOCTYPE html>
<?php 
	include("connect_db.php"); 
	include("information-gatherer.php");
	//include("set-song.php");
	include "links.php"; 
?>
<div data-role="header">
	<a data-icon="back" data-rel="dialog" href="confirm-leave.php">Leave Party</a>
	<h1>WeDJ</h1>
	<a data-icon="info" data-rel="dialog" href="info.php">Info</a> </div>
<div data-role="content">
        <?php
           $ip = $_SERVER['REMOTE_ADDR'];
	   $query = "SELECT party FROM users WHERE ip='$ip';";
	   $result = mysql_query($query) or die(mysql_error());
	   $row = mysql_fetch_array($result) or die(mysql_error());
	   $partyID = $row['party'];
	   $query2 = "SELECT * FROM parties WHERE id = $partyID";
	   $result2 = mysql_query($query2) or die (mysql_error());
	   $row2 = mysql_fetch_array($result2) or die(mysql_error());
	   $partyName = $row2['name'];
	   ?>

	<h2><?php print $partyName ?></h2>
	<a data-icon="plus" data-role="button" href="search.php">Add Songs</a>
	<h3>Now Playing:</h3>
	
	<?php if(!$isHost){?>
	<ul data-role="listview">
		<li>
			<h3><?php print $name ?></h3>
			<p><?php print $artist ?></p>
			<span class="ui-li-count">0</span> 
		</li>
	</ul>
	<?php }?>
	
	
	<?php 
		if($isHost){?>
		<div id="jquery_jplayer_1" class="jp-jplayer"></div>
  <div id="jp_container_1" class="jp-audio">
    <div class="jp-type-single">
      <div class="jp-gui jp-interface">
        <ul class="jp-controls">
          <li><a href="javascript:;" class="jp-play" tabindex="1">play</a></li>
          <li><a href="javascript:;" class="jp-pause" tabindex="1">pause</a></li>
          <li><a href="javascript:;" class="jp-stop" tabindex="1">stop</a></li>
          <li><a href="javascript:;" class="jp-mute" tabindex="1" title="mute">mute</a></li>
          <li><a href="javascript:;" class="jp-unmute" tabindex="1" title="unmute">unmute</a></li>
          <li><a href="javascript:;" class="jp-volume-max" tabindex="1" title="max volume">max volume</a></li>
        </ul>
        <div class="jp-progress">
          <div class="jp-seek-bar">
            <div class="jp-play-bar"></div>
          </div>
        </div>
        <div class="jp-volume-bar">
          <div class="jp-volume-bar-value"></div>
        </div>
        <div class="jp-time-holder">
          <div class="jp-current-time"></div>
          <div class="jp-duration"></div>
          <ul class="jp-toggles">
            <li><a href="javascript:;" class="jp-repeat" tabindex="1" title="repeat">repeat</a></li>
            <li><a href="javascript:;" class="jp-repeat-off" tabindex="1" title="repeat off">repeat off</a></li>
          </ul>
        </div>
      </div>
      <div class="jp-title">
        <ul>
          <li>Some Chords - Deadmau5</li>
        </ul>
      </div>
      <div class="jp-no-solution">
        <span>Update Required</span>
        To play the media you will need to either update your browser to a recent version or update your <a href="http://get.adobe.com/flashplayer/" target="_blank">Flash plugin</a>.
      </div>
    </div>
  </div>
	<?php }?>
	
	
	
	
	<br />
		<h3>Playlist</h3>
		<div id="songPlaylist">
		<ul data-role="listview" id="songList">
			<?php

			   $ip = $_SERVER['REMOTE_ADDR'];
			   $query = "SELECT party FROM users WHERE ip='$ip';";
			   $result = mysql_query($query) or die(mysql_error());
			   $row = mysql_fetch_array($result) or die(mysql_error());
			   $partyID = $row['party'];


				$playlistResult = mysql_query("SELECT * FROM playlist WHERE partyID = $partyID ORDER BY rating DESC");
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
			<div data-role="controlgroup" data-type="horizontal">
			<?php 
				echo '<a data-icon="arrow-u" data-iconpos="notext" data-role="button" href="#" class="like-button" id ="' . $currSongID . '"></a>';
				echo '<a data-icon="arrow-d" data-iconpos="notext" data-role="button" href="#" class="dislike-button" id ="' . $currSongID . '"></a>';
			?>
				</div>
			<?php
                }
    		?></li>
			<?php
				}
       ?>
		</ul>
		</div>
		      <script>
					$(window).ready(function(){
						$(".like-button").click( function(){
							$("#songList").load("updatePlaylist.php", {songID: this.id, isUp: 1}, function(){
								$("#songList").listview("refresh");
							});
						});
					});
						
				</script>
				<script>
					$(window).ready(function(){
						$(".dislike-button").click( function(){
							$("#songList").load("updatePlaylist.php", {songID: this.id, isUp: 0}, function(){
								$("#songList").listview("refresh");
							});
						});
					});
				</script>

</div>
<?php include "footer.php"; ?>
