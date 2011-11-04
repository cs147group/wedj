<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
		<link rel="shortcut icon" href="images/favicon.ico">
		<link rel="apple-touch-icon" href="images/appIcon.png">
		<link rel="apple-touch-icon-precomposed" href="images/appIcon.png">
		<link rel="stylesheet" href="http://code.jquery.com/mobile/1.0rc2/jquery.mobile-1.0rc2.min.css" />
		<link rel="stylesheet" href="css/main.css" />
		<script type="text/javascript" src="http://code.jquery.com/jquery-1.6.3.min.js"></script>
		<script type="text/javascript" src="http://code.jquery.com/mobile/1.0rc2/jquery.mobile-1.0rc2.min.js"></script>
		<script type="text/javascript" src="js/script.js"></script>
		<link type="text/css" href="skin/jplayer.blue.monday.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery.jplayer.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
      $("#jquery_jplayer_1").jPlayer({
        ready: function () {
          $(this).jPlayer("setMedia", {
            mp3: <?php print '"' . $songMP3 . '"'; ?>
          });
        },
        swfPath: "/js",
        supplied: "mp3"
      });
    });
  </script>

	</head>
	<body>
		<div data-role="page" data-add-back-btn="true">
