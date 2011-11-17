<?php 
	include("connect_db.php");
	if($_POST["hasEnded"]){
		$dropPartyID = $_POST["partyIDNum1"];
		mysql_query("DELETE FROM playlist WHERE partyID = '$dropPartyID' AND isPlaying = 1");
	}
	include("information-gatherer.php");
	mysql_query("UPDATE playlist SET isPlaying = 1 WHERE partyID = '$dropPartyID' AND songID = '$highestRatedSongID'");
	include("get_is_playing.php");
	if ($isHost) {
?>
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
          <li><?php echo $name . " - " . $artist; ?></li>
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
