<?php
	include("connect_db.php");
	include("information-gatherer.php");
	$id = $_POST["songID"];
	$isUp = $_POST["isUp"];
	$ip = $_SERVER['REMOTE_ADDR'];
	
	$query = "SELECT party FROM users WHERE ip='$ip';";
	$result = mysql_query($query) or die(mysql_error());
    $row = mysql_fetch_array($result);
	$partyID = $row['party'];


		if ($id != null) {
        $alreadyVotedQuery = "SELECT * FROM votes WHERE ip = '$ip' AND songID = $id AND party = $partyID";
        $votedResult = mysql_query($alreadyVotedQuery) or die(mysql_error());

        $numVoteResults = mysql_num_rows($votedResult);
        if ($numVoteResults == 0){      //if they've never voted on this song before, they can vote either way
           if($isUp == 1) {
	   	    $result = mysql_query("UPDATE playlist SET rating = rating + 1 WHERE songID = $id AND partyID = '$partyID'");
         	    	    $insertVoteQuery = "INSERT INTO votes (ip, songID, isUpvote, party) VALUES ('$ip', '$id', '1', '$partyID')";
         		    		     mysql_query($insertVoteQuery) or die(mysql_error());
					     } else {
					       $result = mysql_query("UPDATE playlist SET rating = rating - 1 WHERE songID = $id AND partyID = '$partyID'");
         				       	       $insertVoteQuery = "INSERT INTO votes (ip, songID, isUpvote, party) VALUES ('$ip', '$id', '0', '$partyID')";
         					       			mysql_query($insertVoteQuery) or die(mysql_error());
									}
        } else {                         //if they've already voted once

          $voteRow = mysql_fetch_array($votedResult) or die(mysql_error());
          $prevVote = $voteRow['isUpvote'];
          if($isUp == 0){
              if($prevVote == 1){ //They already upvoted once but are now changing to a downvote

                      $result = mysql_query("UPDATE playlist SET rating = rating - 2 WHERE songID = $id AND partyID = '$partyID'");
                      $updateVoteQuery = "UPDATE votes SET isUpvote = '0' WHERE ip = '$ip' AND songID = '$id' AND isUpvote = '1' AND party = '$partyID' LIMIT 1";
                      mysql_query($updateVoteQuery) or die(mysql_error());
              } else { //they already downvoted and are changing back to neutral
              	      $result = mysql_query("UPDATE playlist SET rating = rating + 1 WHERE songID = $id AND partyID = '$partyID'");
                      $updateVoteQuery = "DELETE FROM votes WHERE ip = '$ip' AND songID = '$id' AND party = '$partyID' LIMIT 1";
                      mysql_query($updateVoteQuery) or die(mysql_error());
              }
          } else {
          		if ($prevVote == 0) { //They already upvoted but are changing to an upvote
                 	$result = mysql_query("UPDATE playlist SET rating = rating + 2 WHERE songID = $id AND partyID = '$partyID'");
                 	$updateVoteQuery = "UPDATE votes SET isUpvote = '1' WHERE ip = '$ip' AND songID = '$id' AND isUpvote = '0' AND party = '$partyID' LIMIT 1";
                 	mysql_query($updateVoteQuery) or die(mysql_error());
                } else { //they already downvoted and are changing back to neutral
              	      $result = mysql_query("UPDATE playlist SET rating = rating - 1 WHERE songID = $id AND partyID = '$partyID'");
                      $updateVoteQuery = "DELETE FROM votes WHERE ip = '$ip' AND songID = '$id' AND party = '$partyID' LIMIT 1";
                      mysql_query($updateVoteQuery) or die(mysql_error());                	
                }   
          } 

        }
			}



	$query = "SELECT party FROM users WHERE ip='$ip';";
	$result = mysql_query($query) or die(mysql_error());
  if ($row = mysql_fetch_array($result)) {
		$partyID = $row['party'];
		$playlistResult = mysql_query("SELECT * FROM playlist WHERE partyID = $partyID ORDER BY isPlaying DESC, rating DESC, time");
		// Loop through all songs in playlist
		$isFirst = 1;
 		while ($row = mysql_fetch_array($playlistResult)) {
 		if($isFirst ==0){ 
			$currSongID = $row["songID"];
      $currRating = $row["rating"];
			$alreadyVotedQuery = "SELECT * FROM votes WHERE ip = '$ip' AND songID = $currSongID AND party = '$partyID'";
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
			$songResult =mysql_query("SELECT * FROM songs WHERE songID = $currSongID");
			if ($row = mysql_fetch_array($songResult)) {
?>
<li>
	<h3><?php echo $row["name"]; ?></h3>
	<p><?php echo $row["artist"]; ?></p>
	<span class="ui-li-count"><?php echo $currRating; ?></span>
	<div data-role="controlgroup" data-type="horizontal" class="ui-corner-all ui-controlgroup ui-controlgroup-horizontal">
  	<a data-icon="arrow-u" data-iconpos="notext" data-role="button" href="#" class="like-button ui-btn ui-btn-icon-notext ui-corner-left <?php echo $disableUp; ?>" id="<?php echo $currSongID; ?>" title="" data-theme="c">
    	<span class="ui-btn-inner ui-corner-left" aria-hidden="true">
      	<span class="ui-btn-text"></span>
      	<span class="ui-icon ui-icon-arrow-u ui-icon-shadow"></span>
    	</span>
  	</a>
  	<a data-icon="arrow-d" data-iconpos="notext" data-role="button" href="#" class="dislike-button ui-btn ui-btn-icon-notext ui-corner-right ui-controlgroup-last <?php echo $disableDown; ?>" id="<?php echo $currSongID; ?>" title="" data-theme="c">
    	<span class="ui-btn-inner ui-corner-right ui-controlgroup-last" aria-hidden="true">
      	<span class="ui-btn-text"></span>
      	<span class="ui-icon ui-icon-arrow-d ui-icon-shadow" ></span>
    	</span>
  	</a>
	</div>
</li>
<?php
      }
     		}	
$isFirst = 0;
	}
	}
	$newResult = mysql_query("SELECT * FROM playlist WHERE partyID = $partyID");
	$numRows = mysql_num_rows($newResult);
	if($numRows ==1) echo '<p align="center">The songs in this playlist will run out soon. You should add one!</p>';
	if($isFirst) echo '<p align="center">There are no songs in the playlist. You should add one!</p>';
?>
