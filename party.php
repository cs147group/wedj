<!DOCTYPE html>
<?php 
	include("connect_db.php"); 
	include("information-gatherer.php");
	include("get_is_playing.php");
	//include("set-song.php");
?>
<html>
	<head>
		<?php include "links.php"; ?>
		<link type="text/css" href="skin/jplayer.blue.monday.css" rel="stylesheet" />
		<!--
		<link type="text/css" href="skin/tealplayer.css" rel="stylesheet" />
		-->
		<script type="text/javascript" src="js/jquery.jplayer.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js"></script>
		<script type="text/javascript" src="js/party.js"></script>
		<script type="text/javascript">
			$(window).ready(function(){
				isPaused = false;
<?php if ($isSongPlaying) { ?>
				waitingForTrack = false;
<?php } else { ?>
				waitingForTrack = true;
<?php } ?>
				// Reload current track
				setInterval(function(){
<?php if ($isHost) { ?>
					if (waitingForTrack && !isPaused) {
						playNextSong();
					}
				}, 1000);
<?php } else { ?>
					$("#nowPlaying").load("updateNowPlaying.php", function(){
						$("#nowPLaying").listview("refresh");
					});
				}, 5000);
<?php } ?>
			});
		</script>
	</head>
	<body>
		<div data-role="page" data-add-back-btn="true">
			<!--
			in order to have a stationary header on this party.php page, you have to put the header here after the data-role='page' and not in individual divs
			-->
			<!--
			<div data-role="header" data-position="fixed" data-theme="c">
				<h1>Hey</h1>
			</div>
			-->

<!-- Leave party dialog -->
			<div id="confirmDiv" style="height:0px;overflow:hidden">
				<div data-role="header" data-theme="c">
					<h1>Leave Party</h1>
				</div>
				<div data-role="content">
					<p align="center">Are you sure you want to leave the party?
	<?php if ($isHost) { ?>
					You will no longer be able to play music from this playlist.
	<?php } ?>
					</p>
					<a href="#" data-role="button" class="leaveConfirm" data-theme="d">Leave</a>
					<a href="#" data-role="button" class="leaveCancel">Stay</a>
				</div>
			</div>

<!-- Info dialog -->
			<div id="infoDiv" style="height:0px;overflow:hidden">
				<div data-role="header" data-theme="c">
					<a data-icon="arrow-l" href="#" id="closeInfo">Back</a>
					<h1>Information</h1>
				</div>
				<?php include "info-content.php" ?>
			</div>

<!-- Playlist section -->
			<div id="partyDiv" style="height:100%;overflow:hidden">
				<div data-role="header" data-theme="c">
					<a data-icon="back" href="#" id="leaveButton" data-theme="d"><?php
						if($isHost) echo "END PARTY";
						else echo "Leave Party";
					 ?></a>
				<h1>WeDJ</h1>
			<a data-icon="info" href="#" id="infoButton" data-theme="a">Help</a>
			</div>
			<div data-role="content">
<?php
	$ip = $_SERVER['REMOTE_ADDR'];
	$query = "SELECT party FROM users WHERE ip='$ip';";
	$result = mysql_query($query) or die (mysql_error());
	$row = mysql_fetch_array($result) or die(mysql_error());
	$partyID = $row['party'];
	$query2 = "SELECT * FROM parties WHERE id = $partyID";
	$result2 = mysql_query($query2) or die (mysql_error());
	$row2 = mysql_fetch_array($result2) or die(mysql_error());
	$partyName = $row2['name'];
?>
				<h2><?php echo $partyName; ?></h2>
				<a data-icon="plus" data-role="button" id="addButton">Add Songs</a>
				<h3>Now Playing:</h3>
<?php
	if (!$isHost) {
?>
<script>
var isHost = false;
</script>
				<ul data-role="listview" id="nowPlaying">
					<li>
						<h3><?php echo $name; ?></h3>
						<p><?php echo $artist; ?></p>
					</li>
				</ul>
<?php
	}
?>
	
	
<?php 
	if ($isHost) {
?>
<script>
var isHost = true;
</script>
<div id="JPLAYA">
<script type="text/javascript">
$(document).ready(function(){
	$("#jquery_jplayer_1").jPlayer({
		ready: function () {
			$(this).jPlayer("setMedia", {
				mp3: <?php print '"' . $songURL . '"'; ?>
			})
		.jPlayer("play");
		},
		swfPath: "/js",
		supplied: "mp3"
	});
}); 
<?php
  	print "var partyIDNum = ". $partyID . ";";
?>
		</script>
	<div id="jquery_jplayer_1" class="jp-jplayer"></div>
  <div id="jp_container_1" class="jp-audio">
    <div class="jp-type-single">
      <div class="jp-gui jp-interface">
        <ul class="jp-controls">
          <li><a href="javascript:;" class="jp-play" tabindex="1">play</a></li>
          <li><a href="javascript:;" class="jp-pause" tabindex="1">pause</a></li>
          <li><a href="#" class="jp-next" id="next_button">next</a></li>
        </ul>
        <div class="jp-progress">
          <div class="jp-seek-bar">
            <div class="jp-play-bar"></div>
          </div>
        </div>
          <div class="jp-time-holder">
          <div class="jp-current-time"></div>
          <div class="jp-duration"></div>
          <ul class="jp-toggles">
          </ul>
        </div>
      </div>
      <div class="jp-title">
        <ul>
          <li id="jplayer_title"><?php echo $name . " - " . $artist; ?></li>
        </ul>
      </div>
      <div class="jp-no-solution">
        <span>Update Required</span>
        To play the media you will need to either update your browser to a recent version or update your <a href="http://get.adobe.com/flashplayer/" target="_blank">Flash plugin</a>.
      </div>
    </div>
  </div>
  </div>
<?php
	}
