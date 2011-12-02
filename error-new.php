<!DOCTYPE html>
<html>
	<head>
		<?php include "links.php"; ?>
		<script type="text/javascript" src="js/home.js"></script>
	</head>
	<body>
		<div data-role="page" data-add-back-btn="true">
			<div data-role="header" data-position="fixed" data-theme="c">
				<h1>Whoops!</h1>
			</div>
			<div data-role="content">
				<p align="center">Sorry, that name is already taken. You can choose a similar name:</p>
				<input type="text" id="newName" value="<?php echo $_GET['suggestion']; ?>" />
				<a href="#" data-role="button" data-icon="star" id="createAlt">Create</a>
				<a href="#" data-role="button" data-rel="back" data-theme="d">Cancel</a>
			</div>
		</div>
	</body>
	<script>
		$(window).ready(function(){
			$("#createAlt").click(create_geolocate);
		});
	</script>
</html>
