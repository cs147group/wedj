<!DOCTYPE html>
<html>
	<head>
		<?php include "links.php"; ?>
	</head>
	<body>
		<div data-role="page" data-add-back-btn="true">
			<div data-role="header">
				<h1>Leave Party</h1>
			</div>
			<div data-role="content">
				<p align="center">Are you sure you want to leave the party?
<?php if ($_GET['host']) { ?>
				You will no longer be able to play music from this playlist.
<?php } ?>
				</p>
				<a href="#" data-role="button" id="confirmLeave">Leave</a>
				<a href="#" data-role="button" data-rel="back">Stay</a>
			</div>
			<script>
				$(window).ready(function(){
					$("#confirmLeave").click(function(){
						window.location = "index.php";
					});
				});
			</script>
		</div>
	</body>
</html>
