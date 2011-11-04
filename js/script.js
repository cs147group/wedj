function initiate_geolocation() {
	$("#browseNearby").html("Loading nearby parties...");
	$("#browseNearby").buttonMarkup({ icon: "gear" });
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
		"nearby.php",
		{lat: position.coords.latitude, lon: position.coords.longitude},
		function(){
			$("#nearbyParties").listview("refresh");
			$(".nearbyParty").click(join_nearby);
			$("#browseNearby").html("Browse nearby parties");
			$("#browseNearby").buttonMarkup({ icon: "grid" });
		});
}

function join_manual() {
	try_join($("#joinName").val());
}

function join_nearby() {
	try_join($(this).html());
}

function try_join(partyName) {
	$.ajax({
		url: "join.php",
		data: {name: partyName},
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