?>
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
	$playlistResult = mysql_query("SELECT * FROM playlist WHERE partyID = $partyID ORDER BY isPlaying DESC, rating DESC, time");
	$isFirst = 1;
	while ($row = mysql_fetch_array($playlistResult)) {
		if($isFirst ==0){ 
		$currSongID = $row["songID"];
		$currRating = $row["rating"];
		$alreadyVotedQuery = "SELECT * FROM votes WHERE ip = '$ip' AND songID = $currSongID";
		$votedResult = mysql_query($alreadyVotedQuery) or die(mysql_error());
		$disableUp = 'ui-btn-up-c';
		$disableDown = 'ui-btn-up-c';
		if ($row = mysql_fetch_array($votedResult)) {
			if ($row['isUpvote']) {
				$disableUp = 'ui-btn-down-c';
			} else {
				$disableDown = 'ui-btn-down-c';
			}
		}
	$songsResult =mysql_query("SELECT * FROM songs WHERE songID = $currSongID");
		if ($row = mysql_fetch_array($songsResult)) {
?>
				<li>
					<h3><?php echo $row["name"]; ?></h3>
					<p><?php echo $row["artist"]; ?></p>
					<span class="ui-li-count"><?php echo $currRating; ?></span>
					<div data-role="controlgroup" data-type="horizontal">
<?php 
	echo '<a data-icon="arrow-u" data-iconpos="notext" data-role="button" href="#" class="like-button '.$disableUp.'" id ="' . $currSongID . '"></a>';
	echo '<a data-icon="arrow-d" data-iconpos="notext" data-role="button" href="#" class="dislike-button '.$disableDown.'" id ="' . $currSongID . '"></a>';
?>
					</div>
				</li>
<?php
		}
	}	
$isFirst = 0;
	}
	if($isFirst) echo '<p align="center">There are no songs in the playlist. You should add one!</p>';
?>
			</ul>
		</div>
	</div>
</div>

<!-- Search section -->
	<div id="searchDiv" style="height:0px;overflow:hidden">
		<div data-role="header" data-theme="c">
			<a data-icon="arrow-l" href="#" class="searchBack">Done</a>
			<h1>WeDJ</h1>
		</div>
		<div data-role="content">
				<h3>Search for songs</h3>
				<label for="search">Enter a song title or artist name:</label>
				<input type="search" id="search" value="" />
				<a href="#" data-role="button" id="searchButton">Search</a>
				<div data-role="controlgroup" id="searchResults">
				</div>
				<h3>Browse songs by genre</h3>
				<div data-role="collapsible-set">
					<?php
						$genres = array("Top 40" => "top40", "Alternative" => "alternative", "Country" => "country");
						foreach ($genres as $genreName => $genreIndex) {
					?>
					<div data-role="collapsible">
						<h3><?php echo $genreName; ?></h3>
						<div data-role="controlgroup">
							<?php
							   $genreResult = mysql_query("SELECT * FROM songs WHERE genre = '$genreIndex' ORDER BY name");
							   while ($row = mysql_fetch_array($genreResult)) {
									$songTitle = $row["name"];
							  	$artist = $row["artist"];
									$songID = $row["songID"];
									$isInPlaylistQuery = "SELECT * FROM playlist WHERE songID = '$songID' AND partyID = '$partyID'";
									$isInPlaylistResult = mysql_query($isInPlaylistQuery);
									//this isInPlaylist & if/else statement are to gray out songs in the playlist from the search results
									if(mysql_num_rows($isInPlaylistResult) == 0) {
							?>
										<a href="#" data-role="button" data-icon="plus" data-iconpos="right" class="addSong" id="<?php echo $songID; ?>">
							<?php	} else { ?>
										<a href = "#" data-role = "button" data-icon="check" data-iconpos="right" class="addSong ui-disabled" id="<?php echo $songID;?>">
							<?php		} ?>
											<h3 class="ui-li-heading"><?php echo $songTitle; ?></h3>
											<p class="ui-li-desc"><?php echo $artist; ?></p>
										</a>
							<?php
								}
							?>
						</div>
					</div>
					<?php
						}
					?>
				</div>
				<div id="none" style="display:none"></div>
				<a href="#" data-role="button" class="searchBack">Finished Adding</a>
			</div>
		</div>
	</div>
	</body>
</html>
