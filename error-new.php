<!DOCTYPE html>
<html>
	<head>
		<?php include "links.php"; ?>
	</head>
	<body>
		<div data-role="page" data-add-back-btn="true">
			<div data-role="header">
				<h1>Whoops!</h1>
			</div>
			<div data-role="content">
				<p align="center">Sorry, that name is already taken. You can choose a similar name:</p>
				<input type="text" id="newName" value="<?php echo $_GET['suggestion']; ?>" />
				<a href="#" data-role="button" data-icon="star" id="createAlt">Create</a>
				<a href="#" data-role="button" data-rel="back">Cancel</a>
			</div>
		</div>
	</body>
	<script>
		$(window).ready(function(){
			$("#createAlt").click(create_geolocate);
		});
	</script>
</html>
