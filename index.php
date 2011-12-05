<!DOCTYPE html>
<?php 
// Detect mobile browser
$mobile_browser = '0';
if (preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|android)/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
	$mobile_browser++;
}
  
if ((strpos(strtolower($_SERVER['HTTP_ACCEPT']),'application/vnd.wap.xhtml+xml') > 0) or ((isset($_SERVER['HTTP_X_WAP_PROFILE']) or isset($_SERVER['HTTP_PROFILE'])))) {
	$mobile_browser++;
}    

$mobile_ua = strtolower(substr($_SERVER['HTTP_USER_AGENT'], 0, 4));
$mobile_agents = array(
	'w3c ','acs-','alav','alca','amoi','audi','avan','benq','bird','blac',
	'blaz','brew','cell','cldc','cmd-','dang','doco','eric','hipt','inno',
	'ipaq','java','jigs','kddi','keji','leno','lg-c','lg-d','lg-g','lge-',
	'maui','maxo','midp','mits','mmef','mobi','mot-','moto','mwbp','nec-',
	'newt','noki','oper','palm','pana','pant','phil','play','port','prox',
	'qwap','sage','sams','sany','sch-','sec-','send','seri','sgh-','shar',
	'sie-','siem','smal','smar','sony','sph-','symb','t-mo','teli','tim-',
	'tosh','tsm-','upg1','upsi','vk-v','voda','wap-','wapa','wapi','wapp',
	'wapr','webc','winw','winw','xda ','xda-');

if (in_array($mobile_ua,$mobile_agents)) {
	$mobile_browser++;
}

if (strpos(strtolower($_SERVER['ALL_HTTP']),'OperaMini') > 0) {
	$mobile_browser++;
}

if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']),'windows') > 0) {
	$mobile_browser = 0;
}

if ($mobile_browser > 0) {
	// Using a mobile browser
	include("connect_db.php"); 
	include("toss_parties.php");
?>
<html>
	<head>
		<?php include "links.php"; ?>
		<script type="text/javascript" src="js/home.js"></script>
		</head>
	<body>	
		<div data-role="page" data-add-back-btn="true">
			<div data-role="header" data-position="fixed" data-theme="c">
				<h1>WeDJ</h1>
				<img id="logo" src="images/57.png"></img>
				<a href="info.php" data-icon="info" class="ui-btn-right" data-theme="a">Info</a>
			</div>
			<div data-role="content">
				<h2>Join a party</h2>
				<a href="#" data-role="button" data-icon="geolocate" id="browseNearby" data-theme="c">Browse nearby parties</a>
				<ul data-role="listview" data-inset="true" id="nearbyParties">
				</ul>
				<label for="searchName">Or search for a party name:</label>
				<input type="text" id="searchName" name="searchName" />
				<a href="#" data-role="button" data-icon="search" id="search">Search</a>
				<ul data-role="listview" data-inset="true" id="searchResults">
				</ul>
				<h2>Create a new party</h2>
				<label for="newName">Your new party name:</label>
				<input type="text" id="newName" name="newName" />
				<a href="#" data-role="button" data-icon="star" id="create">Create</a>
			</div>
		</div>
	</body>
	<script>
	var numTimesClicked = 0;
	</script>
	<script>
		$(window).ready(function(){
			$("#browseNearby").click(browse_geolocate);
			$("#search").click(search_parties);
		        $("#searchName").keyup(function(event){
		           if(event.keyCode == 13) {
		             search_parties();
		           }
		        });
			$("#create").click(create_geolocate);
                        $("#newName").keyup(function(event){
                           if(event.keyCode == 13) {
                             create_geolocate();
                           }
                        });

		});
	</script>
</html>
<?php
} else {
	// Using other browser
	print "<h1>You must use a mobile device with HTML5 to participate in this study. If you are using a mobile device and still receive this error, please let us know. Thank you.</h1>";
}
?>
