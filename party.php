<!DOCTYPE html>
<?php include "links.php"; ?>
<?php
	include("information-gatherer.php");
?>
			<div data-role="header">
				<a href="confirm-leave.php" data-icon="back" data-rel="dialog">Leave Party</a>
				<h1>WeDJ</h1>
				<a href="info.php" data-icon="info" data-rel="dialog">Info</a>
			</div>
			<div data-role="content">
				<h2>Party Name</h2>
				<a href="search.php" data-role="button" data-icon="plus">Add Songs</a>
				<h3>Now Playing:</h3>
				<ul data-role="listview">
					<li>
						<h3><?php print $name ?></h3>
						<p><?php print $artist ?></p>
						<span class="ui-li-count">0</span>
					</li>
				</ul>
				<br />
				<h3>Playlist</h3>
				<ul data-role="listview">
					<li>
						<h3>Song Title</h3>
						<p>Song Artist</p>
						<span class="ui-li-count">0</span>
						<div data-role="controlgroup" data-type="horizontal">
							<a href="#" data-icon="arrow-u" data-role="button" data-iconpos="notext"></a>
							<a href="#" data-icon="arrow-d" data-role="button" data-iconpos="notext"></a>
						</div>
					</li>
					<li>
						<h3>Song Title</h3>
						<p>Song Artist</p>
						<span class="ui-li-count">0</span>
						<div data-role="controlgroup" data-type="horizontal">
							<a href="#" data-icon="arrow-u" data-role="button" data-iconpos="notext"></a>
							<a href="#" data-icon="arrow-d" data-role="button" data-iconpos="notext"></a>
						</div>
					</li>
					<li>
						<h3>Song Title</h3>
						<p>Song Artist</p>
						<span class="ui-li-count">0</span>
						<div data-role="controlgroup" data-type="horizontal">
							<a href="#" data-icon="arrow-u" data-role="button" data-iconpos="notext"></a>
							<a href="#" data-icon="arrow-d" data-role="button" data-iconpos="notext"></a>
						</div>
					</li>
				</ul>
			</div>
			<?php include "footer.php"; ?>