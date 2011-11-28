<?php
	$time = time();
	$result = mysql_query("DELETE FROM parties WHERE (($time - time) > 86400)") or die(mysql_error());
?>