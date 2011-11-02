function initiate_geolocation() {
	$("#browseNearby").html("Loading nearby parties...");
	$("#browseNearby").buttonMarkup({ icon: "grid" });
	navigator.geolocation.getCurrentPosition(handle_geolocation_query, handle_geolocation_error);
}

function handle_geolocation_error(error) {
	switch(error.code) {
		case error.PERMISSION_DENIED: alert("user did not share geolocation data");
		break;

		case error.POSITION_UNAVAILABLE: alert("could not detect current position");
		break;

		case error.TIMEOUT: alert("retrieving position timed out");
		break;

		default: alert("unknown error");
		break;
	}
}

function handle_geolocation_query(position) {
	$("#nearbyParties").load(
		"http://jbinney1.cs147.org/wedj/nearby.php",
		{lat: position.coords.latitude, lon: position.coords.longitude},
		function(){
			$("#nearbyParties").listview("refresh");
			$("#browseNearby").html("Browse nearby parties");
			$("#browseNearby").buttonMarkup({ icon: "gear" });
		});
}
