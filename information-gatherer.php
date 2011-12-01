<?php
	$ipAddress = $_SERVER['REMOTE_ADDR'];
	$userQuery = "SELECT * FROM users WHERE ip='$ipAddress'";
	$userResult = mysql_query($userQuery) or die(mysql_error());
	if(mysql_affected_rows() == 0) {
		?>
		<script type = "text/javascript">
			window.location = "index.php";
		</script>
		<?php
	}
	$isHost = mysql_result($userResult, 0, "isAdmin");
	$partyID = mysql_result($userResult, 0, "party");
?>
