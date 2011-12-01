function updatePlaylist() {
	$("#songList").load("updatePlaylist.php", function(){
		$("#songList").listview("refresh");
	});
}

function playNextSong() {
	$.ajax({
		url: "next-song.php",
		success: function(data, ignored, ignored2){
			var songInfo = data.split('\n');
			if (songInfo[0] == "NOT_HOST") {
				// do nothing
			}
			if (songInfo[0] == "NO_MORE_SONGS") {
				waitingForTrack = true;
			} else {
				waitingForTrack = false;
				$("#jplayer_title").html(songInfo[0]);
				$("#jquery_jplayer_1").jPlayer("setMedia", {mp3: songInfo[1]});
			}
			$("#jquery_jplayer_1").jPlayer("play");
		}
	});
	updatePlaylist();
}

$(window).ready(function(){
	// When songs end, automatically advance track
	$("#jquery_jplayer_1").bind($.jPlayer.event.ended, playNextSong);
  
	// Next button click handler
	$("#next_button").click(playNextSong);

	// Play button click handler
	$("#jquery_jplayer_1").bind($.jPlayer.event.play, function(e){
		isPaused = false;
	});

	// Pause button click handler
	$("#jquery_jplayer_1").bind($.jPlayer.event.pause, function(e){
		isPaused = true;
	});

	// Automatically refresh playlist
	setInterval(function(){
		updatePlaylist();
	}, 5000);

	// Voting click handlers
	$(".like-button").live("click", function(){
		$("#songList").load("updatePlaylist.php", {songID: this.id, isUp: 1}, function(){
			$("#songList").listview("refresh");
		});
	});
	$(".dislike-button").live("click", function(){
		$("#songList").load("updatePlaylist.php", {songID: this.id, isUp: 0}, function(){
			$("#songList").listview("refresh");
		});
	});

	// Navigation button handlers
	$("#addButton").click( function(){
		$("#partyDiv").height('0px');
		$("#searchDiv").height('100%');
	});
	$(".searchBack").click( function(){
		$("#partyDiv").height('100%');
		$("#searchDiv").height('0px');
	});
	$("#leaveButton").click( function(){
		$("#partyDiv").height('0px');
		$("#confirmDiv").height('100%');
	});
	$(".leaveCancel").click( function(){
		$("#partyDiv").height('100%');
		$("#confirmDiv").height('0px');
	});
	$("#infoButton").click( function(){
		$("#partyDiv").height('0px');
		$("#infoDiv").height('100%');
	});
	$("#closeInfo").click( function(){
		$("#partyDiv").height('100%');
		$("#infoDiv").height('0px');
	});
	$(".leaveConfirm").click(function(){
		window.location = "index.php";
	});

	// Search button click handler
	$("#searchButton").click(function(){
		$("#searchResults").load("searchsong.php", {searchText: $("#search").val()});
	});

	// Search box "enter" key handler
				$("#search").keyup(function(event){           
					 if(event.keyCode == 13) {
							 $("#searchResults").load("searchsong.php", {searchText: $("#search").val()});
					 }
				});

	// Add song click handler
	$(".addSong").live("click", function(){
		var button = this;
		$.ajax({
			url: "addSong.php",
			data: {songID: button.id},
			type: "POST",
			success: function(data, ignored, ignored2){
				// can't add again
				$(button).unbind("click");
				// change to check button
				$(button).find(".ui-icon").removeClass("ui-icon-plus");
				$(button).find(".ui-icon").addClass("ui-icon-check");
				// disable button
				$(button).addClass("ui-disabled");
				// refresh playlist if was added
				var timesClicked = 0;
				if (data == "ADDED") {
					updatePlaylist();
				}
			}
		});
	});
});

