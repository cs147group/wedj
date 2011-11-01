<!DOCTYPE html>
<?php include "links.php" ?>
			<div data-role="header">
				<h1>Dialog</h1>
			</div>
			<div data-role="content">
				<h1>Error</h1>
				<p>Sorry, that name is already taken.  you can choose a similar name:</p>
				<form action="party.php" method="get">
					<input type="text" name="name" id="name" value="Different Party Name" />
					<button type="submit" name="submit" value="submit-value">Create</button>
				</form>
				<a href="#" data-role="button" data-rel="back">Cancel</a>
			</div>
		</div>
	</body>
</html>