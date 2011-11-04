function browse_geolocate() {
	$("#browseNearby").html("Loading nearby parties...");
	$("#browseNearby").buttonMarkup({ icon: "gear" });
	navigator.geolocation.getCurrentPosition(browse_lookup);
}

function create_geolocate() {
	navigator.geolocation.getCurrentPosition(try_create, function(){
		try_create({coords: {latitude: 360, longitude: 360}});
	});
}

function browse_lookup(position) {
	$("#nearbyParties").load(
		"http://jbinney1.cs147.org/wedj/nearby.php",
		{lat: position.coords.latitude, lon: position.coords.longitude},
		function(){
			$("#nearbyParties").listview("refresh");
			$("#browseNearby").html("Browse nearby parties");
			$("#browseNearby").buttonMarkup({ icon: "gear" });
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
