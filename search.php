<!DOCTYPE html>
<?php
	include "header.php";
	include "connect_db.php";
?>
<html>
	<head>
		<?php include "links.php"; ?>
	</head>
	<body>
		<div data-role="page" data-add-back-btn="true">
			<div data-role="header">
				<h1>WeDJ</h1>
			</div>	
			<div data-role="content">
				<h3>Search for songs</h3>
				<label for="search">Enter a song title or artist name:</label>
				<input type="search" id="search" value="" />
				<a href="#" data-role="button" id="searchButton">Search</a>
				<div data-role="controlgroup" id="searchResults">
				</div>
				<h3>Browse songs by genre</h3>
				<div data-role="collapsible-set">
					<?php
						$genres = array("Top 40" => "top40", "Alternative" => "alternative", "Country" => "country");
						foreach ($genres as $genreName => $genreIndex) {
					?>
					<div data-role="collapsible">
						<h3><?php echo $genreName; ?></h3>
						<div data-role="controlgroup">
							<?php
							   $genreResult = mysql_query("SELECT * FROM songs WHERE genre = '$genreIndex'");
							   while ($row = mysql_fetch_array($genreResult)) {
									$songTitle = $row["name"];
							  	$artist = $row["artist"];
									$songID = $row["songID"];
							?>
								<a href="#" data-role="button" data-icon="plus" data-iconpos="right" class="addSong" id="<?php echo $songID; ?>">
									<h3 class="ui-li-heading"><?php echo $songTitle; ?></h3>
									<p class="ui-li-desc"><?php echo $artist; ?></p>
								</a>
							<?php
								}
							?>
						</div>
					</div>
					<?php
						}
					?>
				</div>
				<div id="none" style="display:none"></div>
				<script>
					$(window).ready(function(){
						$("#searchButton").click(function(){
							$("#searchResults").load("searchsong.php", {searchText: $("#search").val()});
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
				</script>
			</div>
			<!-- FOOTER -->
			<?php include "footer.php"; ?>
