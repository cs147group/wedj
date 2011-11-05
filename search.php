<!DOCTYPE html>
<?php
	include "header.php";
	include "connect_db.php";
?>
			<div data-role="content">
				<h3>Search for songs</h3>
				<label for="songtitle">Enter a song title:</label>
				<input type="search" name="songtitle" id="search" value="" />
				<a href="#" data-role="button" data-icon="search" id="searchSongs">Search</a>
				<ul data-role="listview" data-split-icon="plus" data-inset="true" id="songResults">
				</ul>
				<h3>Browse songs by genre</h3>
				<div data-role="collapsible-set">
					<?php
						$genres = array("Top 40" => "top40", "Alternative" => "alternative", "Country" => "country");
						foreach ($genres as $genreName => $genreIndex) {
					?>
					<div data-role="collapsible">
						<h3><?php echo $genreName; ?></h3>
						<ul data-role="listview" data-split-icon="plus" data-inset="true">
							<?php
							   $genreResult = mysql_query("SELECT * FROM songs WHERE genre = '$genreIndex'");
							   while ($row = mysql_fetch_array($genreResult)) {
							?>
							<li>
								<?php
									$songTitle = $row["name"];
							  	$artist = $row["artist"];
									$songID = $row["songID"];
							  ?>
								<a href="#">
									<h3><?php echo $songTitle; ?></h3>
									<p><?php echo $artist; ?></p>
								</a>
								<a href="#" class="addSong" id="<?php echo $songID; ?>"></a>
							</li>
							<?php
								}
							?>
						</ul>
					</div>
					<?php
						}
					?>
				</div>
				<div id="none"></div>
				<script>
					$(window).ready(function(){
						$("#searchSongs").click( function(){
							var name = $("#search").val();
							$("#songResults").load("searchsong.php", {songName: name},
							function(){
								$("#songResults").listview("refresh");
							});
						});
						$(".addSong").click( function(){
							var id = this.id;
							$("#none").load("addSong.php", {songID: id});
						});
					});
				</script>
			</div>
			<!-- FOOTER -->
			<?php include "footer.php"; ?>
