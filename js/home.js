function browse_geolocate() {
	$("#browseNearby").html("Loading nearby parties...");
	$("#browseNearby").buttonMarkup({ icon: "gear" });
	navigator.geolocation.getCurrentPosition(browse_lookup, function(){
		$("#browseNearby").html("Browse nearby parties");
		$("#browseNearby").buttonMarkup({ icon: "grid" });
	});
}

function create_geolocate() {
	navigator.geolocation.getCurrentPosition(try_create, function(){
		try_create({coords: {latitude: 360, longitude: 360}});
	});
}

function browse_lookup(position) {
	$("#nearbyParties").load(
		"nearby.php",
		{lat: position.coords.latitude, lon: position.coords.longitude},
		function(){
			$("#nearbyParties").listview("refresh");
			$(".nearbyParty").click(join_nearby);
			$("#browseNearby").html("Browse nearby parties");
			$("#browseNearby").buttonMarkup({ icon: "grid" });
		});
}

function search_parties() {
	$("#search").html("Searching for parties...");
	$("#search").buttonMarkup({ icon: "gear" });
	$("#searchResults").load(
		"search-party.php",
		{name: $("#searchName").val()},
		function(){
			$("#searchResults").listview("refresh");
			$(".partyResult").click(join_nearby);
			$("#search").html("Search");
			$("#search").buttonMarkup({ icon: "search" });
		});
}

function join_nearby() {
	try_join(null, $(this).attr('partyid'));
}

function try_join(partyName, partyID) {
	$.ajax({
		url: "join.php",
		data: {name: partyName, id: partyID},
		type: "POST",
		success: function(data, ignored, ignored2){
			if (data == "OK") {
				window.location = "party.php";
			} else {
				window.location = "error-join.php";
			}
		}
	});
}

function try_create(position) {
	$.ajax({
		url: "create.php",
		data: {name: $("#newName").val(), lat: position.coords.latitude, lon: position.coords.longitude},
		type: "POST",
		success: function(data, ignored, ignored2){
			if (data == "OK") {
				window.location = "party.php";
			} else {
				window.location = "error-new.php?suggestion=" + encodeURIComponent(data);
			}
		}
	});
}
