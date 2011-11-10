function registerVoteClickHandlers() {
	$(".like-button").click( function(){
		$("#songList").load("updatePlaylist.php", {songID: this.id, isUp: 1}, function(){
			$("#songList").listview("refresh");
			registerVoteClickHandlers();
		});
	});
	$(".dislike-button").click( function(){
		$("#songList").load("updatePlaylist.php", {songID: this.id, isUp: 0}, function(){
			$("#songList").listview("refresh");
			registerVoteClickHandlers();
		});
	});
}

$(window).ready(function(){
	registerVoteClickHandlers();
	$("#addButton").click( function(){
		$("#partyDiv").height('0px');
		$("#searchDiv").height('100%');
	});
	$("#searchBack").click( function(){
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
	$("#leaveConfirm").click(function(){
		window.location = "index.php";
	});
	$("#searchButton").click(function(){
		$("#searchResults").load("searchsong.php", {searchText: $("#search").val()});
	});
				$("#search").keyup(function(event){           
					 if(event.keyCode == 13) {
							 $("#searchResults").load("searchsong.php", {searchText: $("#search").val()});
					 }
				});

	$(".addSong").live("click", function(){
		var button = this;
		$("#none").load("addSong.php", {songID: button.id}, function(){
			// can't add again
			$(button).unbind("click");
			// change to check button
			$(button).find(".ui-icon").removeClass("ui-icon-plus");
			$(button).find(".ui-icon").addClass("ui-icon-check");
			// disable button
			$(button).addClass("ui-disabled");
		});
	});
});

