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

// Switch screens (playlist, search, info, exit)
function changeScreen(fromDiv, toDiv) {
	$("#" + fromDiv + "Div").height('0px');
	$("#" + toDiv + "Div").height('100%');
}

// Track state history of screens
function updateState(fromDiv, toDiv) {
	history.replaceState({fromPage: fromDiv, toPage: toDiv}, fromDiv + " to " + toDiv);
	history.pushState({placeholder: true}, "placeholder");
}

// Handle back buttons
window.onpopstate = function(event) {
	if (!event.state) return;
	if (!event.state.placeholder) {
		changeScreen(event.state.toPage, event.state.fromPage);
	}
};

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
		changeScreen("party", "search");
		updateState("party", "search");
	});
	$(".searchBack").click( function(){
		history.back();
	});
	$("#leaveButton").click( function(){
		changeScreen("party", "confirm");
		updateState("party", "confirm");
	});
	$(".leaveCancel").click( function(){
		history.back();
	});
	$("#infoButton").click( function(){
		changeScreen("party", "info");
		updateState("party", "info");
	});
	$("#closeInfo").click( function(){
		history.back();
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

