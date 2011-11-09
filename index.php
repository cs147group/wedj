<!DOCTYPE html>
<html>
	<head>
		<?php include "links.php"; ?>
	</head>
	<body>
		<div data-role="page" data-add-back-btn="true">
			<div data-role="header">
				<h1>WeDJ</h1>
				<a href="info.php" data-icon="info">Info</a>
			</div>
			<div data-role="content">
				<h2>Join a party</h2>
				<a href="#" data-role="button" data-icon="grid" id="browseNearby">Browse nearby parties</a>
				<ul data-role="listview" data-inset="true" id="nearbyParties">
				</ul>
				<label for="joinName">Or enter a party name:</label>
				<input type="text" id="joinName" name="joinName" />
				<a href="#" data-role="button" data-icon="forward" id="join">Go</a>
				<h2>Create a new party</h2>
				<label for="newName">Your new party name:</label>
				<input type="text" id="newName" name="newName" />
				<a href="#" data-role="button" data-icon="star" id="create">Create</a>
			</div>
		</div>
	</body>
	<script>
		$(window).ready(function(){
			$("#browseNearby").click(browse_geolocate);
			$("#join").click(join_manual);
			$("#create").click(create_geolocate);
		});
	</script>
</html>
