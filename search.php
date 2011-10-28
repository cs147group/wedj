<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta name="viewport" content="user-scalable=no,width=640px"/>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type"  />
<link href="wedj.CSS" rel="stylesheet" type="text/css" />
<title>We DJ!</title>
</head>

<body>

<div id="header">
	<div id="back-arrow" class="inline">
		<a href="partypage.php"><img src="back.png"/></a>
	</div>
	<div id="logo" class="inline">
		<br />
		WE DJ</div>
</div>
<div id="main">
	<p>
		SEARCH
	</p>
	<form>
	<div id="search-bar">
		<input type="text" id="search-field" class="inline" name="q"/>
		<input type="submit" class="inline" id="mag-glass" value=""/></div>
	</form>
	<p>
	BROWSE BY GENRE
	</p>
	<?php
		$arr = array( 1 => "Top 40", 2 => "Trance", 3 => "Rock", 4 => "Rap");
		for($i = 1; $i < 5; $i++){
			print "<div class='genre'><div class='genre-text inline'>" . $arr[$i] . "</div><div class='plus-button inline'></div></div>";
		}
	?>
</div>

</body>

</html>
