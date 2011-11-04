<!DOCTYPE html>
<?php include "links.php"; ?>
			<div data-role="header">
				<h1>WeDJ</h1>
				<a href="info.php" data-icon="info" data-rel="dialog">Info</a>
			</div>
			<div data-role="content">
				<h2>Join a party</h2>
				<a href="#" data-role="button" data-icon="grid" id="browseNearby">Browse nearby parties</a>
				<ul data-role="listview" data-inset="true" id="nearbyParties">
				</ul>
				<label for="partyname">Or enter a party name:</label>
				<input type="text" id="joinName" />
				<a href="#" data-role="button" data-icon="forward" id="join">Go</a>
				<h2>Create a new party</h2>
				<label for="newname">Your new party name:</label>
				<input type="text" id="newName" />
				<a href="#" data-role="button" data-icon="star" id="create">Create</a>
				<h2>*** Error Screen ***</h2>
				<a href="error-new.php" data-rel="dialog" data-role="button"  data-transition="pop">Error - New Party</a>
			</div>
		</div>
	</body>
	<script>
		$(window).ready(function(){
			$("#browseNearby").click(initiate_geolocation);
			$("#join").click(join_manual);
		});
	</script>
</html>
