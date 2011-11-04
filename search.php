<!DOCTYPE html>
<?php include "header.php"; ?>
			<div data-role="content">
				<h3>Search for songs</h3>
				<label for="name">Enter a song title:</label>
				<input type="search" name="songtitle" id="search" value="" />
				<a href="#" data-role="button" data-icon="search" id="searchSongs">Search</a>
				<ul data-role="listview" data-split-icon="plus" data-inset="true" id="songResults">
				</ul>
				<h3>Browse songs by genre</h3>
				<div data-role="collapsible-set">
					<div data-role="collapsible">
						<h3>Top 40</h3>
						<ul data-role="listview" data-split-icon="plus" data-inset="true">
							<?php
							   $genreResult = mysql_query("SELECT * FROM songs WHERE genre = 'top40'");
							   while ($row = mysql_fetch_array($genreResult) ){
							?>
							      <li>
							        <?php
							           $songTitle = $row["name"];
							           $artist = $row["artist"];
							        ?>
							      </li>
							<?php
							   }
							?>
						  
						  <li>
								<a href="#">
									<h3>Fearless</h3>
									<p>Taylor Swift</p>
								</a>
								<a href="#" class="addSong" id="1"></a>
							</li>
						</ul>
					</div>
					<div data-role="collapsible">
						<h3>Trance</h3>
						<ul data-role="listview" data-split-icon="plus" data-inset="true">
							<li>
								<a href="#">
									<h3>Song Title 1</h3>
									<p>Song Artist 1</p>
								</a>
								<a href="#"></a>
							</li>
						</ul>
					</div>
					<div data-role="collapsible">
						<h3>Rock</h3>
						<ul data-role="listview" data-split-icon="plus" data-inset="true">
							<li>
								<a href="#">
									<h3>Song Title 1</h3>
									<p>Song Artist 1</p>
								</a>
								<a href="#"></a>
							</li>
						</ul>
					</div>
					<div data-role="collapsible">
						<h3>Rap</h3>
						<ul data-role="listview" data-split-icon="plus" data-inset="true">
							<li>
								<a href="#">
									<h3>Song Title 1</h3>
									<p>Song Artist 1</p>
								</a>
								<a href="#"></a>
							</li>
						</ul>
					</div>
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
					                alert("Song added successfully");
							$("#none").load("addSong.php", {songID: id});
						});
					});
				</script>
			</div>
			<!-- FOOTER -->
			<?php include "footer.php"; ?>
