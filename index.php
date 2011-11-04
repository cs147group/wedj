<!DOCTYPE html>
<?php include "links.php"; ?>
			<div data-role="header">
				<h1>WeDJ</h1>
				<a href="info.php" data-icon="info" data-rel="dialog">Info</a>
			</div>
			<div data-role="content">
				<h2>Join a party</h2>
				<a href="#" data-role="button" data-icon="gear" id="browseNearby">Browse nearby parties</a>
					<ul data-role="listview" data-inset="true" id="nearbyParties">
					</ul>
				<script>
					$(window).ready(function(){
						$("#browseNearby").click(initiate_geolocation);
					});
				</script>
				</script>
				<form action="party.php" method="get">
					<label for="name">Or enter a party name:</label>
					<input type="search" name="partyname" id="search" value=""  />
					<button data-icon="search" type="submit" name="search" value="search-value">Search</button>
				</form>
				<h2>Create a new party</h2>
				<form action="party.php" method="get">
					<label for="name">Your party name:</label>
					<input type="text" name="name" id="name" value="" />
					<button type="submit" name="submit" value="submit-value">Create</button>
				</form>
				<h2>*** Error Screen ***</h2>
				<a href="error-new.php" data-rel="dialog" data-role="button"  data-transition="pop">Error - New Party</a>
				<a href="error-join.php" data-role="button" data-rel="dialog" data-transition="pop">Error - Join Party</a>
			</div>
		</div>
	</body>
</html>
