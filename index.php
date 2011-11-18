<!DOCTYPE html>
<?php 
	include("connect_db.php"); 
?>
<html>
	<head>
		<?php include "links.php"; ?>
		<script type="text/javascript" src="js/home.js"></script>
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
				<label for="searchName">Or search for a party name:</label>
				<input type="text" id="searchName" name="searchName" />
				<a href="#" data-role="button" data-icon="search" id="search">Search</a>
				<ul data-role="listview" data-inset="true" id="searchResults">
				</ul>
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
			$("#search").click(search_parties);
		        $("#searchName").keyup(function(event){
		           if(event.keyCode == 13) {
		             search_parties();
		           }
		        });
			$("#create").click(create_geolocate);
                        $("#newName").keyup(function(event){
                           if(event.keyCode == 13) {
                             create_geolocate();
                           }
                        });

		});
	</script>
</html>
